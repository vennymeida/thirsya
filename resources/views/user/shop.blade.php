@extends('layouts.layoutBerandaUser')
@section('content')
<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Ngalamware</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- products -->
	<div class="product-section mt-100 mb-50">
		<div class="container">
			
			<div class="row product-lists justify-content">
				@foreach($barangs as $brg)
					<div class="col-md-3 mb-10 text-center strawberry ">
						<div class="single-product-item card shadow p-4 mb-5 bg-white" style="width: 295px; text-decoration:none; color:black; border-radius: 50px;">
							<div class="product-image">
								<a href="shop/{{$brg->id}}"><img src="{{asset('storage/'.$brg->foto)}}" class="card-img-top" height="175px" alt=""></a>
							</div>
							<h3>{{$brg->nama_barang }}</h3>
							<p class="product-price">Rp. {{$brg->harga }} </p>
							<form method="post" action="{{ url('add-to-cart') }}/{{ $brg->id }}" >
                                            @csrf
												<input type="text" name="jumlah_pesan" class="form-control" required="">
                                                <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                            </form>
							
						</div>
					</div>
				@endforeach
			</div>
			

			
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