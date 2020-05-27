@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Absent
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
          Absent
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
          <h3 class="card-title">List Absens Bulan: {{ $dateSet }}</h3>
        </div>
        <div class="card-body table-responsive">
          <div class="callout callout-danger">
            <h5>Temukan Berdasarkan Bulan Dan Tahun</h5>

            <form action="{{ route('absent.show') }}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <select name="time" class="form-control select2 select2-primary" data-dropdown-css-class="select2-primary" required>
                      @foreach($absenFinder as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-block btn-info">Find</button>
                </div>
              </div>
            </form>
          </div>
          <table id="listUser" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Masuk Jam</th>
              <th>Keluar Jam</th>
              <th>Gaji</th>
              <th>Lembur</th>
              <th>Tanggungan</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($absens as $item)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->user->code }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->on }}</td>
                <td>{{ $item->off }}</td>
                <td>Rp {{ number_format($item->salary->salary, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->salary->over_time, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->salary->benefit, 0, ',', '.') }}</td>
                <td>
                  <button type="button" class="btn btn-block btn-warning btn-xs" data-toggle="modal" data-target="#modal-pop{{ $loop->index + 1 }}">
                    Edit
                  </button>
                </td>
              </tr>
              <div class="modal fade" id="modal-pop{{ $loop->index + 1 }}">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Absensi</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Jam Masuk Dan Keluar</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                          </div>
                          <input type="text" class="form-control float-right" id="absensTime{{ $item->id }}" name="time" value="7:30 - 16:00" readonly>
                        </div>
                        @error('time')
                        <div class="text-danger" role="alert">
                          <small>{{ $message }}</small>
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                      <button type="submit" id="save{{ $item->id }}" class="btn btn-outline-light">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th style="width: 10px">#</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Masuk Jam</th>
              <th>Keluar Jam</th>
              <th>Gaji</th>
              <th>Lembur</th>
              <th>Tanggungan</th>
              <th>Edit</th>
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

      @foreach($absens as $item)
      $("#save{{ $item->id }}").click(function () {
        fetch('{{ route('absent.update', $item->id) }}', {
          method: 'POST',
          headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content'),
            'Content-Type' : 'application/json',
          },
          body: JSON.stringify({
            time : $('#absensTime{{ $item->id }}').val(),
          })
        }).then(responseJson => {
          return responseJson.json();
        }).then(response => {
          toastr.success(response.message);
          setTimeout(function () {
            location.reload();
          }, 1000);
        }).catch(error => {
          console.log(error.message);
          toastr.error('An error occurred while saving');
        });
      });

      $('#absensTime{{ $item->id }}').daterangepicker({
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
      @endforeach
    });
  </script>
@endsection