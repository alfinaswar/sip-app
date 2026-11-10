@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Akses Ditolak</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">403 Forbidden</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-tni">
            <div class="card-body text-center py-5">
                <div class="mb-3 text-danger">
                    <i class="fas fa-ban fa-4x"></i>
                </div>
                <h3 class="font-weight-bold text-dark">403 &mdash; Anda Tidak Memiliki Hak Akses</h3>
                <p class="text-muted mb-4">
                    Role atau izin akun Anda saat ini tidak diperbolehkan untuk mengakses halaman atau tindakan ini.
                    Hubungi Super Admin jika Anda memerlukan akses tambahan.
                </p>
                <a href="{{ route('home') }}" class="btn btn-tni">
                    <i class="fas fa-home mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
