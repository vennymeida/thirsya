<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\User;
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
            $transaksi = Transaksi::all();
            $paginate = Transaksi::orderBy('id', 'asc')->paginate(3);
           return view('admin.transaksi', ['transaksi' => $transaksi ,'paginate'=>$paginate]);
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
        $transaksi = Transaksi::all()->where('id', $id)->first();
        return view('admin.detailT',['transaksi'=>$transaksi]);
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
        //
    }

    // public function cetak_pdf()
    // {
    //     $transaksi = Transaksi:all();
    //     $pdf = PDF:loadview('transaksi.transaksi_pdf',['transaksi'=>$transaksi]);
    //     return->stream();
    // }
}
