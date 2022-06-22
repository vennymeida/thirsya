@extends('layouts.layoutBerandaUser')
@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>WaroenkQu</p>
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									
									<th class="product-image">Product Image</th>
									<th class="product-name">Nama Barang</th>
                                    <th class="product-name">Harga Satuan</th>
									<th class="product-price">Quantitas</th>
                                    <th class="product-total">Harga Total</th>
									<th class="product-total">Aksi</th>
								</tr>
							</thead>
							<tbody>
                            @foreach($cart as $isiKeranjang)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/'.$isiKeranjang->Barang->foto)}}" width="100" height="65" alt="...">
                                </td>
                                <td>{{ $isiKeranjang->Barang->nama_barang }}</td>
                                <td>Rp {{ number_format($isiKeranjang->Barang->harga) }}</td>
                                <td>{{ $isiKeranjang->jumlah }}</td>
                                <td>Rp. {{ number_format($isiKeranjang->jumlah_harga) }}</td>
                                <td>
                                    <form action="{{ url('cart') }}/{{ $isiKeranjang->id_cart }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ?');"><i class="bi bi-trash"></i>Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
								
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td>Rp. {{ number_format($pesanans->jumlah_harga) }}</td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<a href="{{route('checkout')}}" class="boxed-btn black">Check Out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->
    @endsection