@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">          
            <div class="card" style="width: 24rem; margin-top: 50px;">
            <div class="card-header">
            Detail Pembeli
            </div>
            <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Usermae: </b>{{$users->username}}</li>
                <li class="list-group-item"><b>Nama: </b>{{$users->name}}</li>
                <li class="list-group-item"><b>Email: </b>{{$users->email}}</li>
                <li class="list-group-item"><b>Password: </b>{{$users->password}}</li>
            </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('barang.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection