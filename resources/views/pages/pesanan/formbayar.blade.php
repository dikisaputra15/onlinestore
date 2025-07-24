@extends('layouts.appfront')

@section('title', 'Form Bayar')

@push('style')

@endpush

@section('main')
<x-alert></x-alert>
<main class="main">

    <section id="about" class="about section">
      <div class="container">
        <div class="row">
            <h2 style="text-align: center;">Form Bayar</h2>
             <div class="form-group">
                <div class="col-lg-12">
                    <label>Nama Pelanggan : {{$order->nama_pelanggan}}</label>
                </div>
            </div>

             <div class="form-group">
                <div class="col-lg-12">
                    <label>Total Bayar : {{$order->total_biaya}}</label>
                </div>
            </div>

            <form action="{{ url('proses-pembayaran') }}" method="POST">
            @csrf
             <div class="form-group">
                 <div class="col-lg-12">
                    <label for="petugas" class="form-label">Metode Pembayaran</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="metode_pembayaran" value="Cash"
                                                class="selectgroup-input" checked="">
                                <span class="selectgroup-button">CASH</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="metode_pembayaran" value="Qris"
                                                class="selectgroup-input">
                                <span class="selectgroup-button">QRIS</span>
                            </label>
                        </div>
                    </div>
            </div>

             <div class="form-group">
                <input type="text" name="order_id" value="{{$order->id}}" hidden>
                <input type="text" name="total_bayar" value="{{$order->total_biaya}}" hidden>
                <button class="btn btn-primary">Bayar</button>
             </div>

        </form>
      </div>
      </div>

    </section>

  </main>

@endsection

@push('scripts')
<script>
  $(function () {
    $("#example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush
