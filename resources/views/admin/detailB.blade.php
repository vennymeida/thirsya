@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">          
            <div class="card" style="width: 24rem; margin-top: 50px;">
            <div class="card-header">
            Detail Barang
            </div>
            <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Kategori: </b>{{$barangs->kategori->nama}}</li>
                <li class="list-group-item"><b>Nama Barang: </b>{{$barangs->nama_barang}}</li>
                <li class="list-group-item"><b>Harga: </b>{{$barangs->harga}}</li>
                <li class="list-group-item"><b>Stok: </b>{{$barangs->stok}}</li>
                <li class="list-group-item"><b>Keterangan: </b>{{$barangs->keterangan}}</li>
                <li class="list-group-item"><b>Foto: </b><img style="width: 100%" src="{{ asset('./storage/'. $barangs->foto) }}" alt=""></li>
                
            </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('barang.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection