@extends('layouts.layoutBerandaUser')
@section('content')
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>WaroenkQu</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Alamat
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        	<form method="POST" id="finalize" action="/finish" enctype="multipart/form-data">
										@csrf
						        		<p><input type="text" name="name" placeholder="Name" required></p>
						        		<p><input type="email" name="email" placeholder="Email" required></p>
						        		<p><input type="text" name="address" placeholder="Address" required></p>
						        		<p><input type="tel" name="telephone" placeholder="Phone" required></p>
						        		<p><textarea name="bill" id="bill" cols="30" rows="10" placeholder="Say Something" required></textarea></p>
						        	</form>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>Product</td>
									<td>Total</td>
								</tr>
								@foreach($cart as $carts)
								<tr>
                                <td>{{ $carts->Barang->nama_barang }}</td>
                                <td>Rp {{ number_format($carts->Barang->harga) }}</td>
								
								</tr>
								@endforeach

								
							</tbody>
							<tbody class="checkout-details">
								
								
								<tr>
									<td>Total</td>
                                    <td>Rp. {{ number_format($pesanans->jumlah_harga) }}</td>
								</tr>
							</tbody>
						</table>
						<input type="submit" form="finalize" class="boxed-btn" value="Place Order">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->
    @endsection