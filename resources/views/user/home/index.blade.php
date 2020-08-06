@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Home
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="#">
            Home
          </a>
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="info-box elevation-2">
        <span class="info-box-icon bg-success">
          <i class="fas fa-user-check"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Masuk Kerja</span>
          <span class="info-box-number">{{ $absens->count() }}</span>
        </div>
      </div>
    </div>
    {{-- <div class="col-md-6">
      <div class="info-box elevation-2">
        <span class="info-box-icon bg-info">
          <i class="fas fa-hand-holding-usd"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Total Gaji</span>
          <span class="info-box-number">Rp {{ number_format($absens->sum('salary.total'), 2, ',', '.') }}</span>
        </div>
      </div>
    </div> --}}
    <div class="col-md-12">
      <div class="card card-outline card-danger elevation-2">
        <div class="card-header">
          <h3 class="card-title">Detail Absens Bulan Ini</h3>
        </div>
        <div class="card-body table-responsive">
          <table id="absens" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Absen (Jam)</th>
              <th>Keluar (Jam)</th>
              <th>Lembur (Jam)</th>
              {{-- <th>Gaji</th>
              <th>Tunjang</th>
              <th>Lembur</th>
              <th>Total</th> --}}
            </tr>
            </thead>
            <tbody>
            @foreach($absens as $item)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->on }}</td>
                <td>{{ $item->off }}</td>
                <td>{{ $item->over_time }} Jam</td>
                {{-- <td>Rp {{ number_format($item->salary->salary, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($item->salary->benefit, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($item->salary->over_time, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($item->salary->total, 2, ',', '.') }}</td> --}}
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th style="width: 10px">#</th>
              <th>Absen (Jam)</th>
              <th>Keluar (Jam)</th>
              <th>Lembur (Jam)</th>
              {{-- <th>Gaji</th>
              <th>Tunjang</th>
              <th>Lembur</th>
              <th>Total</th> --}}
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