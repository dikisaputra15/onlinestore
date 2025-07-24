@extends('layouts.master')

@section('title','Data Lokasi')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Data Lokasi</h3>
    </div>
    <div class="card-body">
    <a href="{{route('lokasi.create')}}" class="btn btn-primary">Add New</a>
    <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>Nama Toko</th>
                        <th>Phone</th>
                        <th>Alamat</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Image</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($lokasi as $lok)
                    <tr>
                        <td>{{$lok->name}}</td>
                        <td>{{$lok->phone}}</td>
                        <td>{{$lok->alamat}}</td>
                        <td>{{$lok->latitude}}</td>
                        <td>{{$lok->longitude}}</td>
                        <td><img src="{{  Storage::url($lok->image) }}" style="width:60px; height:60px;"></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href='{{ route('lokasi.edit', $lok->id) }}'
                                    class="btn btn-sm btn-info btn-icon">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>

                                <form action="{{ route('lokasi.destroy', $lok->id) }}" method="POST"
                                    class="ml-2">
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <input type="hidden" name="_token"
                                        value="{{ csrf_token() }}" />
                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete" onclick="return confirm('Are you sure to delete this ?');">
                                        <i class="fas fa-times"></i> Delete
                                    </button>
                                </form>
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
