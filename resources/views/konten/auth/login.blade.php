<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Log In - Posyandu</title>
    <link rel="stylesheet" href="/backend/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/backend/login/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/login//bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="/backend/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/backend/login/style.css">
    <link rel="stylesheet" href="/backend/login/components.css">
</head>

<body class="hold-transition login-page">
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <h4 class="text-dark font-weight-normal">Selamat Datang Di <span
                                class="font-weight-bold">Pelayanan Posyandu</span>
                        </h4>
                        <p class="text-muted">Sebelum melakukan aktifitas anda harus login terlebih dahulu.</p>
                        <form method="POST" action="/login" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    placeholder="example@gmail.com" required autofocus>
                                <div class="invalid-feedback">
                                    Silakan masuk kan email
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" placeholder="********" required>
                                <div class="invalid-feedback">
                                    Silakan masukan password
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <p>Belum punya akun? <a href="{{ route('register.index') }}">
                                        Daftar
                                    </a>
                                </p>
                                <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    style="background-image: url('/img/background.jpg')">
                </div>
            </div>
        </section>
    </div>
    <script src="/backend/plugins/jquery/jquery.min.js"></script>
    <script src="/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="/backend/plugins/toastr/toastr.min.js"></script>
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
    <script src="/backend/login/jquery/dist/jquery.min.js"></script>
    <script src="/backend/login/popper.js/dist/umd/popper.js"></script>
    <script src="/backend/login/tooltip.js/dist/umd/tooltip.js"></script>
    <script src="/backend/login/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/backend/login/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="/backend/login//moment/min/moment.min.js"></script>
    <script src="/backend/login/stisla.js"></script>
    <script src="/backend/login/scripts.js"></script>
    <script src="/backend/login/custom.js"></script>
</body>

</html>
