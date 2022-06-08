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
                      <th width="250px">
                        Total
                      </th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
      @endsection