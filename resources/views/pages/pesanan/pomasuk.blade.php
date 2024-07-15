@extends('layouts.app')

@section('title', 'Po Masuk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Po Masuk</h1>
               
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Po Masuk</h2>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Po Masuk</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="/pomasuk">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pesanan</th>
                                        <th>Nama Penerima</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>

                                    @php($i = 1)
                                    @foreach ($pomasuks as $pesan)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $pesan->tgl_pemesanan }}</td>
                                            <td>{{ $pesan->nama_penerima }}</td>
                                            <td>{{ $pesan->no_hp }}</td>
                                            <td>{{ $pesan->alamat }}</td>
                                            <td>{{ $pesan->status }}</td>
                                            <td>{{ $pesan->keterangan }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="/pomasuk/update/{{$pesan->id}}"
                                                        class="btn btn-sm btn-info btn-icon">
                                                        <i class="fas fa-edit"></i>
                                                        Update
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                     @endforeach

                                    </table>
                                </div>
                                <div class="float-right">
                                    {{$pomasuks->withQueryString()->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
