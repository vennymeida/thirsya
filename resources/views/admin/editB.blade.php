@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem; margin-top: 50px;">
            <div class="card-header">
            Edit Barang
            </div>
            <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('barang.update', $barangs->nama_barang) }}" enctype="multipart/form-data" id="myForm">
        @csrf
        @method('PUT')
        <div class="form-group">
                        <label for="Kategori">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori" value="{{$barangs->kategori }}">
                            @foreach($kategoris as $ktg)
                                <option value="{{$ktg->id}}" >{{$ktg->nama}} </option>
                            @endforeach
                        </select>
                    </div>
        <div class="form-group">
            <label for="nama_barang">nama_barang</label>
            <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="{{ $barangs->nama_barang }}" aria-describedby="nama_barang" >
        </div>
        <div class="form-group">
            <label for="harga">harga</label>
            <input type="text" name="harga" class="form-control" id="harga" value="{{ $barangs->harga }}" aria-describedby="harga" >
        </div>
        <div class="form-group">
            <label for="stok">stok</label>
            <input type="stok" name="stok" class="form-control" id="stok" value="{{ $barangs->stok }}" aria-describedby="stok" >
        </div>
        <div class="form-group">
            <label for="stok">keterangan</label>
            <input type="keterangan" name="keterangan" class="form-control" id="keterangan" value="{{ $barangs->keterangan }}" aria-describedby="keterangan" >
        </div>
        <br><label><input type="checkbox" name="checkfield" id="g01-01"  onchange="doalert(this)" /> Ubah Gambar</label>
        <div class="form-group" id='gambar'>
            <label for="foto">File</label><br>
            <input type="file" name="foto" value="{{ asset('./storage/'. $barangs->foto) }}" class="form-control" id="foto" aria-describedby="foto" style="opacity:1;position:relative;!important">
            <img style="width: 100%" src="{{ 'https://storage.googleapis.com/thirsya1/'. $barangs->foto) }}" alt="">
          </div>
       
        <br><button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
    </div>
</div>
<script>
    function doalert(checkboxElem) {
  if (checkboxElem.checked) {
    $("#gambar").show();
  } else {   
    $("#gambar").hide();
  }
}
  </script>
@endsection