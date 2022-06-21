@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Table Transaksi Pembelian</h4>
              </div>
              <div class="card-body">
            <a class="btn btn-warning btn-sm" href="{{ route('transaksi.cetak') }}">Cetak PDF</a>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Invoice</th>
                      <th>Nama Pembeli</th>
                      <th>Jumlah Harga</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th width="300px">Aksi</th>
                    </thead>
                    <tbody>
                    @foreach ($paginate as $trn)
                    <tr>
                    <td>{{ $trn ->kode }}</td>
                    <td>{{ $trn ->user->name }}</td>
                    <td>{{ $trn ->jumlah_harga }}</td>
                    <td>{{ $trn ->status_pesanan->nama_status }}</td>
                    <td>{{ $trn ->tanggal }}</td>
                    <td>
                 
                 
            
                    @if($trn->status_cart == '2')
                    <form action="{{ route('transaksi.update',['transaksi'=>$trn->id_pesanans]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah {{$trn->id_pesanans}} sudah terbayar?')">Belum Terbayar</button>
                    
                    @else
                    <form action="{{ route('transaksi.update',['transaksi'=>$trn->id_pesanans]) }}" method="POST">
                       @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-succcess btn-sm" onclick="return confirm('Apakah {{$trn->id_pesanans}} sudah terbayar?')">Terbayar</button>
                  
                  @endif
                  <a class="btn btn-primary btn-sm" href="{{ route('transaksi.show',$trn->id_pesanans)}}">Show</a>
                  </form> 
                      <form action="{{ route('transaksi.destroy',['transaksi'=>$trn->id_pesanans]) }}" method="POST">
                    
                     
                        
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$trn->id_pesanans}} akan dihapus?')">Delete</button>
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
          {{ $paginate->links()}}
      @endsection