<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sampoerna Kayoe</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    @yield('css')
</head>

<body class="hold-transition login-page">
<div class="login-box">
    @yield('content')
</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>

</html>