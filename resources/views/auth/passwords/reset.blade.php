@extends('layouts.app')

@section('content')
<div class="container">
    <div class="tni-login-wrapper mx-auto">
        <div class="card tni-login-card mb-0">
            <div class="tni-login-banner">
                <div class="row align-items-center text-center">
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/loghijau.png') }}" alt="Logo Kodam Jaya" class="tni-crest">
                    </div>
                    <div class="col-6 col-sm-8 px-2">
                        <div class="tni-login-title">APLIKASI SIP RUMAH DINAS</div>
                        <div class="tni-login-subtitle">KPAD KODAM JAYA / JAYAKARTA</div>
                        <div class="tni-login-tagline d-none d-sm-block">
                            Atur Ulang Kata Sandi Akun
                        </div>
                    </div>
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/logoemas.png') }}" alt="Logo Kartika Eka Paksi" class="tni-crest">
                    </div>
                </div>
            </div>

            <div class="card-body login-card-body">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <h4 class="text-center font-weight-bold text-dark mb-1">Reset Kata Sandi</h4>
                        <div class="tni-divider-gold"></div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <small><i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}</small>
                                <button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email" class="font-weight-semibold text-dark">Alamat Email</label>
                                <div class="input-group">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}"
                                        placeholder="Masukkan email akun Anda"
                                        required autocomplete="email" autofocus>
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
                                <label for="password" class="font-weight-semibold text-dark">Kata Sandi Baru</label>
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Minimal 8 karakter"
                                        required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text btn btn-light js-toggle-password"
                                            data-target="password" aria-label="Tampilkan Kata Sandi">
                                            <span class="fas fa-eye"></span>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="font-weight-semibold text-dark">Konfirmasi Kata Sandi Baru</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation"
                                        placeholder="Ulangi kata sandi baru"
                                        required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text btn btn-light js-toggle-password"
                                            data-target="password-confirm" aria-label="Tampilkan Konfirmasi Kata Sandi">
                                            <span class="fas fa-eye"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-tni btn-block py-2 mt-3">
                                <i class="fas fa-key mr-1"></i> Simpan Kata Sandi Baru
                            </button>
                        </form>

                        <div class="text-center mt-3 pt-2 border-top">
                            <a href="{{ route('login') }}" class="text-success font-weight-semibold small">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Halaman Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.js-toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(this.getAttribute('data-target'));
            var icon = this.querySelector('span');
            if (!input || !icon) return;
            var isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        });
    });
</script>
@endpush
