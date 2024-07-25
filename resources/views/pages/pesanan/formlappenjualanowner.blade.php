@extends('layouts.appowner')

@section('title', 'Form Lap Penjualan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Penjualan</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">filter Berdasarkan Tanggal</h2>

                <div class="card">
                    <form action="/pdfpenjualan" method="POST" target="__blank">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>

                            <div class="form-group">
                                <label>Sampai Dengan Tanggal</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
