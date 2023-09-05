<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('backend/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('backend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/remixicon/remixicon.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">

  @stack('css_file')
  @stack('css')

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('backend.includes.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('backend.includes.side_bar')
  <!-- End Sidebar-->

  @yield('content')
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('backend.includes.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('backend/js/main.js')}}"></script>

  @stack('js_file')
  @stack('scripts')

</body>

</html>