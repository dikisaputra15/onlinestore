@extends('layouts.app')

@section('title', 'Edit Produk')

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h1>Edit Produk</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Produk</h2>



                <div class="card">
                    <form action="{{ route('produk.update', $produk) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id_kategori">
                                    <?php
                                        foreach ($kategoris as $kategori) {

                                        if ($kategori->id==$produk->id_kategori) {
                                            $select="selected";
                                        }else{
                                            $select="";
                                        }

                                     ?>
                                        <option <?php echo $select; ?> value="<?php echo $kategori->id;?>"><?php echo $kategori->nama_kategori; ?></option>

                                     <?php } ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" value="{{ $produk->nama_produk }}">
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control" name="stok" value="{{ $produk->stok }}">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" value="{{ $produk->harga }}">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <input type="text" class="form-control" name="deskripsi_produk" value="{{ $produk->deskripsi_produk }}">
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                                <input type="text" class="form-control" name="old_file" value="{{ $produk->path_gambar }}" hidden>
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
