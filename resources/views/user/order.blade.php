@extends('layouts.layoutBerandaUser')
@section('content')
<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>WaroenkQu</p>
						<h1>Status Order</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<div class="cart-main-area mb-5">
    <div class="container">
        <h3 class="cart-page-title">Order Saat Ini</h3>
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive table-bordered">
                    <table class="w-100">
                        <thead>
                            <tr>
                            <tr>
                            <th>Proses Admin</th>
                                 <th>No. Invoice</th>
                                <!-- <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Subtotal</th> -->
                                <th>Cetak</th>
                                <th>Status</th>
                                <th>TOTAL</th> 
                            </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($orders as $order)
                            <tr class="bg-light">
                                <td class="py-2 px-5  font-weight-bold">
                                 
                                    @if ($order->bukti_pesanan == "")
                                    <span class="button button-warning py-2 px-3 my-1">Belum Bayar</span>
                                    </td><td>
                                        Tidak Ada Nomer Invoice
                                    @endif
                                    @if ($order->status_cart === '1' && $order->bukti_pesanan != "")
                                    <span class="button button-warning py-2 px-3 my-1">Proses Verifikasi Admin</span>
                                    </td><td>
                                    {{$order->kode}}
                                    @endif
                                    @if ($order->status_cart === '2' && $order->bukti_pesanan != "")
<span class="button button-success py-2 px-3 my-1">Pengiriman</span>
</td><td>
                                    {{$order->kode}}
                                    @endif
                                    <td>
                                @if ($order->bukti_pesanan == "")
                                    Tidak Bisa Cetak
                                    @endif
                                    @if ($order->status_cart === '1' && $order->bukti_pesanan != "")
                                    
                                    <a type="submit" href="{{route('order.cetak', $order->id_pesanans)}}" >Cetak</a>
                                    @endif
                                    @if ($order->status_cart === '2' && $order->bukti_pesanan != "")
                                   
                                    <a type="submit" href="{{route('order.cetak', $order->id_pesanans)}}" >Cetak</a>
                                    @endif
                                   
                                </td>
                                </td>
                               
                                
                                <td class="py-2 font-weight-bold ">
                                
                                    @if ($order->bukti_pesanan == "")
                                    <a href="{{route('showupload', $order->id_pesanans)}}">
                                       
                                        <span class="button button-danger py-2 px-3 my-1">Belum Bayar ( Upload )</span>
</a>
                                    @endif
                                    @if ($order->status_cart === '1' && $order->bukti_pesanan != "")
                                    
                                    <span class="button button-warning py-2 px-3 my-1">Verifikasi</span>
                                    @endif
                                    @if ($order->status_cart === '2' && $order->bukti_pesanan != "")
                                   
                                    <span class="button button-success py-2 px-3 my-1">Sudah Bayar</span>
                                    @endif
                                
                                </td>
                               
                                <td class="py-2 font-weight-bold">Rp {{ number_format($order->jumlah_harga, 0, ',', '.')}}</td>
                            </tr>
                            @endforeach
                            
                            
                           
							
						</table>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- cart area end -->
@endsection
