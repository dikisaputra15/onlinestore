@extends('layouts.master')

@section('title','Invoice')

@section('conten')

<x-alert></x-alert>
<div class="card" id="invoiceArea">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h3>Form Lapor By Date Range</h3>
    </div>
    <div class="card-body">
          <div class="card">
                    <form action="{{url('pdfpenjualan')}}" method="POST" target="__blank">
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
