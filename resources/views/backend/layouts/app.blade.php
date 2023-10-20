<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('storage/uploads/settings/'.$setting->logo_header) }}" rel="icon">
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
  <link href="{{ asset('backend/vendor/datatable/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{ asset('backend/vendor/datatable/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/datatable/dataTables.bootstrap5.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('backend/js/main.js')}}"></script>

  @stack('js_file')
  @stack('scripts')

<script>

    function readURL(input) {
        console.log(input);
        if (input.files && input.files[0]) {

            let size = input.files[0].size;
            console.log(`Image Size: ${size}`);

            var reader = new FileReader();
            reader.onload = function (e) {


                if (size > 2000000) {
                    $('#img').attr('src', '');
                    $('#image').val('');
                    toastr.warning(" Image Size is exceeding 2 Mb");


                } else {
                    $('#img').attr('src', e.target.result);
                    $('#img').css("display", "block");
                    $('#hidden-field').val('');
                }


            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLThumbnail(input) {
        if (input.files && input.files[0]) {

            let size = input.files[0].size;
            console.log(`Image Size: ${size}`);


            var reader = new FileReader();
            reader.onload = function (e) {

                if (size > 2000000) {
                    $('#img_thumbnail').attr('src', '');
                    $('#thumbnail_image').val('');
                    toastr.warning("Thumbnail Image Size is exceeding 2 Mb");
                } else {
                    $('#img_thumbnail').attr('src', e.target.result);
                    $('#img_thumbnail').css("display", "block");
                    $('#hidden-field').val('');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>

</html>
