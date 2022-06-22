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
            <form class="form" method="get" action="{{route('searchBarang')}}">
              <div class="form-group w-100 mb-3">
                  <input type="text" name="searchBarang" class="form-control w-80 d-inline" id="searchBarang" placeholder="Search Barang...">
              </div>
          </form>
          @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <p>{{ $message }}</p>
          </div>
          @endif
            <div class="card-body">
            <a class="btn btn-danger btn-sm" href="{{ route('barang.index') }}">Refresh</a>
            <a class="btn btn-warning btn-sm" href="{{ route('barang.create') }}">Tambah</a> 

            @foreach($kategori as $item)
                <a href="{{ route('list.withCategory', $item->id)}}" class="btn btn-primary btn-sm">{{$item->nama}}</a>
            @endforeach
       
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th width="250px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; ?>
                    @foreach ($barangs as $brg)
                    <tr>
                      <td>{{$no++}}</td>
                    <td>{{ $brg ->Kategori -> nama}}</td>
                    <td>{{ $brg ->nama_barang }}</td>
                    <td>{{ $brg ->harga }}</td>
                    <td>{{ $brg ->stok }}</td>
                    <td>{{ $brg ->keterangan }}</td>
                    <td><img style="width: 80px; height: 80px; overflow: hidden" class="rounded-circle" src="{{asset('storage/'.$brg->foto)}}"></td>
                    <td>
                      <form action="{{ route('barang.destroy',['barang'=>$brg->nama_barang]) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('barang.show',$brg->nama_barang) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('barang.edit',$brg->nama_barang) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$brg->nama_barang}} akan dihapus?')">Delete</button>
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

  {{$paginate->links()}}
@endsection