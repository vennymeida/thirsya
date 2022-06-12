@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem; margin-top: 50px;">
            <div class="card-header">
            Tambah Barang
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
                <form method="post" action="{{ route('barang.store') }}" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" aria-describedby="nama_barang" >
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="harga" name="harga" class="form-control" id="harga" ariadescribedby="harga" >
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="stok" name="stok" class="form-control" id="stok" ariadescribedby="stok" >
                <div class="form-group">
                    <label for="keterangan">keterangan</label>
                    <input type="keterangan" name="keterangan" class="form-control" id="keterangan" ariadescribedby="keterangan" >
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label> 
                    <input type="file" name="foto" class="form-control" id="foto" aria-describedby="foto"> 
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection