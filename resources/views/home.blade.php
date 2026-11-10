@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    @push('styles')
        <style>
            .army-bg {
                background: linear-gradient(135deg, #1f2b19 0%, #3e4d3a 75%, #bfa14a 100%);
                color: #fff;
                border-bottom: 3px solid #bfa14a;
            }

            .army-card {
                border: 1px solid #3e4d3a;
                border-top: 3px solid #bfa14a;
                background-color: #ffffff;
                transition: transform 0.15s ease, box-shadow 0.15s ease;
            }

            .army-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(31, 43, 25, 0.15);
            }

            .army-icon {
                width: 56px;
                height: 56px;
                line-height: 56px;
                color: #bfa14a;
                background: #1f2b19;
                border-radius: 50%;
                border: 2px solid #bfa14a;
                display: inline-block;
                text-align: center;
                font-size: 1.4rem;
            }

            .army-title {
                letter-spacing: 1.2px;
                color: #d4b85c;
                text-shadow: 1px 1px 2px #182114;
            }
        </style>
    @endpush

    <div class="container-fluid">
        @if (session('status') || session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('status') ?? session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Welcome Banner -->
        <div class="row">
            <div class="col-12">
                <div class="card army-bg shadow-sm">
                    <div class="card-body py-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                <img src="{{ asset('assets/img/loghijau.png') }}" alt="Logo Kodam Jaya"
                                    style="height: 82px; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.4));">
                            </div>
                            <div class="col-md-8 text-center text-md-left">
                                <h3 class="mb-2 font-weight-bold army-title">
                                    Selamat Datang, {{ Auth::user()->name }}!
                                </h3>
                                <p class="mb-1 text-light">
                                    Sistem Informasi Surat Izin Penghunian (SIP) Rumah Dinas KPAD Kodam Jaya / Jayakarta.
                                </p>
                                <small class="text-warning font-weight-semibold">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Tentara Nasional Indonesia Angkatan Darat
                                </small>
                                <span class="badge badge-warning text-dark ml-2">
                                    Role: {{ Auth::user()->getRoleNames()->implode(', ') ?: 'Pengguna' }}
                                </span>
                            </div>
                            <div class="col-md-2 text-center d-none d-md-block">
                                <img src="{{ asset('assets/img/logoemas.png') }}" alt="Logo Kartika Eka Paksi"
                                    style="height: 82px; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.4));">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="row mt-2">
            @canany(['sip.view', 'sip.create'])
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <a href="{{ route('surat-izin.create') }}" class="text-decoration-none text-dark">
                        <div class="card army-card h-100 mb-0">
                            <div class="card-body text-center py-4">
                                <div class="army-icon mb-3">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h5 class="font-weight-bold mb-1">Database &amp; Input SIP</h5>
                                <p class="text-muted small mb-0">
                                    @can('sip.create')
                                        Tambah data penghuni baru dan kelola seluruh data penghuni rumah dinas.
                                    @else
                                        Lihat dan cari seluruh data penghuni rumah dinas serta ekspor laporan.
                                    @endcan
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcanany

            @can('sip.view')
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <a href="{{ route('surat-izin.index') }}" class="text-decoration-none text-dark">
                        <div class="card army-card h-100 mb-0">
                            <div class="card-body text-center py-4">
                                <div class="army-icon mb-3">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h5 class="font-weight-bold mb-1">Daftar Pengajuan</h5>
                                <p class="text-muted small mb-0">
                                    Lihat daftar pengajuan penghunian, cetak surat, dan ekspor Excel atau PDF.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @canany(['master-data.view', 'master-data.manage'])
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <a href="{{ route('master-data.index', 'kpad') }}" class="text-decoration-none text-dark">
                        <div class="card army-card h-100 mb-0">
                            <div class="card-body text-center py-4">
                                <div class="army-icon mb-3">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <h5 class="font-weight-bold mb-1">Data Master</h5>
                                <p class="text-muted small mb-0">
                                    Kelola data master KPAD, pangkat, korps, dan status penghuni.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcanany

            @canany(['user.manage', 'role.manage'])
                <div class="col-12 col-sm-6 col-lg-3 mb-3">
                    <a href="{{ auth()->user()->can('user.manage') ? route('access.users.index') : route('access.roles.index') }}"
                        class="text-decoration-none text-dark">
                        <div class="card army-card h-100 mb-0">
                            <div class="card-body text-center py-4">
                                <div class="army-icon mb-3">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h5 class="font-weight-bold mb-1">Manajemen User &amp; Role</h5>
                                <p class="text-muted small mb-0">
                                    Atur akun pengguna, role, serta hak akses (permission) setiap modul aplikasi.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcanany

            <div class="col-12 col-sm-6 col-lg-3 mb-3">
                <a href="{{ route('updatepassword') }}" class="text-decoration-none text-dark">
                    <div class="card army-card h-100 mb-0">
                        <div class="card-body text-center py-4">
                            <div class="army-icon mb-3">
                                <i class="fas fa-key"></i>
                            </div>
                            <h5 class="font-weight-bold mb-1">Ubah Password</h5>
                            <p class="text-muted small mb-0">
                                Perbarui kata sandi akun Anda untuk menjaga keamanan akses sistem.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
