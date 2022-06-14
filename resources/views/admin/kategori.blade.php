@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Tabel Kategori Produk </h4>
            <form class="form" method="get" action="{{ route('search') }}">
              <div class="form-group w-100 mb-3">
                  <input type="text" name="search" class="form-control w-80 d-inline" id="search" placeholder="Search Kategori...">
              </div>
          </form>
          @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <p>{{ $message }}</p>
          </div>
          @endif
              </div>
              <div class="card-body">
              <a class="btn btn-warning btn-sm" href="{{ route('kategori.create') }}">Tambah</a> 
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>nama</th>
                      <th width="250px">
                        Aksi
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($paginate as $ktg)
                    <tr>
                    <td>{{ $ktg ->nama }}</td>
                    <td>
                      <form action="{{ route('kategori.destroy',['kategori'=>$ktg->nama]) }}" method="POST">
                        <a class="btn btn-primary btn-sm" href="{{ route('kategori.edit',$ktg->nama) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$ktg->id}} akan dihapus?')">Delete</button>
                      </form> 
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          {{ $paginate->links()}}
      @endsection