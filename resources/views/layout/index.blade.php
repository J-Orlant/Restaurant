<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('templates/sbAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('templates/sbAdmin/css/sb-admin-2.min.css') }}" rel="stylesheet">@stack('addon-css')
    <title>@yield('title')</title>
  </head>
  <body>

    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('templates/sbAdmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templates/sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('templates/sbAdmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('templates/sbAdmin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('templates/sbAdmin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('templates/sbAdmin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('templates/sbAdmin/js/demo/chart-pie-demo.js') }}"></script>

    @stack('addon-js')
  </body>
</html>
