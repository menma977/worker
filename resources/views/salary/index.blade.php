@extends('layouts.app')

@section('title')
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
            <form role="form">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Edit Gaji</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Gaji">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Edit Lembur</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Lembur">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Edit Tunjangan</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Tunjangan">
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