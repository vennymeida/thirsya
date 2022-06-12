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
            <a class="btn btn-warning btn-sm" href="{{ route('cetak_transaksi') }}">Cetak PDF</a>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Id Transaksi
                      </th>
                      <th>
                        Id Barang
                      </th>
                      <th>
                        Id Pembeli
                      </th>
                      <th>
                        Jumlah
                      </th>
                      <th>
                        Total
                      </th>
                      <th width="250px">
                        Aksi
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($paginate as $trn)
                    <tr>
                    <td>{{ $trn ->id }}</td>
                    <td>{{ $trn ->barangs->id }}</td>
                    <td>{{ $trn ->users->id }}</td>
                    <td>{{ $trn ->jumlah }}</td>
                    <td>{{ $trn ->total }}</td>
                    <td>
                      <form action="{{ route('transaksi.destroy',['transaksi'=>$trn->id]) }}" method="POST">
                        <a class="btn btn-primary btn-sm" href="{{ route('transaksi.edit',$trn->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$trn->id}} akan dihapus?')">Delete</button>
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