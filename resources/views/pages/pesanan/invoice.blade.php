@extends('layouts.master')

@section('title','Invoice')

@section('conten')

<x-alert></x-alert>
<div class="card" id="invoiceArea">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h3>Invoice</h3>

    </div>
    <div class="card-body">
        <table>
            <tr>
                <td>Tempat Service</td>
                <td>:</td>
                <td>{{$dat->name}}</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td>{{$dat->nama_pelanggan}}</td>
            </tr>
            <tr>
                <td>Jenis Kerusakan</td>
                <td>:</td>
                <td>{{$dat->jenis_kerusakan}}</td>
            </tr>
            <tr>
                <td>Biaya</td>
                <td>:</td>
                <td>{{$dat->biaya}}</td>
            </tr>
            <tr>
                <td>Jasa Antar</td>
                <td>:</td>
                <td>{{$dat->nama_jasa}}</td>
            </tr>
            <tr>
                <td>Tarif Jemput</td>
                <td>:</td>
                <td>{{$dat->tarif_antar}}</td>
            </tr>
            <tr>
                <td>Total Bayar</td>
                <td>:</td>
                <td>{{$dat->total_biaya}}</td>
            </tr>
        </table>
        <button onclick="printInvoice()" class="btn btn-primary btn-sm">🖨 Cetak Invoice</button>
    </div>
</div>
@endsection

@push('service')
<script>
    function printInvoice() {
        const printContents = document.getElementById('invoiceArea').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Refresh untuk mengembalikan event dan JS
        location.reload();
    }
</script>
<style>
    @media print {
        button {
            display: none !important;
        }
    }
</style>
@endpush
