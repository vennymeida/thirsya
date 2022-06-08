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
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Id Barang
                      </th>
                      <th>
                        Nama Barang
                      </th>
                      <th>
                        Harga
                      </th>
                      <th >
                        Stok
                      </th>
                      <th >
                        Keterangan
                      </th>
                      <th >
                        Gambar
                      </th>
                      <th width="250px">
                        Aksi
                      </th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
      @endsection