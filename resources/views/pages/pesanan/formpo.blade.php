@extends('layouts.appfront')

@section('title', 'Form PO')

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
								<h2>LIST Purchase Order</h2>
								<div class="content">
									<table class="table">
										<tr>
											<td>No</td>
											<td>Nama Produk</td>
											<td>Harga</td>
											<td>Gambar</td>
										</tr>

										<tr>
											<td>#</td>
											<td>{{ $produk->nama_produk }}</td>
											<td>{{ $produk->harga }}</td>
											<td><img src="{{ Storage::url('gambarproduk/'.$produk->path_gambar) }}" style="width:60px; height:60px;"></td>
										</tr>
										
									</table>
								</div>

								<h2>Form Pengiriman</h2><br>
								<div class="content">
									<form action="/prosespo" method="POST">
            						@csrf
									
									<input type="text" name="harga" class="form-control" value="{{$produk->harga}}" hidden>
									<input type="text" name="id_produk" class="form-control" value="{{$produk->id}}" hidden>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<input type="text" name="nama_penerima" class="form-control" placeholder="Nama Penerima">
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<input type="number" name="qty" class="form-control" placeholder="QTY">
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<input type="text" name="no_hp" class="form-control" placeholder="No Handphone">
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<input type="text" name="alamat_lengkap" class="form-control" placeholder="Alamat Lengkap">
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