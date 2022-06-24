<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\AlamatPengiriman;
use Auth;
use Alert;
use PDF;

use function App\Helpers\uploadFile;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',1)->first();
        $cart = [];
        $orders = Pesanan::join('status','status.id','=','pesanans.status_cart')->orderBy('id_pesanans','desc')->get();
       if(!empty($pesanans))
       {
           $cart = Cart::where('pesanan_id', $pesanans->id_pesanans)->get();

       }
       return view('user.order', ['cart' => $cart, 'pesanans' => $pesanans, 'orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemcart = Cart::where('status_cart', 'cart')
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($itemcart) {
            $order = Order::create([
                'cart_id' => $itemcart->id,
                'user_id' => Auth::user()->id
            ]);
            $itemcart->update(['status_cart' => 'checkout']);
            return redirect()->route('showupload', $order->id)->with('success', 'Order berhasil disimpan');
        }
        return back()->with('error', 'Checkout tidak dapat diproses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Pesanan::findOrFail($id);
        $order->cart->update([
            "status_cart" => "3"
        ]);
        $order->delete();
        return response()->json(['success' => true], 200);
    }

    public function showUpload($id)
    {
        $data = Pesanan::findOrFail($id);
        return view('user.uploadBukti', compact('data'));
    }

    public function uploadBukti(Request $request)
    {
        if ($request->hasFile('bukti_pesanan')) {
            $payload = uploadFile($request->file('bukti_pesanan'), 'bukti_pesanan');
            $order = Pesanan::findOrFail($request->id_pesanans);
            $data_barang = Pesanan::join('cart','cart.pesanan_id','=','pesanans.id_pesanans')
            ->where('pesanans.id_pesanans',$request->id_pesanans)->get();
            
      
            $order->update([
                'bukti_pesanan' => $payload
            ]);
            $id = $data_barang->pluck('barang_id')->toArray();
            $qty = $data_barang->pluck('jumlah')->toArray();
            $produk = Barang::whereIn('id', $id)->orderBy('id', 'DESC')->pluck('id')->toArray();
            $stok = Barang::whereIn('id', $id)->orderBy('id', 'DESC')->pluck('stok')->toArray();
            for ($i = 0; $i < count($id); $i++) {
                Barang::where('id', $produk[$i])->update([
                    'stok' => $stok[$i] - $qty[$i]
                ]);
                if ($stok[$i] < 0) {
                    Barang::where('id', $produk[$i])->update([
                        'stok' => $stok[$i] - $qty[$i]
                    ]);
                }
            }
            for ($j = 0; $j < count($stok); $j++) {
                if ($stok[$j] < 0) {
                    Barang::where('id', $produk[$j])->update([
                        'stok' => 0
                    ]);
                }
            }
            Alert::success('Success', 'Berhasil Upload Gambar');
            return redirect()->route('order.index');
        }
        Alert::warning('Warning', 'Gagal Upload Gambar');
        return redirect()->back();
    }

    public function cetak($id)
    {
        $data = Pesanan::where('id_pesanans', $id)->first();
        $barangs = $data->cart;
        $pdf = PDF::loadview('user.cetak', ['data' => $data, 'barangs'=>$barangs])->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    
}
