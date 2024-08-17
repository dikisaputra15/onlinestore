@extends('layouts.appfront')

@section('title', 'Hompe Page')

@section('main')

<!-- Slider Area -->
<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>Selamat </span>Datang</h1>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->

	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">

				<div class="col-12">
					<div class="section-title">
						<h2>Produk Baru</h2>
					</div>
				</div>

			@foreach ($produks as $produk)
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{ Storage::url('gambarproduk/'.$produk->path_gambar) }}" style="height: 370px; width: 600px;">
						<div class="content">
							<p>Produk Baru</p>
							<h3>{{$produk->nama_produk}}</h3>
							<p style="color:white;">Deskripsi:</p>
							<p style="color:white;">{{$produk->deskripsi_produk}}</p>
							<p>Rp. {{$produk->harga}}</p>
							<?php if($produk->stok < 1){ ?>

								<div class="row">
									<div class="col-lg-3">
										<input type="text" class="form-control" name="harga" value="{{$produk->harga}}" hidden>
										<input type="text" class="form-control" name="id_produk" value="{{$produk->id}}" hidden>
									</div>
									<div class="col-lg-9">
										<a href="/po/{{$produk->id}}/formpo" class="btn" style="color: white;">PO</a>
									</div>
									<div>
										<p style="color: red;">Produk Habis Silahkan PO</p>
									</div>
								</div>

						<?php }else{ ?>
							<form action="/keranjangnew" method="POST">
            					@csrf
								<div class="row">
									<div class="col-lg-3">
										<input type="text" class="form-control" name="harga" value="{{$produk->harga}}" hidden>
										<input type="text" class="form-control" name="id_produk" value="{{$produk->id}}" hidden>
										<input type="number" class="form-control" name="qty" placeholder="Qty">
									</div>
									<div class="col-lg-9">
										<button class="btn btn-primary" style="color: white;">Add Chart</button>
									</div>
								</div>
							</form>
						<?php } ?>
						</div>
					</div>
				</div>
			@endforeach

			</div>
		</div>

	</section>
	<!-- End Small Banner -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Item</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">

						@foreach ($items as $item)
						<div class="single-product">
                            <div class="product-img">
                                <a href="#">
                                    <img class="default-img" src="{{ Storage::url('gambarproduk/'.$item->path_gambar) }}" alt="#" style="height: 350px; width: 250px;">
                                </a>
                            </div>
                            <div class="product-content">
                                <h3>{{$item->nama_produk}}</h3>
                                <p>Deskripsi:</p>
                                <p>{{$item->deskripsi_produk}}</p>
                                <div class="product-price">
                                    <span>Rp. {{$item->harga}}</span>
                                </div>
                            <?php if($item->stok < 1){ ?>

								<div class="row">
									<div>
										<input type="text" class="form-control" name="harga" value="{{$produk->harga}}" hidden>
										<input type="text" class="form-control" name="id_produk" value="{{$produk->id}}" hidden>
									</div>
									<div>
										<a href="/po/{{$item->id}}/formpo" class="btn btn-primary" style="color: white;">PO</a>
									</div>
								</div>
									<div>
										<p style="color: red;">Produk Habis Silahkan PO</p>
									</div>

						<?php }else{ ?>
                                <form action="/keranjang" method="POST">
            						@csrf
	                                <div>
	                                	<input type="text" class="form-control" name="harga" value="{{$item->harga}}" hidden>
										<input type="text" class="form-control" name="id_produk" value="{{$item->id}}" hidden>
										<input type="number" class="form-control" name="qty" placeholder="Qty">
	                            	</div><br>
	                                <div>
	                                	<button class="btn btn-primary" style="color: white;">Add Chart</button>
	                            	</div>
                            	 </form>
                            <?php } ?>
                            </div>
                        </div>
						@endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->

	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

@endsection

@push('scripts')

@endpush
