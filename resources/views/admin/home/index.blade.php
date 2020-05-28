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
    <div class="col-md-6">
      <div class="info-box bg-gradient-warning">
        <div class="info-box-icon">
          <i class="fa fa-user-minus"></i>
        </div>
        <div class="info-box-content">
          <div class="info-box-text">Belum Absen</div>
          <div class="info-box-number">{{ $unAbsens->count() }}</div>

          <div class="progress">
            <div class="progress-bar" style="width: {{ ($unAbsens->count() / $users->count()) * 100 }}%"></div>
          </div>
          <div class="progress-description">
            {{ number_format(($unAbsens->count() / $users->count()) * 100 ,2) }}% dari keseluruhan Pegawai ({{ $users->count() }})
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="info-box bg-gradient-success">
        <div class="info-box-icon">
          <i class="fa fa-user-check"></i>
        </div>

        <div class="info-box-content">
          <div class="info-box-text">Sudah Absen</div>
          <div class="info-box-number">{{ $inAbsens->count() }}</div>

          <div class="progress">
            <div class="progress-bar" style="width: {{ ($inAbsens->count() / $users->count()) * 100 }}%"></div>
          </div>
          <div class="progress-description">
            {{ number_format(($inAbsens->count() / $users->count()) * 100 ,2) }}% dari keseluruhan Pegawai ({{ $users->count() }})
          </div>
        </div>
      </div>
    </div>
  </div>
  @admin
  <div class="card card-outline card-danger">
    <div class="card-header">
      <h3 class="card-title">Input Absensi</h3>
    </div>
    <form action="{{ route('absent.store') }}" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NIK</label>
              <select name="user" class="form-control select2 select2-primary" data-dropdown-css-class="select2-primary" required>
                @foreach($unAbsens as $item)
                  <option value="{{ $item->id }}">NIK: {{ $item->code }}, NAMA: {{ $item->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Jam Masuk Dan Keluar</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="text" class="form-control float-right" id="absensTime" name="time" value="7:30 - 16:00" readonly>
              </div>
              @error('time')
              <div class="text-danger" role="alert">
                <small>{{ $message }}</small>
              </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-xs">Simpan</button>
      </div>
    </form>
  </div>
  @endadmin
  <div class="row">
    <div class="col-md-6">
      <div class="card card-outline card-warning">
        <div class="card-header">
          <h3 class="card-title">Belum Absen</h3>
        </div>
        <div class="card-body table-responsive">
          <table id="notAbsens" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unAbsens as $item)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">Sudah Absen</h3>
        </div>
        <div class="card-body table-responsive">
          <table id="absens" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>lembur</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inAbsens as $item)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ \Carbon\Carbon::parse($item->absens->on)->format('H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->absens->off)->format('H:i:s') }}</td>
                <td>{{ $item->absens->over_time }} Jam</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>lembur</th>
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
      $('#notAbsens').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#absens').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });

      $('.select2').select2();

      $('#absensTime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        timePickerSeconds: false,
        timePicker24Hour: true,
        locale: {
          format: 'H:mm'
        }
      }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
      });
    });
  </script>
@endsection