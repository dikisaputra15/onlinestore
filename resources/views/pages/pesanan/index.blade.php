@extends('layouts.appfront')

@section('title', 'All Pesanan')

@section('main')
		<!-- Start Checkout -->

		<section class="shop checkout section mt-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-12">

					</div>
					<div class="col-lg-8 col-12">
						<h5>Pesanan</h5><br>
						<table class="table">
							<tr>
								<th>No</th>
								<th>Tgl Pesanan</th>
								<th>Nama Penerima</th>
								<th>No Hp</th>
								<th>Alamat</th>
								<th>Keterangan</th>
								<th>Action</th>
							</tr>
							 @php($i = 1)
                             @foreach ($pesanans as $pesan)
                             	<tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $pesan->tgl_pemesanan }}</td>
                                  <td>{{ $pesan->nama_penerima }}</td>
                                  <td>{{ $pesan->no_hp }}</td>
                                  <td>{{ $pesan->alamat }}</td>
                                  <td>{{ $pesan->keterangan }}</td>
                                  <td style="width: 200px;">

                                        <?php if($pesan->status == 'Unpaid'){ ?>
                                  		<a href="/invoice/{{$pesan->id}}/lihatinvoice"><u>Bayar</u></a>
                                        <?php }else{ ?>
                                            <a href="/invoice/{{$pesan->id}}/invoicedetail"><u>Invoice</u></a>
                                        <?php } ?>
										<?php if($pesan->keterangan == 'dikirim') { ?>
											<a href="/konfirmasi/update/{{$pesan->id}}"><u>Konfirmasi</u></a>
										<?php } ?>
                                  </td>
                                </tr>

                             @endforeach
						</table>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->

@endsection

@push('scripts')

@endpush
