@extends('layouts.app')

@section('title')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Edit
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="#">
            Edit
          </a>
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title">Edit Gaji</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('salary.update')}}" method="post">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Edit Gaji</label>
                        <input type="number" class="form-control" id="salary" name="salary" placeholder="Gaji" value="{{ old('salary') ? old('salary') : $salary->salary }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Edit Lembur</label>
                        <input type="number" class="form-control" id="over_time" name="over_time" placeholder="Lembur" value="{{ old('over_time') ? old('over_time') : $salary->over_time }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Edit Tunjangan</label>
                        <input type="number" class="form-control" id="banefit" name="benefit" placeholder="Tunjangan" value="{{ old('benefit') ? old('benefit') : $salary->benefit }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script>
    $(function () {
      $('#absens').DataTable({
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