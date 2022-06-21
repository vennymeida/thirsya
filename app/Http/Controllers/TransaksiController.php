<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Barang;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            $pesanans = Pesanan::all();
            $paginate = Pesanan::orderBy('id_pesanans', 'asc')->paginate(5);
            //dd( $pesanans[0]->status_pesanan);
           return view('admin.transaksi', ['pesanans' => $pesanans ,'paginate'=>$paginate]);
        } else {
            return redirect('/');
        }
        // $data = array('title' => 'Data Transaksi');
        // return view('transaksi.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanans = Pesanan::all()->where('id_pesanans', $id)->first();
        return view('admin.detailBukti',['pesanans'=>$pesanans]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::all()->where('id', $id)->first();
        return view('admin.editB',['transaksi'=>$transaksi]);  
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
        $status_cart = Pesanan::where('id_pesanans', $id)->first()->status_cart;
      
        if($status_cart == 2){
            $pesanans = Pesanan::where('id_pesanans', $id)
            ->update([
                'status_cart' => '1'
            ]
            );
        }else{
            $pesanans = Pesanan::where('id_pesanans', $id)
            ->update([
                'status_cart' => '2'
            ]
            );
        }
    
        return back();
    }
    public function update_belum_bayar(Request $request, $id)
    {
  
        $pesanans = Pesanan::where('id_pesanans', $id)
        ->update([
            'status_cart' => '1'
        ]
        );
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesanans = Pesanan::all()->where('id_pesanans', $id)->first();
        $pesanans->delete($pesanans);
        return redirect()->route('admin.transaksi');
    }

    public function cetak()
    {
        $data = [];
        $data = Pesanan::select('*')->first();
       
        //$cart = [];
        $barangs = $data->cart;

    
        
        //dd($data);
        $pdf = PDF::loadview('admin.cetakT', ['data' => $data, 'barangs'=>$barangs])->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
