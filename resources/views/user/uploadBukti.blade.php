@extends('layouts.layoutBerandaUser')
@section('content')
<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>WaroenkQu</p>
						<h1>Upload Bukti</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->
<!-- Shop details Area start -->
<br><br>
<section class="product-details-area mb-5">
    <div class="container">
        <div class="row">
            @if (Session::has('error'))
            <div class="col-12">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif

            <div class="col-md-6 mb-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">No. Invoice</div>
                            <div class="col-md-8 font-weight-bold">{{$data->id_pesanans}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Tanggal</div>
                            <div class="col-md-8 font-weight-bold">{{$data->tanggal}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">TOTAL</div>
                            <div class="col-md-8 font-weight-bold">Rp {{ number_format($data->jumlah_harga, 0, ',', '.')}}</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Form Upload Bukti Pembayaran
                    </div>
                    <div class="card-body">
                        <form action="{{route('uploadBukti') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_pesanans" value="{{$data->id_pesanans}}">
                            <div class="form-group">
                                <label for="bukti_pesanan">Upload File</label>
                                <input type="file" class="form-control @error('bukti_pesanan') is-invalid @enderror" name="bukti_pesanan" id="bukti_pesanan">
                                @error('bukti_pesanan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop details Area End -->

@endsection
