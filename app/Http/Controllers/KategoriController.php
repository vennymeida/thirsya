<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (request()->user()->hasRole('admin')) {
                $kategoris = Kategori::all();
                $paginate = Kategori::orderBy('id', 'asc')->paginate(3);
            return view('admin.kategori', ['kategoris' => $kategoris ,'paginate'=>$paginate]);
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
        $kategoris = Kategori::all();
        return view('admin.createK',['kategori' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
         
        //fungsi eloquent untuk menambah data
        $kategoris= new Kategori;
        $kategoris->nama = $request->get('nama');
        $kategoris->save();
       
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Berhasil Ditambahkan');
        
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
    public function edit($nama)
    {
        $kategoris = Kategori::all()->where('nama', $nama)->first();
        return view('admin.editK',['kategoris'=>$kategoris]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nama)
    {
         //melakukan validasi data
         $request->validate([
            'nama' => 'required',
        ]);

        $kategoris = Kategori::all()->where('nama', $nama)->first();
        $kategoris->nama = $request->get('nama');
        
        
        $kategoris->save();

        
       
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nama)
    {
        $kategoris = Kategori::all()->where('nama', $nama)->first();
        $kategoris->delete($kategoris);
        return redirect()->route('kategori.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $paginate = Kategori::where('nama', 'like', '%' . request('search') . '%')->paginate(3);
        return view('admin.kategori', ['paginate'=>$paginate]);
    }
}
