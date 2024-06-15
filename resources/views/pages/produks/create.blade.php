@extends('layouts.app')

@section('title', 'Produk Forms')

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
                <h1>Produk Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Produk</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Produk</h2>

                <div class="card">
                    <form action="{{ route('produk.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id_kategori">
                                        <option>-Pilih Katgeori-</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" required>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control" name="stok" required>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" required>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <input type="text" class="form-control" name="deskripsi_produk" required>
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar" required>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
