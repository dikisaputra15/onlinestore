@extends('layouts.master')

@section('title','Dashboard')

@section('conten')

<div class="card">
    <div class="card-header bg-white">
        <h3 style="text-align: center;">Selamat Datang</h3>
        <h3 style="text-align: center;">Dashboard Go Service Sistem</h3>
    </div>
    <div class="card-body">
         <div class="row">

                <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$tempatservice}}</h3>

                <p>Tempat Service</p>
              </div>
              <div class="icon">
                 <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$unpaid}}</h3>

                <p>Pesanan dikerjakan</p>
              </div>
              <div class="icon">
                 <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$paid}}</h3>

                <p>Pesanan Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>

         </div>
    </div>
</div>


@endsection

@push('service')

@endpush
