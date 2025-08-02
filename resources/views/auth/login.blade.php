<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>APLIKASI SIP RUMAH DINAS KPAD KODAM JAYA/JAYAKARTA</title>
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

        .login-container {
            position: relative;
            min-height: 100vh;
            background: #f5f7fb;
        }

        .centered-content {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
            padding: 40px 32px;
            gap: 32px;
            /* Tambahan jarak antar elemen */
        }

        .logo-side {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
        }

        .logo-side img {
            width: 90px;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 320px;
            max-width: 400px;
            width: 100%;
            padding-inline: 24px;
            /* Tambahan jarak antara form dan logo */
        }

        .app-title {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .app-subtitle {
            font-size: 1.05rem;
            font-weight: 500;
            text-align: center;
            color: #555;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                padding: 24px 8px;
                gap: 24px;
            }

            .logo-side {
                min-width: 0;
                margin-bottom: 12px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column login-container">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="centered-content">
        <div class="login-wrapper">
            <!-- Logo kiri -->
            <div class="logo-side">
                <img src="{{ asset('assets/img/icon/hijau.png') }}" alt="Logo Hijau">
            </div>

            <!-- Form dan judul aplikasi -->
            <div class="form-section">
                <div class="app-title">APLIKASI SIP RUMAH DINAS</div>
                <div class="app-subtitle">KPAD KODAM JAYA/JAYAKARTA</div>
                <div class="card card-md w-100">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Masuk ke Akun Anda</h2>
                        <form method="POST" action="{{ route('login') }}" autocomplete="on" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input id="email" type="email" placeholder="Email Anda"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kata Sandi</label>
                                <div class="input-group input-group-flat">
                                    <input id="password" type="password" placeholder="Kata Sandi"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Tampilkan password"
                                            data-bs-toggle="tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                <button type="submit" class="btn btn-info w-100">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Logo kanan -->
            <div class="logo-side">
                <img src="{{ asset('assets/img/icon/emas.png') }}" alt="Logo Emas">
            </div>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('') }}assets/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/js/demo.min.js?1692870487" defer></script>
</body>

</html>