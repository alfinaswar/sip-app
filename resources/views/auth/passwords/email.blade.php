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
                            Pemulihan Akses Akun Pengguna
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
                        <h4 class="text-center font-weight-bold text-dark mb-1">Lupa Kata Sandi</h4>
                        <div class="tni-divider-gold"></div>
                        <p class="text-muted text-center small mb-3">
                            Masukkan alamat email akun Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
                        </p>

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

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="font-weight-semibold text-dark">Alamat Email</label>
                                <div class="input-group">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}"
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

                            <button type="submit" class="btn btn-tni btn-block py-2 mt-3">
                                <i class="fas fa-paper-plane mr-1"></i> Kirim Tautan Reset Kata Sandi
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
