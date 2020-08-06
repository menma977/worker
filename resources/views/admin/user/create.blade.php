@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Create Users
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">
          <a href="{{ route('home') }}">
            Home
          </a>
        </li>
        <li class="breadcrumb-item active">
          <a href="{{ route('user.index') }}">
            Users
          </a>
        </li>
        <li class="breadcrumb-item">
          Create
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-danger card-outline">
        <form role="form" method="post" action="{{ route('user.store') }}">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="code">NIK</label>
              <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Enter NIK" value="{{ old('code') }}">
              @error('code')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label>Status Pegawai</label>
              <select class="form-control" name="status">
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Belum Berkeluarga</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Sudah Berkeluarga</option>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
              @error('name')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}">
              @error('username')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" value="{{ old('password') }}">
              @error('password')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="c_password">Confirm Password</label>
              <input type="password" class="form-control @error('c_password') is-invalid @enderror" id="c_password" name="c_password" placeholder="Enter Confirm Password" value="{{ old('c_password') }}">
              @error('c_password')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
              @error('phone')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="address">address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" value="{{ old('address') }}">
              @error('address')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(function () {
      @error('code')
      toastr.error('{{ str_replace('code', 'NIK', $message) }}')
      @enderror

      @error('status')
      toastr.error('{{ $message }}')
      @enderror

      @error('name')
      toastr.error('{{ $message }}')
      @enderror

      @error('username')
      toastr.error('{{ $message }}')
      @enderror

      @error('password')
      toastr.error('{{ $message }}')
      @enderror

      @error('c_password')
      toastr.error('{{ $message }}')
      @enderror

      @error('phone')
      toastr.error('{{ str_replace('phone', 'No Telpon', $message) }}')
      @enderror

      @error('address')
      toastr.error('{{ str_replace('address', 'Alamat', $message) }}')
      @enderror
    });
  </script>
@endsection