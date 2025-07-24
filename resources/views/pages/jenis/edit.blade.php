@extends('layouts.master')

@section('title','Edit Jenis Kerusakan')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Edit Jenis Kerusakan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('jeniskerusakan.update', $jenis->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                 <div class="form-group">
                    <label>Jenis Kerusakan</label>
                    <input type="text" class="form-control" name="jenis_kerusakan" value="{{ $jenis->jenis_kerusakan }}">
                </div>

                <div class="form-group">
                    <label>Biaya</label>
                    <input type="text" class="form-control" name="biaya" value="{{ $jenis->biaya }}">
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
