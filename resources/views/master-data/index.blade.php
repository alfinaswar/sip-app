@extends('layouts.app')

@php
    $tabMeta = [
        'kpad' => ['label' => 'Master KPAD', 'icon' => 'fas fa-building', 'desc' => 'Kelola daftar KPAD dan wilayah Kodim pada pilihan rumah dinas.'],
        'pangkat' => ['label' => 'Master Pangkat', 'icon' => 'fas fa-medal', 'desc' => 'Kelola daftar pangkat militer dan PNS pada formulir SIP.'],
        'korps' => ['label' => 'Master Korps', 'icon' => 'fas fa-shield-alt', 'desc' => 'Kelola kode dan keterangan korps TNI AD.'],
        'status' => ['label' => 'Master Status Penghuni', 'icon' => 'fas fa-user-tag', 'desc' => 'Kelola status penghuni dan filter pencarian data SIP.'],
    ];
    $currentMeta = $tabMeta[$activeTab];
@endphp

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Data Master Pendukung</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('master-data.index', 'kpad') }}">Data Master</a></li>
                <li class="breadcrumb-item active">{{ $currentMeta['label'] }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
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
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-tni card-tni-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($tabMeta as $key => $meta)
                        <li class="nav-item">
                            <a href="{{ route('master-data.index', $key) }}"
                                class="nav-link {{ $activeTab === $key ? 'active' : '' }}">
                                <i class="{{ $meta['icon'] }} mr-1"></i> {{ $meta['label'] }}
                                <span class="badge badge-light ml-1">{{ $counts[$key] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="card-body">
                <p class="text-muted mb-3">
                    <i class="fas fa-info-circle mr-1 text-secondary"></i> {{ $currentMeta['desc'] }}
                </p>

                @php $canManageMaster = auth()->user()->can('master-data.manage'); @endphp
                <div class="row">
                    @if ($canManageMaster)
                    <!-- Form Tambah / Edit -->
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas {{ $editItem ? 'fa-edit' : 'fa-plus-circle' }} mr-2"></i>
                                    {{ $editItem ? 'Edit ' . $currentMeta['label'] : 'Tambah ' . $currentMeta['label'] }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ $editItem ? route('master-data.update', [$activeTab, $editItem->id]) : route('master-data.store', $activeTab) }}"
                                    method="POST">
                                    @csrf
                                    @if ($editItem)
                                        @method('PUT')
                                    @endif

                                    @if ($activeTab === 'kpad')
                                        <div class="form-group">
                                            <label for="wilayah_kodim">Wilayah Kodim <span class="text-danger">*</span></label>
                                            <input type="text" name="wilayah_kodim" id="wilayah_kodim"
                                                list="wilayahKodimList"
                                                class="form-control @error('wilayah_kodim') is-invalid @enderror"
                                                value="{{ old('wilayah_kodim', $editItem->wilayah_kodim ?? '') }}"
                                                placeholder="Contoh: WILAYAH KODIM 0501/JP" required>
                                            <datalist id="wilayahKodimList">
                                                @foreach ($wilayahList as $wilayah)
                                                    <option value="{{ $wilayah }}">
                                                @endforeach
                                            </datalist>
                                            @error('wilayah_kodim')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_kpad">Nama KPAD <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_kpad" id="nama_kpad"
                                                class="form-control @error('nama_kpad') is-invalid @enderror"
                                                value="{{ old('nama_kpad', $editItem->nama_kpad ?? '') }}"
                                                placeholder="Contoh: ABDUL RAHMAN SALEH" required>
                                            @error('nama_kpad')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @elseif ($activeTab === 'pangkat')
                                        <div class="form-group">
                                            <label for="nama">Nama Pangkat <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $editItem->nama ?? '') }}"
                                                placeholder="Contoh: Kolonel / PNS III/a" required>
                                            @error('nama')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                            @php $selectedKategori = old('kategori', $editItem->kategori ?? 'Militer'); @endphp
                                            <select name="kategori" id="kategori"
                                                class="form-control @error('kategori') is-invalid @enderror" required>
                                                <option value="Militer" {{ $selectedKategori === 'Militer' ? 'selected' : '' }}>Militer</option>
                                                <option value="PNS" {{ $selectedKategori === 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Lainnya" {{ $selectedKategori === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('kategori')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @elseif ($activeTab === 'korps')
                                        <div class="form-group">
                                            <label for="kode">Kode Korps <span class="text-danger">*</span></label>
                                            <input type="text" name="kode" id="kode"
                                                class="form-control @error('kode') is-invalid @enderror"
                                                value="{{ old('kode', $editItem->kode ?? '') }}"
                                                placeholder="Contoh: Inf, Czi, Ckm" required>
                                            @error('kode')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Keterangan Korps</label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $editItem->nama ?? '') }}"
                                                placeholder="Contoh: Infanteri (opsional)">
                                            @error('nama')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @elseif ($activeTab === 'status')
                                        <div class="form-group">
                                            <label for="nama">Nama Status <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', $editItem->nama ?? '') }}"
                                                placeholder="Contoh: AKTIF, PURNAWIRAWAN" required>
                                            @error('nama')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="urutan">Urutan Tampil</label>
                                        <input type="number" min="0" name="urutan" id="urutan"
                                            class="form-control @error('urutan') is-invalid @enderror"
                                            value="{{ old('urutan', $editItem->urutan ?? '') }}"
                                            placeholder="Otomatis jika dikosongkan">
                                        @error('urutan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @php
                                        $isChecked = old('_token') !== null
                                            ? (bool) old('is_active')
                                            : ($editItem ? $editItem->is_active : true);
                                    @endphp
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active"
                                                name="is_active" value="1" {{ $isChecked ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">
                                                Aktif (tampilkan di pilihan form)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-tni flex-fill">
                                            <i class="fas fa-save mr-1"></i> {{ $editItem ? 'Simpan Perubahan' : 'Simpan' }}
                                        </button>
                                        @if ($editItem)
                                            <a href="{{ route('master-data.index', $activeTab) }}"
                                                class="btn btn-secondary ml-2">
                                                Batal
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Tabel Data Master -->
                    <div class="{{ $canManageMaster ? 'col-lg-8' : 'col-12' }}">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-list mr-2"></i>Daftar {{ $currentMeta['label'] }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="masterTable"
                                        class="table table-bordered table-striped table-hover table-tni"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 6%;">No</th>
                                                @if ($activeTab === 'kpad')
                                                    <th>Wilayah Kodim</th>
                                                    <th>Nama KPAD</th>
                                                @elseif ($activeTab === 'pangkat')
                                                    <th>Nama Pangkat</th>
                                                    <th>Kategori</th>
                                                @elseif ($activeTab === 'korps')
                                                    <th>Kode</th>
                                                    <th>Keterangan</th>
                                                @elseif ($activeTab === 'status')
                                                    <th>Nama Status</th>
                                                @endif
                                                <th class="text-center" style="width: 10%;">Urutan</th>
                                                <th class="text-center" style="width: 12%;">Status</th>
                                                @if ($canManageMaster)
                                                    <th class="text-center" style="width: 16%;">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $index => $item)
                                                <tr class="{{ $editItem && $editItem->id === $item->id ? 'table-warning' : '' }}">
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    @if ($activeTab === 'kpad')
                                                        <td>{{ $item->wilayah_kodim }}</td>
                                                        <td class="font-weight-semibold">{{ $item->nama_kpad }}</td>
                                                    @elseif ($activeTab === 'pangkat')
                                                        <td class="font-weight-semibold">{{ $item->nama === '-' ? '- (Tidak Ada)' : $item->nama }}</td>
                                                        <td>
                                                            <span class="badge badge-secondary">{{ $item->kategori }}</span>
                                                        </td>
                                                    @elseif ($activeTab === 'korps')
                                                        <td class="font-weight-semibold">{{ $item->kode }}</td>
                                                        <td>{{ $item->nama ?? '-' }}</td>
                                                    @elseif ($activeTab === 'status')
                                                        <td class="font-weight-semibold">{{ $item->nama === '-' ? '- (Tidak Ada)' : $item->nama }}</td>
                                                    @endif
                                                    <td class="text-center">{{ $item->urutan }}</td>
                                                    <td class="text-center">
                                                        @if ($item->is_active)
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    @if ($canManageMaster)
                                                    <td class="text-center text-nowrap">
                                                        <a href="{{ route('master-data.index', [$activeTab, 'edit' => $item->id]) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('master-data.destroy', [$activeTab, $item->id]) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus data master ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function () {
            $('#masterTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                },
                dom: '<"row mb-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>rtip'
            });
        });
    </script>
@endpush
