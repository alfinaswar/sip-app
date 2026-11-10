<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>APLIKASI SIP RUMAH DINAS KPAD KODAM JAYA/JAYAKARTA</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- AdminLTE 3 Core -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Tema TNI AD / Kodam Jaya -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/tni-theme.css') }}">
</head>

<body class="hold-transition tni-auth-page">
    <div class="tni-login-wrapper">
        <div class="card tni-login-card mb-0">
            <!-- Header Banner Militer dengan Dual Lambang -->
            <div class="tni-login-banner">
                <div class="row align-items-center text-center">
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/loghijau.png') }}" alt="Logo Kodam Jaya" class="tni-crest">
                    </div>
                    <div class="col-6 col-sm-8 px-2">
                        <div class="tni-login-title">APLIKASI SIP RUMAH DINAS</div>
                        <div class="tni-login-subtitle">KPAD KODAM JAYA / JAYAKARTA</div>
                        <div class="tni-login-tagline d-none d-sm-block">
                            Sistem Informasi Surat Izin Penghunian TNI AD
                        </div>
                    </div>
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/logoemas.png') }}" alt="Logo Kartika Eka Paksi"
                            class="tni-crest">
                    </div>
                </div>
            </div>

            <!-- Form Login AdminLTE 3 -->
            <div class="card-body login-card-body">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <h4 class="text-center font-weight-bold text-dark mb-1">Masuk ke Akun Anda</h4>
                        <div class="tni-divider-gold"></div>

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                                <small><i class="fas fa-check-circle mr-1"></i> {{ session('status') }}</small>
                                <button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <small><i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}</small>
                                <button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" autocomplete="on">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="font-weight-semibold text-dark">Email</label>
                                <div class="input-group">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email dinas Anda" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="font-weight-semibold text-dark">Kata Sandi</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan kata sandi" required autocomplete="current-password">
                                    <div class="input-group-append">
                                        <button type="button" id="togglePassword"
                                            class="input-group-text btn btn-light"
                                            title="Tampilkan / Sembunyikan Kata Sandi"
                                            aria-label="Tampilkan Kata Sandi">
                                            <span class="fas fa-eye" id="togglePasswordIcon"></span>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row align-items-center mb-3">
                                <div class="col-6">
                                    <div class="icheck-success">
                                        <input type="checkbox" id="remember" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="font-weight-normal text-muted">
                                            Ingat saya
                                        </label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col-6 text-right">
                                        <a href="{{ route('password.request') }}"
                                            class="text-success font-weight-semibold small">
                                            <i class="fas fa-unlock-alt mr-1"></i>Lupa kata sandi?
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-tni btn-block py-2">
                                <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                            </button>
                        </form>

                        {{-- <div class="text-center mt-3 pt-2 border-top">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt mr-1 text-success"></i>
                                Tentara Nasional Indonesia Angkatan Darat
                            </small>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, Bootstrap 4, AdminLTE -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script>
        (function() {
            var toggleBtn = document.getElementById('togglePassword');
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('togglePasswordIcon');

            if (toggleBtn && passwordInput && toggleIcon) {
                toggleBtn.addEventListener('click', function() {
                    var isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleIcon.classList.toggle('fa-eye', !isPassword);
                    toggleIcon.classList.toggle('fa-eye-slash', isPassword);
                });
            }
        })();
    </script>
</body>

</html>
