<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sampoerna Kayoe</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
  @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed accent-danger">
<div id="app" class="wrapper">

  <x-side-bar/>

  <x-header/>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        @yield('title')
      </div>
    </section>

    <section class="content">
      @yield('content')
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


  <x-list-bar/>

</div>

<script src="{{ mix('js/app.js') }}"></script>
<script>
  $(function () {
    const Toast = sweetAlert.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    @error('code')
    Toast.fire({
      icon: 'warning',
      title: '{{ str_replace('code', 'NIK', $message) }}'
    });
    @enderror
  });
</script>
@yield('js')
</body>
</html>
