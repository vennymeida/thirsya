@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Table Barang</h4>
           
          </div>
            <div class="card-body">
            <a class="btn btn-warning btn-sm" href="{{ route('barang.create') }}">Tambah</a> 
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th width="250px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($paginate as $brg)
                    <tr>
                    <td>{{ $brg ->nama_barang }}</td>
                    <td>{{ $brg ->harga }}</td>
                    <td>{{ $brg ->stok }}</td>
                    <td>{{ $brg ->keterangan }}</td>
                    <td><img style="width: 80px; height: 80px; overflow: hidden" class="rounded-circle" src="{{asset('storage/'.$brg->foto)}}"></td>
                    <td>
                      <form action="#" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('barang.show',$brg->nama_barang) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="#">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                         
                      </form> 
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              
                </div>
              </div>
            </div>
  </div>
  </div>
  </div>
  {{$paginate-> links()}}
@endsection