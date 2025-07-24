@extends('layouts.master')

@section('title','User')

@section('conten')

<x-alert></x-alert>
<div class="card">
    <div class="card-header bg-white">
        <h3>Data User</h3>
    </div>
    <div class="card-body">
    <a href="{{route('user.create')}}" class="btn btn-primary">Add New</a>
    <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href='{{ route('user.edit', $user->id) }}'
                                    class="btn btn-sm btn-info btn-icon">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>

                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
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
