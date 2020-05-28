@extends('layouts.appLogin')

@section('content')
  <div class="login-logo">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  </div>
  <!-- /.login-logo -->
  <div class="card elevation-4">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Menu Login</p>
      <form action="{{ route('login') }}" method="post">
        @csrf

        @error('username')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                 value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-envelope"></div>
            </div>
          </div>
        </div>

        @error('password')
        <div class="text-danger" role="alert">
          <small>{{ $message }}</small>
        </div>
        @enderror
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="current-password" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <div class="fas fa-lock"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-warning btn-block">
              @lang('login')
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
