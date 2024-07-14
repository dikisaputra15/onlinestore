@extends('layouts.appfront')

@section('title', 'All Keranjang')

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
								<h2>TOTAL KERANJANG</h2>
								<div class="content">
									<table class="table">
										<tr>
											<td>No</td>
											<td>Nama Produk</td>
											<td>Qty</td>
											<td>Harga</td>
											<td>Sub Total</td>
											<td>Action</td>
										</tr>

										@php($i = 1)
										@foreach ($keranjangs as $keranjang)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $keranjang->nama_produk }}</td>
											<td>{{ $keranjang->qty }}</td>
											<td>{{ $keranjang->harga }}</td>
											<td>{{ $keranjang->sub_total }}</td>
											<td>
												 <a href="/keranjang/delker/{{$keranjang->id}}" onclick="return confirm('Are you sure to delete this ?');" title="hapus">
				                                    X
				                                </a>
											</td>
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
							</div>
							
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<a href="/checkout" class="btn">Checkout</a>
									</div>
								</div>
							</div>
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