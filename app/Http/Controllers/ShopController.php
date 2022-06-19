<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\Pesanan;
use App\Models\AlamatPengiriman;
use Auth;
// use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('user')) {
            $barangs = Barang::all();
           return view('user.shop', ['barangs' => $barangs]);
        } else {
            return redirect('/');
        } 
    }
    
    public function pesan(Request $request, $id)
    {	
    	$barangs = Barang::where('id', $id)->first();
    	$tanggal = Carbon::now();

    	//validasi apakah melebihi stok
    	if($request->jumlah_pesan > $barangs->stok)
    	{
    		return redirect('shop/'.$id);
    	}

    	//cek validasi
    	$cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();
    	//simpan ke database pesanan
    	if(empty($cek_pesanan))
    	{
    		$pesanans = new Pesanan;
	    	$pesanans->user_id = Auth::user()->id;
	    	$pesanans->tanggal = $tanggal;
	    	$pesanans->status_cart = 3;
	    	$pesanans->jumlah_harga = 0;
            $pesanans->kode = mt_rand(100, 999);
	    	$pesanans->save();
    	}
    	

    	//simpan ke database pesanan detail
    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();

    	//cek pesanan detail
    	$cek_pesanan_detail = Cart::where('barang_id', $barangs->id)
        ->where('pesanan_id', $pesanan_baru->id_pesanans)->first();
    	if(empty($cek_pesanan_detail))
    	{
    		$cart = new Cart;
	    	$cart->barang_id = $barangs->id;
	    	$cart->pesanan_id = $pesanan_baru->id_pesanans;
	    	$cart->jumlah = $request->jumlah_pesan;
	    	$cart->jumlah_harga = $barangs->harga*$request->jumlah_pesan;
	    	$cart->save();
    	}else 
    	{
    		$cart = Cart::where('barang_id', $barangs->id)->where('pesanan_id', $pesanan_baru->id_pesanans)->first();
    		$cart->jumlah = $cart->jumlah+$request->jumlah_pesan;

    		//harga sekarang
    		$harga_pesanan_detail_baru = $barangs->harga*$request->jumlah_pesan;
	    	$cart->jumlah_harga = $cart->jumlah_harga+$harga_pesanan_detail_baru;
	    	$cart->update();
    	}

    	//jumlah total
    	$pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();
    	$pesanans->jumlah_harga = $pesanans->jumlah_harga+$barangs->harga*$request->jumlah_pesan;
    	$pesanans->update();
    	
        // Alert::success('Pesanan Sukses Masuk Keranjang', 'Success');
    	return redirect('cart');

    }

    public function cart()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();
 	    $cart1 = [];
        if(!empty($pesanans))
        {
            $cart = Cart::where('pesanan_id', $pesanans->id_pesanans)->get();
           
        }else{
            return back()->with('error', 'Keranjang Kosong');
        }
        
        return view('user.cart', compact('pesanans', 'cart'));
    }

    public function checkoutAmount(){
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();
        $cart = [];
        $lastid_pesanans=Pesanan::orderBy('id_pesanans','desc')->first();
        //$create_pesanans=Pesanan::
       //dd($lastid_pesanans);
        $alamatpengiriman = AlamatPengiriman::where('user_id', Auth::user()->id)->orderBy('status', 'DESC')->get();

       if(!empty($pesanans))
       {
           $cart = Cart::where('pesanans_id', $pesanans->id_pesanans)->get();
           $checkout_barang = Cart::where('pesanans_id',NULL);
           $checkout_barang->update( ['pesanans_id'=>($lastid_pesanans->id_pesanans)] );
  

       }
      
        return view('user.checkout', ['cart' => $cart, 'pesanans' => $pesanans, 'alamatpengiriman' => $alamatpengiriman]);

    }

    public function placeorderPesanan()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status_cart',3)->first();
 	    $cart = [];
        $orders = Pesanan::join('status','status.id','=','pesanans.status_cart')->orderBy('id_pesanans','desc')->get();
        if(!empty($pesanans))
        {
            $cart = Cart::where('pesanan_id', $pesanans->id_pesanans)->get();
            $update_pesanan = Pesanan::where('id_pesanans', $pesanans->id_pesanans);
            $alamat_id = AlamatPengiriman::where('user_id', Auth::user()->id)->where('status', '1')->first();
            $update_pesanan->update([
             "status_cart" => "1",
             "alamat_pengiriman_id" => $alamat_id->id
            ]);
        }
        //dd($orders);
        return view('user.order', ['cart' => $cart, 'pesanans' => $pesanans, 'orders' => $orders]);
    }

    public function delete($id)
    {
        $cart = Cart::where('id_cart', $id)->first();

        $pesanans = Pesanan::where('id_pesanans', $cart->pesanan_id)->first();
        $pesanans->jumlah_harga = $pesanans->jumlah_harga-$cart->jumlah_harga;
        $pesanans->update();


        $cart->delete();

        // Alert::error('Pesanan Sukses Dihapus', 'Hapus');
        return redirect('cart');
    }

    
    // public function konfirmasi()
    // {
    //     $user = User::where('id', Auth::user()->id)->first();

    //     if(empty($user->alamat))
    //     {
    //         Alert::error('Identitasi Harap dilengkapi', 'Error');
    //         return redirect('profile');
    //     }

    //     if(empty($user->nohp))
    //     {
    //         Alert::error('Identitasi Harap dilengkapi', 'Error');
    //         return redirect('profile');
    //     }

    //     $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
    //     $pesanan_id = $pesanan->id;
    //     $pesanan->status = 1;
    //     $pesanan->update();

    //     $pesanan_details = Pesanan_details::where('pesanan_id', $pesanan_id)->get();
    //     foreach ($pesanan_details as $pesanan_detail) {
    //         $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
    //         $barang->stok = $barang->stok-$pesanan_detail->jumlah;
    //         $barang->update();
    //     }



    //     Alert::success('Pesanan Sukses Check Out Silahkan Lanjutkan Proses Pembayaran', 'Success');
    //     // return redirect('history/'.$pesanan_id);

    // }
}
