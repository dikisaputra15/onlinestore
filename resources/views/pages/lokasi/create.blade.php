@extends('layouts.master')

@section('title','Form Tambah')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Form Tambah User</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('lokasi.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" required>
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" class="form-control" name="latitude" required>
                </div>
                  <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" class="form-control" name="longitude" required>
                </div>
                 <div class="form-group">
                    <label>image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection

@push('service')

@endpush
