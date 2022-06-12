@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
 
<div class="container mt-5">
 
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
             Edit Pembeli
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
 <form method="post" action="{{ route('kategori.update', $kategoris->nama) }}" enctype="multipart/form-data" id="myForm">
 @csrf
 @method('PUT')
    <div class="form-group">
        <label for="nama">Nama</label> 
        <input type="nama" name="nama" class="form-control" id="nama" aria-describedby="nama" > 
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

@endsection