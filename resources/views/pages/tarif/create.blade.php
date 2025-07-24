@extends('layouts.master')

@section('title','Form Tambah')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Form Tambah Tarif</h3>
    </div>
    <div class="card-body">
    <form action="{{ route('tarif.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Harga Tarif Antar</label>
                    <input type="text" class="form-control" name="tarif" required>
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
