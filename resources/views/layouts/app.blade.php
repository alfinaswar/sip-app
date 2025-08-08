<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>SIP</title>
    <link href="{{ asset('') }}assets/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('') }}assets/css/demo.min.css?1692870487" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>




    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .custom-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
    @stack('css')
</head>

<body>
    <script src="{{ asset('') }}assets/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="navbar-brand navbar-brand-autodark">
                    <a href=".">
                        <img src="{{ asset('assets/img/icon/login-logo.png') }}" width="1000" height="1000" alt="Tabler"
                            class="navbar-brand-image">
                    </a>
                    <span style="color: #1F573A; font-size: 18px">Sistem KPAD</span>
                </h5>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('surat-izin.create') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Home icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">Database</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Users icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 21l18 0" />
                                        <path d="M5 21v-14l8 -4v18" />
                                        <path d="M19 21v-10l-6 -4" />
                                        <path d="M9 9l0 .01" />
                                        <path d="M9 12l0 .01" />
                                        <path d="M9 15l0 .01" />
                                        <path d="M9 18l0 .01" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">Library</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('updatepassword') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Icon kunci/password -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-key">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="8" cy="15" r="4" />
                                        <path d="M10.85 12.15l5.65 -5.65a2.121 2.121 0 1 1 3 3l-5.65 5.65" />
                                        <path d="M15 7l3 3" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">Ubah Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- End Sidebar -->

        <!-- Page content -->
        <div class="page-wrapper">
            <!-- Topbar -->
            <header class="navbar navbar-expand-md d-print-none">
                <div class="container-xl">
                    <div class="navbar-nav flex-row order-md-last ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                aria-label="Open user menu">
                                <span class="avatar avatar-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="#2465ff" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                        <path
                                            d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                    </svg>
                                </span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Auth::user()->name }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="" class="dropdown-item">
                                    Profile
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <main class="py-3">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('') }}assets/libs/apexcharts/dist/apexcharts.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/maps/world.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/jsvectormap/dist/maps/world-merc.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/nouislider/dist/nouislider.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/tom-select/dist/js/tom-select.base.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/libs/litepicker/dist/litepicker.js?1692870487" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('') }}assets/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('') }}assets/js/demo.min.js?1692870487" defer></script>
    @stack('scripts')
</body>

</html>