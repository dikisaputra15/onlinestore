@extends('layouts.appfront')

@section('title', 'Checkout')

@section('main')
		<!-- Start Checkout -->

		<section class="shop checkout section mt-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-12">

					</div>
					<div class="col-lg-8 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>LIST PESANAN</h2>
								<div class="content">
									<table class="table">
										<tr>
											<td>No</td>
											<td>Nama Produk</td>
											<td>Qty</td>
											<td>Harga</td>
											<td>Sub Total</td>
										</tr>

										@php($i = 1)
										@foreach ($keranjangs as $keranjang)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $keranjang->nama_produk }}</td>
											<td>{{ $keranjang->qty }}</td>
											<td>{{ $keranjang->harga }}</td>
											<td>{{ $keranjang->sub_total }}</td>
										</tr>
										@endforeach
										<tr>
											<td></td>
											<td></td>
											<td>Total</td>
											<td>Rp.</td>
											<td>{{ $total }}</td>
										</tr>
									</table>
								</div>

								<h2>Form Pengiriman</h2><br>
								<div class="content">
									<form action="/prosespesanan" method="POST">
            						@csrf
									<input type="text" name="total_bayar" class="form-control" value="{{$total}}" hidden>
									<div class="form-group">
										<div class="col-lg-12 col-12">
                                        <label>Nama Penerima</label>
										<input type="text" name="nama_penerima" class="form-control" required>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
                                        <label>No Handphone</label>
										<input type="text" name="no_hp" class="form-control" required>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
                                        <label>Alamat Lengkap</label>
										<input type="text" name="alamat_lengkap" class="form-control" required>
										</div>
									</div>
								</div>

							</div>

							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<button class="btn">Lanjut Pesan</button>
									</div>
								</div>
							</div>
						</form>
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->

@endsection

@push('scripts')

@endpush
