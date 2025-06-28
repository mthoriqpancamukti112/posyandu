<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar - Posyandu</title>
    <link rel="stylesheet" href="/backend/login/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/backend/login//bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="/backend/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/backend/login/style.css">
    <link rel="stylesheet" href="/backend/login/components.css">
</head>

<body class="hold-transition login-page">
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-7 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <h4 class="text-dark font-weight-bold text-center">Registrasi Posyandu</h4>
                        <p class="text-muted">Silahkan isi data diri anda dengan benar dibawah ini.</p>
                        <form method="POST" action="{{ route('register.store') }}" novalidate="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ old('nik') }}" placeholder="masukan 16 digit"
                                            autofocus>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_ortu">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('nama_ortu') is-invalid @enderror"
                                            name="nama_ortu" value="{{ old('nama_ortu') }}" placeholder="nama lengkap">

                                        @error('nama_ortu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Nama Panggilan</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ old('username') }}" placeholder="(opsional)">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            name="tgl_lahir" value="{{ old('tgl_lahir') }}" placeholder="Tanggal lahir">

                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">No HP/WA</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            name="no_hp" value="{{ old('no_hp') }}" placeholder="08x...">

                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email" placeholder="example@gmail.com">

                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            name="password" placeholder="**********">

                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p>Sudah punya akun? <a href="{{ route('login.index') }}">
                                        Login
                                    </a>
                                </p>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
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
