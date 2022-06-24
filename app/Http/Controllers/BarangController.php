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
        $barangs = Barang::paginate(3)->all();
        $paginate = Barang::paginate(3);
        // $listbarang = Barang::with('kategori')->latest()->paginate(3);
        $kategori = Kategori::all();
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
    Alert::success('Sukses', 'Berhasil Tambah Data Barang');
    return redirect()->route('barang.index')
        ->with('success', 'Barang Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangs = Barang::all()->where('id', $id)->first();
        $kategoris = Kategori::all();
        return view('admin.detailB',['barangs'=>$barangs, 'kategoris'=>$kategoris]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoris = Kategori::all();
        $barangs = Barang::all()->where('id', $id)->first();
        return view('admin.editB',['barangs'=>$barangs,'kategoris'=>$kategoris]);   
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
        //  melakukan validasi data
         $request->validate([
            'kategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'foto'=> 'nullable',
        ]);
     $image_name = '';
     $data= array(
        'kategori_id'=>$request->post('kategori'),
        'nama_barang'=>$request->post('nama_barang'),
        'harga'=>$request->post('harga'),
        'stok'=>$request->post('stok'),
        'keterangan'=>$request->post('keterangan'),
     );
     if ($request->file('foto')) {
        $image_name = $request->file('foto')->store('images', 'public'); 
        $data=array_merge($data,array('foto'=>$image_name));
     }

     Barang::where('nama_barang', $nama_barang)->update($data);

        if ($request->file('foto') && file_exists(storage_path('app/public/'. $request->file('foto')))) {
            Storage::delete('public/'. $request->file('foto'));
        }

                    
              
        //jika data berhasil diupdate, akan kembali ke halaman utama
        Alert::success('Sukses', 'Berhasil Ubah Data Barang');
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
        Alert::success('Sukses', 'Berhasil Hapus Data Barang');
        return redirect()->route('barang.index');
    }

    public function listBarangKategori($id)
    {
        DB::enableQueryLog();
      
        // $barangs = Barang::where('kategori_id', $id)->with('kategori')->latest()->paginate(8);
        // $barangs = Barang::all()->where('nama_barang', $nama_barang)->first();
        //$produk = Barang::with('kategori')->limit(6)->latest()->get()>paginate(3);
       
  
     
        $barang_query = Barang::with('kategori')->where('kategori_id', $id);
        $paginate = $barang_query->paginate(3);
        $barangs = $barang_query->get();
        $kategori = Kategori::all();

        //return view('admin.barang', compact('barangs', 'kategori'));
   
      
        return view('admin.barang', ['barangs' => $barangs, 'paginate' => $paginate, 'kategori' => $kategori]);
    }


    public function searchBarang(Request $request)
    {
        $keyword = $request->searchBarang;
        $barang_query = Barang::with('kategori')->where('nama_barang', 'like', "%" . $keyword . "%");
        $paginate = $barang_query->paginate(3);
        $barangs = $barang_query->get();
        $kategori = Kategori::all();
        return view('admin.barang', ['barangs' => $barangs, 'paginate' => $paginate, 'kategori' => $kategori]);
    }
   
}
