<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIP Rumah Dinas — KPAD Kodam Jaya/Jayakarta</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Select2 & SweetAlert2 (Bootstrap 4 Theme) -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- AdminLTE 3 Core -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Tema TNI AD / Kodam Jaya -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/tni-theme.css') }}">

    @stack('styles')
</head>

@auth
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-tni">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link font-weight-semibold">
                        <span class="badge badge-tni mr-2">TNI AD</span>
                        KPAD KODAM JAYA / JAYAKARTA
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#"
                        role="button" aria-expanded="false">
                        <i class="fas fa-user-shield mr-2 text-warning"></i>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <span class="dropdown-header text-left font-weight-bold">
                            {{ Auth::user()->name }}
                            <small class="d-block text-muted font-weight-normal">
                                {{ Auth::user()->getRoleNames()->implode(', ') ?: 'Pengguna' }}
                            </small>
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('updatepassword') }}" class="dropdown-item">
                            <i class="fas fa-key mr-2 text-secondary"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-olive sidebar-tni elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('assets/img/loghijau.png') }}" alt="Logo Kodam Jaya"
                    class="brand-image img-circle elevation-3" style="background: #ffffff; padding: 2px;">
                <span class="brand-text font-weight-bold">Sistem KPAD</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="{{ asset('assets/img/logoemas.png') }}" class="img-circle elevation-2"
                            alt="Kartika Eka Paksi" style="background: #182114; padding: 2px;">
                    </div>
                    <div class="info">
                        <a href="{{ route('home') }}" class="d-block text-white font-weight-bold text-truncate"
                            style="max-width: 160px;">
                            {{ Auth::user()->name }}
                        </a>
                        <small class="text-warning d-block text-truncate" style="font-size: 0.72rem; max-width: 160px;">
                            {{ Auth::user()->getRoleNames()->implode(', ') ?: 'Pengguna' }}
                        </small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">NAVIGASI UTAMA</li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @canany(['sip.view', 'sip.create'])
                            <li class="nav-item">
                                <a href="{{ route('surat-izin.create') }}"
                                    class="nav-link {{ request()->routeIs('surat-izin.create', 'surat-izin.edit', 'surat-izin-history.edit') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>Database</p>
                                </a>
                            </li>
                        @endcanany
                        @can('sip.view')
                            <li class="nav-item">
                                <a href="{{ route('surat-izin.index') }}"
                                    class="nav-link {{ request()->routeIs('surat-izin.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Daftar Pengajuan</p>
                                </a>
                            </li>
                        @endcan
                        @canany(['master-data.view', 'master-data.manage'])
                            @php
                                $isMasterRoute = request()->routeIs('master-data.*');
                                $currentMasterTab = $isMasterRoute ? ($activeTab ?? request()->route('tab', 'kpad')) : null;
                            @endphp
                            <li class="nav-item has-treeview {{ $isMasterRoute ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ $isMasterRoute ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('master-data.index', 'kpad') }}"
                                            class="nav-link {{ $currentMasterTab === 'kpad' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Master KPAD</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('master-data.index', 'pangkat') }}"
                                            class="nav-link {{ $currentMasterTab === 'pangkat' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Master Pangkat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('master-data.index', 'korps') }}"
                                            class="nav-link {{ $currentMasterTab === 'korps' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Master Korps</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('master-data.index', 'status') }}"
                                            class="nav-link {{ $currentMasterTab === 'status' ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Master Status</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                        @canany(['user.manage', 'role.manage'])
                            <li class="nav-header">MANAJEMEN AKSES</li>
                            @can('user.manage')
                                <li class="nav-item">
                                    <a href="{{ route('access.users.index') }}"
                                        class="nav-link {{ request()->routeIs('access.users.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-users-cog"></i>
                                        <p>Manajemen User</p>
                                    </a>
                                </li>
                            @endcan
                            @can('role.manage')
                                <li class="nav-item">
                                    <a href="{{ route('access.roles.index') }}"
                                        class="nav-link {{ request()->routeIs('access.roles.*', 'access.permissions.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-shield"></i>
                                        <p>Role &amp; Permission</p>
                                    </a>
                                </li>
                            @endcan
                        @endcanany
                        <li class="nav-header">PENGATURAN AKUN</li>
                        <li class="nav-item">
                            <a href="{{ route('updatepassword') }}"
                                class="nav-link {{ request()->routeIs('updatepassword') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Ubah Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @hasSection('content-header')
                <div class="content-header">
                    <div class="container-fluid">
                        @yield('content-header')
                    </div>
                </div>
            @endif

            <section class="content @hasSection('content-header') pt-0 @else pt-3 @endif">
                @yield('content')
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer footer-tni text-sm">
            <div class="float-right d-none d-sm-inline">
                Sistem Pendataan Rumah Dinas TNI AD
            </div>
            <strong>SIP Rumah Dinas &mdash; KPAD Kodam Jaya/Jayakarta</strong>
        </footer>
    </div>
    <!-- ./wrapper -->
@else
<body class="hold-transition tni-auth-page">
    <div class="w-100 py-4">
        @yield('content')
    </div>
@endauth

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
