<!DOCTYPE html>
<html lang="en">
   <head>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<!-- google font -->
		<link href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700') }}" rel="stylesheet">
		<link href="{{ url('https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap') }}" rel="stylesheet">
		<!-- fontawesome -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/all.min.css') }}">
		<!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/vendor/plugins.min.css"> -->
		<!-- bootstrap -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/app.css') }}">
		<!-- owl carousel -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/owl.carousel.css') }}">
		<!-- magnific popup -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/magnific-popup.css') }}">
		<!-- animate css -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/animate.css') }}">
		<!-- mean menu css -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/meanmenu.min.css') }}">
		<!-- main style -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/main.css') }}">
		<!-- responsive -->
		<link rel="stylesheet" href="{{ URL::asset('asset/css/responsive.css') }}">
		<!-- jquery -->
		<script src="{{ URL::asset('asset/js/jquery-1.11.3.min.js') }}"></script>
		<!-- bootstrap -->
		<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<!-- count down -->
		<script src="{{ URL::asset('asset/js/jquery.countdown.js') }}"></script>
		<!-- isotope -->
		<script src="{{ URL::asset('asset/js/jquery.isotope-3.0.6.min.js') }}"></script>
		<!-- waypoints -->
		<script src="{{ URL::asset('asset/js/waypoints.js') }}"></script>
		<!-- owl carousel -->
		<script src="{{ URL::asset('asset/js/owl.carousel.min.js') }}"></script>
		<!-- magnific popup -->
		<script src="{{ URL::asset('asset/js/jquery.magnific-popup.min.js') }}"></script>
		<!-- mean menu -->
		<script src="{{ URL::asset('asset/js/jquery.meanmenu.min.js') }}"></script>
		<!-- sticker js -->
		<script src="{{ URL::asset('asset/js/sticker.js') }}"></script>
		<!-- main js -->
		<script src="{{ URL::asset('asset/js/main.js') }}"></script>
	</head>

	<body>
	@include('sweetalert::alert')
		<!--PreLoader-->
		<div class="loader">
			<div class="loader-inner">
				<div class="circle"></div>
			</div>
    	</div>
    <!--PreLoader Ends-->
		<!-- header -->
		<div class="top-header-area" id="sticker">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 text-center">
						<div class="main-menu-wrap">

							<!-- menu start -->
							<nav class="main-menu">
								<ul>
									<li><a href="{{route('berandaindex')}}" method="post">Home</a></li>
										<li><a href="{{route('berandaabout')}}" method="post">About</a></li>
										<li><a href="{{route('berandashop')}}" method="post">Shop</a></li>

										@if (Route::has('login'))
												<li class="nav-item">
													<a class="nav-link" href="/login">{{ __('Login') }}</a>
												</li>
										@endif
										@if (Route::has('register'))
												<li class="nav-item">
													<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
												</li>
											@endif

								<li>
									<!-- <div class="header-icons">
										<a class="shopping-cart" href="#" method="post"><i class="fas fa-shopping-cart"></i></a>
									</div> -->
								</li>
								</ul>
							</nav>
							<div class="mobile-menu"></div>
							<!-- menu end -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end header -->

		@yield('content')
		<!-- footer -->
	<div class="footer-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="footer-box about-widget">
							<h2 class="widget-title">About us</h2>
							<p>WaroenkQu merupakan ecommerce yang menyediakan berbagai sembako.</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-box get-in-touch">
							<h2 class="widget-title">Get in Touch</h2>
							<ul>
								<li>Bersama WaroenkQu Membangun Kebahagiaan</li>
								<li>WaroenkQu@WaroenkQu.com</li>
								<li>+62 123 456 7890</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="footer-box pages">
							<h2 class="widget-title">Pages</h2>
							<ul>
								<li><a href="{{route('berandaindex')}}" method="post">Home</a></li>
								<li><a href="{{route('berandaabout')}}"  method="post">About</a></li>
								<li><a href="{{route('berandashop')}}" method="post">Shop</a>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end footer -->

		<!-- copyright -->
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<p>Copyrights &copy; 2022 - <a href="#">WaroenkQu</a>,  All Rights Reserved.<br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
	<!-- end copyright -->