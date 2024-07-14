@extends('layouts.appfront')

@section('title', 'kategori search')

@section('main')
  <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Kategori {{$kategori->nama_kategori}}</h2>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-12">
						<div class="product-info">
							
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<div class="tab-pane fade show active" id="man" role="tabpanel">
									<div class="tab-single">
										<div class="row">
											@foreach ($produks as $produk)
												<div class="col-xl-3 col-lg-4 col-md-4 col-12">
													<div class="single-product">
														<div class="product-img">
															<a href="product-details.html">
																<img class="default-img" src="{{ Storage::url('gambarproduk/'.$produk->path_gambar) }}" alt="#" style="height: 350px; width: 250px;">
															</a>
														</div>
														<div class="product-content">
															<h3>{{$produk->nama_produk}}</h3>
															<div class="product-price">
																<span>Rp. {{$produk->harga}}</span>
															</div>

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

														<form action="/keranjang" method="POST">
            											@csrf
															 <div>
							                                	<input type="text" class="form-control" name="harga" value="{{$produk->harga}}" hidden>
																<input type="text" class="form-control" name="id_produk" value="{{$produk->id}}" hidden>
																<input type="number" class="form-control" name="qty" placeholder="Qty">
							                            	</div><br>
							                                <div>
							                                	<button class="btn btn-primary" style="color: white;">Add Chart</button>
							                            	</div>
							                            </form>
							                         <?php } ?>

														</div>
													</div>
												</div>
											@endforeach
											
										</div>
									</div>
								</div>
						
							</div>
						</div>
					</div>

				</div>
            </div>
    </div>

@endsection

@push('scripts')

@endpush