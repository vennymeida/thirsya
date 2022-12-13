<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Alert;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\URL;


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
            return view('admin.barang', ['barangs' => $barangs, 'paginate' => $paginate, 'kategori' => $kategori]);
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
        return view('admin.createB', ['kategoris' => $kategoris]);
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
            'Kategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'foto' => 'required',
        ]);
        $image_name = '';
        if ($request->file('foto')) {
            $image_name = $request->file('foto');
            // $image_name = $request->file('foto')->store('images', 'public');
            $storage = new StorageClient([
                'keyFilePath' => public_path('key.json')
            ]);

            $bucketName = env('GOOGLE_CLOUD_BUCKET');
            $bucket = $storage->bucket($bucketName);

            //get filename with extension
            $filenamewithextension = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
            // $filenamewithextension = $request->file('foto')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('foto')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('foto'), 'r+'));

            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }
        // if ($request->file('foto')) {
        //     $image_name = $request->file('foto')->store('images', 'public');
        // }

        $kategoris = new Kategori;
        $barangs = new Barang;
        $kategoris->id = $request->get('Kategori');
        $barangs->kategori()->associate($kategoris);

        $barangs->nama_barang = $request->get('nama_barang');
        $barangs->harga = $request->get('harga');
        $barangs->stok = $request->get('stok');
        $barangs->keterangan = $request->get('keterangan');
        $barangs->foto = $filenametostore;
        $barangs->save();

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
        return view('admin.detailB', ['barangs' => $barangs, 'kategoris' => $kategoris]);
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
        return view('admin.editB', ['barangs' => $barangs, 'kategoris' => $kategoris]);
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
        $request->validate([
            'kategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable',
        ]);
        $image_name = '';
        $data = array(
            'kategori_id' => $request->post('kategori'),
            'nama_barang' => $request->post('nama_barang'),
            'harga' => $request->post('harga'),
            'stok' => $request->post('stok'),
            'keterangan' => $request->post('keterangan'),
        );
        if ($request->file('foto')) {
            $image_name = $request->file('foto')->store('images', 'public');
            $data = array_merge($data, array('foto' => $image_name));
        }

        Barang::where('nama_barang', $nama_barang)->update($data);

        if ($request->file('foto') && file_exists(storage_path('app/public/' . $request->file('foto')))) {
            Storage::delete('public/' . $request->file('foto'));
        }

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
    public function destroy($id)
    {
        $barangs = Barang::all()->where('id', $id)->first();
        $storage = new StorageClient();

        $bucketName = env('GOOGLE_CLOUD_BUCKET');
        $bucket = $storage->bucket($bucketName);
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($barangs->foto);



        $object->delete();
        $barangs->delete($barangs);
        Alert::success('Sukses', 'Berhasil Hapus Data Barang');
        return redirect()->route('barang.index');
    }

    public function listBarangKategori($id)
    {
        $barang_query = Barang::with('kategori')->where('kategori_id', $id);
        $paginate = $barang_query->paginate(3);
        $barangs = $barang_query->get();
        $kategori = Kategori::all();

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
