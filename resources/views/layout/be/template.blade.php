<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <style>
        @font-face {
            font-family: "Nunito";
            src: url("/font/Nunito-Regular.ttf") format("truetype");
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        li,
        div {
            font-family: "Nunito";
        }
    </style>

    {{-- Tempatkan js chart disini utk memuat library Chart sebelum melakukan fungsinya --}}
    <script src="/backend/plugins/char.js/chart.min.js"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/backend/plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/backend/plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/backend/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/backend/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/backend/plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/backend/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="/backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css" />
    <!-- BS Stepper -->
    <link rel="stylesheet" href="/backend/plugins/bs-stepper/css/bs-stepper.min.css" />
    <!-- dropzonejs -->
    <link rel="stylesheet" href="/backend/plugins/dropzone/min/dropzone.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/css/adminlte.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/img/logo_posyandu.png" alt="PosyanduLogo" height="100" width="100">
        </div> --}}

        @include('layout.be.top-nav')

        @include('layout.be.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title', 'Page Title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title', 'Page Title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('layout.be.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

    </div>

    <!-- JS -->
    <script src="/backend/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/backend/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="/backend/plugins/toastr/toastr.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Sparkline -->
    <script src="/backend/plugins/sparklines/sparkline.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    @yield('scripts')

    <!-- DataTables  & Plugins -->
    <script src="/backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/backend/plugins/jszip/jszip.min.js"></script>
    <script src="/backend/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/backend/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
            @if (session('error'))
                toastr.error('{{ session('error') }}');
            @endif
        });
    </script>
</body>

</html>
