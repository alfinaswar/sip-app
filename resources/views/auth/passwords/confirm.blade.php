@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card card-tni">
                <div class="card-header card-header-tni font-weight-bold">
                    <i class="fas fa-shield-alt mr-2"></i>Konfirmasi Kata Sandi
                </div>

                <div class="card-body">
                    <p class="text-muted">Silakan konfirmasi kata sandi Anda sebelum melanjutkan.</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi</label>

                            <div class="col-md-7">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-tni">
                                    Konfirmasi Kata Sandi
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-success" href="{{ route('password.request') }}">
                                        Lupa kata sandi?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
