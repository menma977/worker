@extends('layouts.app')

@section('title')
@endsection

@section('content')
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