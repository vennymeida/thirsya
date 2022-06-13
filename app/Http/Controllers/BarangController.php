<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
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
        $listbarang = Barang::with('kategori')->latest()->paginate(8);
        $kategori = Kategori::paginate(3);
       return view('admin.barang', ['barangs' => $barangs ,'paginate'=>$paginate, 'kategori' => $kategori]);
    } else {
        return redirect('/');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $barangs = Barang::all();
    //     return view('admin.createB',['barang' => $barangs]);
    // }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.createB',['kategoris' => $kategoris]);
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
        'Kategori' => 'required',
        'nama_barang' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'keterangan' => 'required',
        'foto'=> 'required',
    ]);
       
        $image_name = '';
    if ($request->file('foto')) {
        $image_name = $request->file('foto')->store('images', 'public');
    }
    //fungsi eloquent untuk menambah data
    $kategoris = new Kategori;
    $barangs= new Barang;
    $kategoris -> id = $request->get('Kategori');
    $barangs->kategori()->associate($kategoris);
    
    $barangs->nama_barang = $request->get('nama_barang');
    $barangs->harga = $request->get('harga');
    $barangs->stok = $request->get('stok');
    $barangs->keterangan = $request->get('keterangan');
    $barangs->foto = $image_name;
    // $barangs->save();
    
    
    
    //Fungsi eloquent untuk menambah data dengan relasi belongsTo
    
    $barangs->save();


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
    public function edit($nama_barang)
    {
        $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        return view('admin.editB',['barangs'=>$barangs]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nama_barang)
    {
         //melakukan validasi data
         $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'foto'=> 'required',
        ]);

        $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        $barangs->nama_barang = $request->get('nama_barang');
        $barangs->harga = $request->get('harga');
        $barangs->stok = $request->get('stok');
        $barangs->keterangan = $request->get('keterangan');
        
        if ($barangs->foto && file_exists(storage_path('app/public/'. $barangs->foto))) {
            Storage::delete('public/'. $barangs->foto);
        }

          $image_name = '';
        if ($request->file('foto')) {
        $image_name = $request->file('foto')->store('images', 'public');
    }
        $barangs->foto = $image_name;
        $barangs->save();

        
       
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('barang.index')
            ->with('success', 'Barang Berhasil Diupdate');
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

    public function listBarangKategori($nama_barang)
    {
        // $barangs = Barang::where('kategori_id', $id)->with('kategori')->latest()->paginate(8);
        // $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        $barangs = Barang::where('kategori_id', $nama_barang)->with('kategori')->latest()->paginate(8);
        $paginate = Barang::orderBy('id', 'asc')->paginate(3);
        $kategori = Kategori::paginate(3);
        return view('admin.barang', ['barangs' => $barangs, 'paginate'=>$paginate, 'kategori' => $kategori]);
    }
    // public function listBarangKategori(Request $request, $nama_barang)
    // {
    //     // $barangs = Barang::where('kategori_id', $id)->with('kategori')->latest()->paginate(8);
    //     // $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        
    //     $kategoris = Barang::where('nama_barang', $nama_barang)->get();
    //     $paginate = Kategori::paginate(3);
    //     return view('admin.barang', ['kategoris' => $kategoris, 'paginate'=>$paginate, 'nama_barang' => $nama_barang ]);
    // }

   
}
