@extends('layouts.master')

@section('title','Data Jenis Kerusakan')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Data Jenis Kerusakan</h3>
    </div>
    <div class="card-body">
    <a href="{{route('jeniskerusakan.create')}}" class="btn btn-primary">Add New</a>
    <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>No</th>
                        <th>Jenis Kerusakan</th>
                        <th>Biaya</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                   @php
                       $no = 1;
                   @endphp
                  @foreach ($jenis as $jen)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{$jen->jenis_kerusakan}}</td>
                        <td>{{$jen->biaya}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href='{{ route('jeniskerusakan.edit', $jen->id) }}'
                                    class="btn btn-sm btn-info btn-icon">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>

                                <form action="{{ route('jeniskerusakan.destroy', $jen->id) }}" method="POST"
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
