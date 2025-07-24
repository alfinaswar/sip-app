@extends('layouts.app')

@section('content')
    <style>
        /* Warna khas militer: hijau army, kuning emas, dan aksen hitam */
        .army-bg {
            background: linear-gradient(135deg, #3e4d3a 80%, #bfa14a 100%);
            color: #fff;
        }

        .army-card {
            border: 2px solid #3e4d3a;
            background-color: #4b5d3a;
            color: #fff;
            border-radius: 12px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .army-card:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 6px 24px rgba(62, 77, 58, 0.18);
            border-color: #bfa14a;
        }

        .army-icon {
            color: #bfa14a;
            background: #232d1b;
            border-radius: 50%;
            padding: 12px;
            margin-bottom: 10px;
            border: 2px solid #bfa14a;
            box-shadow: 0 2px 8px rgba(62, 77, 58, 0.12);
        }

        .army-title {
            font-family: 'Oswald', 'Arial Black', Arial, sans-serif;
            letter-spacing: 2px;
            color: #bfa14a;
            text-shadow: 1px 1px 2px #232d1b;
        }

        .army-shadow {
            box-shadow: 0 4px 24px rgba(62, 77, 58, 0.18);
        }

        .army-btn {
            background: #bfa14a;
            color: #232d1b;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .army-btn:hover {
            background: #fffbe6;
            color: #3e4d3a;
        }
    </style>
    <div class="container">
        <!-- Welcome Card -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                <div class="card army-bg army-shadow border-0">
                    <div class="card-body text-center">
                        <h4 class="mb-3 army-title">👋 Selamat Datang, {{ Auth::user()->name }}!</h4>
                        <p class="text-light" style="font-size: 1.1rem;">
                            Anda berhasil masuk ke sistem. <br>
                            <span style="color:#bfa14a;">Silakan pilih menu di bawah ini untuk melanjutkan.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="row justify-content-center text-center">
            <div class="col-6 col-md-2 mb-4">
                <a href="{{route('surat-izin.create')}}" class="text-decoration-none">
                    <div class="army-card h-100 army-shadow">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-user army-icon" style="font-size: 2.2rem;"></i>
                            <p class="mb-0" style="font-weight:600;">Form Pendataan</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-2 mb-4">
                <a href="{{route('surat-izin.index')}}" class="text-decoration-none">
                    <div class="army-card h-100 army-shadow">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-database army-icon" style="font-size: 2.2rem;"></i>
                            <p class="mb-0" style="font-weight:600;">Database</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <button class="army-btn" disabled>
                    <i class="fas fa-shield-alt"></i> Sistem Pendataan Rumah Dinas TNI AD
                </button>
            </div>
        </div>
    </div>
@endsection
