@extends('layouts.master')

@section('title','Edit Tarif')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Edit Tarif</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('tarif.update', $tarif->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                 <div class="form-group">
                    <label>Harga Tarif Antar</label>
                    <input type="text" class="form-control" name="tarif" value="{{ $tarif->tarif_antar }}">
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
