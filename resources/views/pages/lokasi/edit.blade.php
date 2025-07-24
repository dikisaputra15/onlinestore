@extends('layouts.master')

@section('title','Edit Lokasi')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Edit Lokasi</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('lokasi.update', $lokasi->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                 <div class="form-group">
                    <label>Nama Toko</label>
                    <input type="text" class="form-control" name="name" value="{{ $lokasi->name }}">
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $lokasi->phone }}">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="{{ $lokasi->alamat }}">
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" class="form-control" name="latitude" value="{{ $lokasi->latitude }}">
                </div>
                  <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" class="form-control" name="longitude" value="{{ $lokasi->longitude }}">
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
