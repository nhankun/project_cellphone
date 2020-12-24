<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/jqvmap/jqvmap.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('backs/assets/dist/css/adminlte.min.css') !!}">
    <!-- my style -->
    <link rel="stylesheet" href="{!! asset('backs/assets/dist/css/mystyle.css') !!}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/daterangepicker/daterangepicker.css') !!}">
    <!-- summernote -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/summernote/summernote-bs4.css') !!}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/select2/css/select2.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/sweetalert2/sweetalert2.min.css') !!}">
    <!-- Input phone -->
    <link rel="stylesheet" href="{!! asset('backs/assets/plugins/tel-input/build/css/intlTelInput.css') !!}">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('backs.admins.layouts.partials.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{!! route('dashboard.index') !!}" class="brand-link">
            <img src="{!! asset('backs/assets/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Cellphone</span>
{{--            <span class="brand-text font-weight-light">AdminLTE 3</span>--}}
        </a>

        <!-- Sidebar -->
        @include('backs.admins.layouts.partials.sidebar')
        <!-- /.sidebar -->

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')

    </div>
    <!-- /.content-wrapper -->
    @include('backs.admins.layouts.partials.footer')

    <!-- Control Sidebar -->
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="{!! asset('backs/assets/plugins/jquery/jquery.min.js') !!}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{!! asset('backs/assets/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>

<!-- Summernote -->
<script src="{!! asset('backs/assets/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('backs/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- ChartJS -->
{{--<script src="{!! asset('backs/assets/plugins/chart.js/Chart.min.js') !!}"></script>--}}
<!-- Sparkline -->
<script src="{!! asset('backs/assets/plugins/sparklines/sparkline.js') !!}"></script>
<!-- JQVMap -->
{{--<script src="{!! asset('backs/assets/plugins/jqvmap/jquery.vmap.min.js') !!}"></script>--}}
{{--<script src="{!! asset('backs/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}"></script>--}}
<!-- jQuery Knob Chart -->
<script src="{!! asset('backs/assets/plugins/jquery-knob/jquery.knob.min.js') !!}"></script>

<!-- Bootstrap 4 -->
<script src="{!! asset('backs/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('backs/assets/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{!! asset('backs/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') !!}"></script>
<!-- daterangepicker -->
<script src="{!! asset('backs/assets/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('backs/assets/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- InputMask -->
<script src="{!! asset('backs/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js') !!}"></script>
<!-- bootstrap color picker -->
<script src="{!! asset('backs/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{!! asset('backs/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- Bootstrap Switch -->
<script src="{!! asset('backs/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('backs/assets/dist/js/adminlte.js') !!}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('backs/assets/dist/js/demo.js') !!}"></script>

<!-- sweetalert2 -->
<script src="{!! asset('backs/assets/plugins/sweetalert2/sweetalert2.min.js') !!}"></script>
<!-- Input phone -->
<script src="{!! asset('backs/assets/plugins/tel-input/build/js/intlTelInput.js') !!}"></script>
<script src="{{asset('backs/assets/plugins/tel-input/build/js/utils.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- file back.js -->
<script src="{!! asset('js/back.js') !!}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    });

    $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{ asset("js/managers/edit_tag.js") }}"></script>
@yield('script')
</body>
</html>
