@extends('layouts.layoutBerandaUser')
@section('content')
<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			
			@foreach($barangs as $brg)
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="shop/{{$brg->id}}"><img src="{{asset('storage/'.$brg->foto)}}" alt=""></a>
						</div>
						<h3>{{$brg->nama_barang }}</h3>
						<p class="product-price"> {{$brg->harga }} </p>
						<a href="add-to-cart/{{$brg->id}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
			</div>
			@endforeach

			
		</div>
	</div>
	<!-- end products -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->
    @endsection