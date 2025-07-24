@extends('layouts.master')

@section('title','Form Tambah')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Form Tambah Jenis Kerusakan</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('jeniskerusakan.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Jenis Kerusakan</label>
                    <input type="text" class="form-control" name="jenis_kerusakan" required>
                </div>
                 <div class="form-group">
                    <label>Biaya</label>
                    <input type="text" class="form-control" name="biaya" required>
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
