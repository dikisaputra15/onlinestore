@extends('layouts.appfront')

@section('title', 'Invoice')

@push('style')
    <script type="text/javascript"
		src="{{config('midtrans.snap_url')}}"
    data-client-key="{{config('midtrans.client_key')}}"></script>
@endpush

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
							<h2>Invoice</h2>
							<div class="single-widget">
								<h2>LIST PESANAN</h2>
								<div class="content">
									<table class="table">
										<tr>
											<td>No</td>
											<td>Nama Produk</td>
											<td>Gambar</td>
											<td>Qty</td>
											<td>Harga</td>
											<td>Sub Total</td>
										</tr>

										@php($i = 1)
										@foreach ($details as $detail)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $detail->nama_produk }}</td>
											<td><img src="{{ Storage::url('gambarproduk/'.$detail->path_gambar) }}" style="width:60px; height:60px;"></td>
											<td>{{ $detail->qty }}</td>
											<td>{{ $detail->harga_bayar }}</td>
											<td>{{ $detail->sub_total }}</td>
										</tr>
										@endforeach
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>Total</td>
											<td>Rp.</td>
											<td>{{ $pesanan->total_bayar }}</td>
										</tr>
									</table>
								</div>

								<h2>Identitas Pengiriman</h2><br>
								<div class="content">

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<p>{{$pesanan->nama_penerima}}</p>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<p>{{$pesanan->no_hp}}</p>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12 col-12">
										<p>{{$pesanan->alamat}}</p>
										</div>
									</div>
								</div>

							</div>

                        <?php if($pesanan->status == 'Unpaid'){ ?>
                            <div class="single-widget get-button">
								<div class="content">

									<div class="button">
										<button class="btn" id="pay-button">Pilih Pembayaran</button>
									</div>

								</div>
							</div>
                        <?php }else{ ?>
                            <h3>Sudah dibayar</h3>
                        <?php } ?>

							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->

@endsection

@push('scripts')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function (result) {
          /* You may add your own implementation here */
            // alert("payment success!");
            window.location.href = '/pesanan'
            console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>
@endpush
