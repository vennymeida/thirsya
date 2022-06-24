<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AlamatPengirimanRequest;
use App\Models\AlamatPengiriman;
use App\Models\Cart;
use App\Models\Pesanan;
use Alert;
use Auth;

class AlamatPengirimanController extends Controller
{
    public function index()
    {
      
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
    public function store(AlamatPengirimanRequest $request)
    {

        $payload = $request->only(['nama_penerima', 'no_tlp', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos']);
        $payload['user_id'] = Auth::user()->id;
        $status = $request->status;
        
        if ($status == 1) {
            AlamatPengiriman::where([
                'user_id' => Auth::user()->id,
                'status' => 1
            ])
                ->update(['status' => 0]);
        }
        $payload['status'] = $status;
        AlamatPengiriman::create($payload);

        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $Pesanans = Pesanan::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "cart"
        ])->first();
        if ($alamatutama) {
            Pesanan::where('cart_id', $alamatutama->id)->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        } else {
            Pesanan::where('cart_id', $cart->id)->update([
                'alamat_pengiriman_id' => null
            ]);
        }
        Alert::success('Berhasil', 'Berhasil Menambah Alamat');
        return back()->with('success', 'Alamat pengiriman berhasil disimpan');
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
        $data = AlamatPengiriman::findOrFail($id);
     
        return response()->json(['success' => true, 'html' => view('user.edit-alamat', compact('data'))->render()], 200);
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
        $payload = $request->only(['nama_penerima', 'no_tlp', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos']);
        $payload['user_id'] = Auth::user()->id;
        $status = $request->status;
        if ($status == 1) {
            AlamatPengiriman::where([
                'user_id' => Auth::user()->id,
                'status' => 1
            ])
                ->update(['status' => 0]);
        }
        $payload['status'] = $status;
        AlamatPengiriman::findOrFail($id)->update($payload);

        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $Pesanans = Pesanan::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "3"
        ])->first();
        if ($alamatutama) {
            Pesanan::where([
                'id_pesanans' => $Pesanans->id_pesanans,
            ])->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        } else {
            Pesanan::where([
                'id_pesanans' => $Pesanans->id_pesanans,

            ])->update([
                'alamat_pengiriman_id' => null
            ]);
        }
        Alert::success('Berhasil', 'Berhasil Mengubah Alamat');
        return back()->with('success', 'Alamat pengiriman berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $Pesanans = Pesanan::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "3"
        ])->first();
        if ($alamatutama) {
            Pesanan::where([
                'id_pesanans' => $Pesanans->id_pesanans,
            ])->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        }
       
      

        if($Pesanans->alamat_pengiriman_id == $id){
            Alert::warning('Gagal', 'Alamat Masih Digunakan');
            return response()->json(['success' => false]);
        }else{
            Alert::success('Berhasil', 'Sukses Menghapus Alamat');
            $alamat = AlamatPengiriman::findOrFail($id);
            $alamat->delete();
            return response()->json(['success' => true], 200);

        }

        /*
          $Alamat_Pesanan = Pesanan::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "3"
        ])->get();
        foreach ($Pesanan as $val) {
            foreach ($val->detail as $item) {
                if ($item->alamat_pengiriman_id == $alamat->id) {
                }
            }
        }*/
        

    }
}