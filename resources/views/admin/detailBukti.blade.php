@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">          
            <div class="card" style="width: 24rem; margin-top: 50px;">
            <div class="card-header">
            Detail Transaksi
            </div>
            <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Invoice: </b>{{ $pesanans ->kode }}</li>
                <li class="list-group-item"><b>Nama Pembeli: </b>{{ $pesanans ->user->name }}</li>
                <li class="list-group-item"><b>Jumlah Harga: </b>{{ $pesanans ->jumlah_harga }}</li>
                <li class="list-group-item"><b>Status: </b>{{ $pesanans ->status_pesanan->nama_status }}</li>
                <li class="list-group-item"><b>Tanggal: </b>{{ $pesanans ->tanggal }}</li>
                <li class="list-group-item"><b>Bukti: </b><img style="width: 100%" src="{{ asset('./storage/bukti_pesanan/'. $pesanans->bukti_pesanan) }}" alt=""></li>
                
            </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('transaksi.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection