@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Users
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">
          <a href="{{ route('home') }}">
            Home
          </a>
        </li>
        <li class="breadcrumb-item">
          Users
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h3 class="card-title">List User</h3>
        </div>
        <div class="card-body table-responsive">
          <table id="listUser" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Action</th>
              <th>Di Buat Tanggal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $item)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-info">
                      Edit
                    </a>
                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning">
                      {{ $item->suspand == 1 ? 'unsuspand' : 'suspand' }}
                    </a>
                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-danger">
                      Delete
                    </a>
                  </div>
                </td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Action</th>
              <th>Di Buat Tanggal</th>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(function () {
      $('#listUser').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>
@endsection