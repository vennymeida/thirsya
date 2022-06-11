<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         if (request()->user()->hasRole('admin')) {
            $barangs = Barang::all();
            $paginate = Barang::orderBy('id', 'asc')->paginate(3);
           return view('admin.barang', ['barangs' => $barangs ,'paginate'=>$paginate]);
        } else {
            return redirect('/');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('admin.createB',['barang' => $barangs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //melakukan validasi data
       $request->validate([
        'nama_barang' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'keterangan' => 'required',
        'foto'=> 'required',
    ]);
        // 'JenisKelamin'=> 'required',
        // 'Email'=> 'required',
        // 'Alamat'=> 'required',
        // 'TanggalLahir'=> 'required',
        $image_name = '';
    if ($request->file('foto')) {
        $image_name = $request->file('foto')->store('images', 'public');
    }
    //fungsi eloquent untuk menambah data
    $barangs= new Barang;
    $barangs->nama_barang = $request->get('nama_barang');
    $barangs->harga = $request->get('harga');
    $barangs->stok = $request->get('stok');
    $barangs->keterangan = $request->get('keterangan');
    $barangs->foto = $image_name;
    $barangs->save();
    
    // $kelas = new Kelas;
    // $kelas->id = $request->get('Kelas');
    
    //Fungsi eloquent untuk menambah data dengan relasi belongsTo
    // $barang->kelas()->associate($kelas);
    // $barang->save();


    // Mahasiswa::create($request->all());

    //jika data berhasil ditambahkan, akan kembali ke halaman utama
    return redirect()->route('barang.index')
        ->with('success', 'Barang Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nama_barang)
    {
        $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        
        return view('admin.detailB',['barangs'=>$barangs]);
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
    public function destroy($nama_barang)
    {
        $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        $barangs->delete($barangs);
        return redirect()->route('barang.index');
    }
}
