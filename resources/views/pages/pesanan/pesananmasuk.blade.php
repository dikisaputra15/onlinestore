@extends('layouts.master')

@section('title','Data Lokasi')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Data Pesanan Masuk</h3>
    </div>
    <div class="card-body">

    <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>Tempat Service</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kerusakan</th>
                        <th>Biaya</th>
                        <th>Jasa Antar</th>
                        <th>Tarif Jemput</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $no=1;
                    @endphp
                  @foreach ($data as $dat)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$dat->name}}</td>
                        <td>{{$dat->nama_pelanggan}}</td>
                        <td>{{$dat->jenis_kerusakan}}</td>
                        <td>{{$dat->biaya}}</td>
                        <td>{{$dat->nama_jasa}}</td>
                        <td>{{$dat->tarif_antar}}</td>
                        <td>{{$dat->total_biaya}}</td>
                        <td>{{$dat->status}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <?php if($dat->status != 'selesai') {?>
                                <a href="/pesan/{{$dat->id}}/updatestatus"
                                    class="btn btn-sm btn-info">
                                    update status
                                </a>
                                <?php }else{ ?>
                                    <p>selesai</p>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                @endforeach
                  </tbody>
    </table>
    </div>
</div>


@endsection

@push('service')
<script>
  $(function () {
    $("#example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush
