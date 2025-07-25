<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Aplikasi KPAD</title>
    <!-- CSS files -->
    <link href="{{ asset('') }}assets/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        /* Hilangkan posisi absolute pada logo */
        .logo-atas-kanan,
        .logo-bawah-kiri {
            position: static;
            display: inline-block;
            margin: 0 10px;
            z-index: 10;
        }

        .logo-row {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
            gap: 16px;
        }

        .login-container {
            position: relative;
            min-height: 100vh;
            background: #f5f7fb;
        }
    </style>
</head>

<body class="d-flex flex-column login-container">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <!-- Logo di atas form -->
                        <div class="logo-row mb-2">
                            <div class="logo-atas-kanan">
                                <img src="{{ asset('assets/img/icon/emas.png') }}" alt="Logo Emas" width="80">
                            </div>
                            <div class="logo-bawah-kiri">
                                <img src="{{ asset('assets/img/icon/hijau.png') }}" alt="Logo Hijau" width="80">
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <h1 class="fw-bold" style="letter-spacing:2px;">Aplikasi KPAD</h1>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Login ke akun Anda</h2>
                                <form method="POST" action="{{ route('login') }}" autocomplete="on" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input id="email" type="email" placeholder="Email Anda"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">
                                            Password
                                        </label>
                                        <div class="input-group input-group-flat">
                                            <input id="password" type="password" placeholder="Password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="input-group-text">
                                                <a href="#" class="link-secondary" title="Tampilkan password"
                                                    data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <circle cx="12" cy="12" r="2" />
                                                        <path
                                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                    </svg>
                                                </a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-info w-100">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- <div class="text-center text-secondary mt-3">
                            Belum punya akun? <a href="./sign-up.html" tabindex="-1">Daftar</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{asset('')}}assets/js/tabler.min.js?1692870487" defer></script>
    <script src="{{asset('')}}assets/js/demo.min.js?1692870487" defer></script>
</body>

</html>