@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Manajemen Role &amp; Permission</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('access.roles.index') }}">Role &amp; Permission</a></li>
                <li class="breadcrumb-item active">Daftar Permission</li>
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
                    <li class="nav-item">
                        <a href="{{ route('access.roles.index') }}" class="nav-link">
                            <i class="fas fa-user-tag mr-1"></i> Daftar Role &amp; Hak Akses
                            <span class="badge badge-light ml-1">{{ $totalRoles }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('access.permissions.index') }}" class="nav-link active">
                            <i class="fas fa-key mr-1"></i> Daftar Permission
                            <span class="badge badge-light ml-1">{{ $permissions->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas {{ $editPermission ? 'fa-edit' : 'fa-plus-circle' }} mr-2"></i>
                                    {{ $editPermission ? 'Edit Permission' : 'Tambah Permission Baru' }}
                                </h3>
                            </div>
                            <div class="card-body">
                                @php
                                    $isCoreEdit = $editPermission && in_array($editPermission->name, $corePermissions, true);
                                @endphp
                                <form
                                    action="{{ $editPermission ? route('access.permissions.update', $editPermission->id) : route('access.permissions.store') }}"
                                    method="POST">
                                    @csrf
                                    @if ($editPermission)
                                        @method('PUT')
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Nama Permission <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $editPermission->name ?? '') }}"
                                            placeholder="Contoh: sip.verify"
                                            {{ $isCoreEdit ? 'readonly' : 'required' }}>
                                        <small class="text-muted">
                                            Gunakan huruf kecil, angka, titik (.), strip (-), atau garis bawah (_).
                                        </small>
                                        @if ($isCoreEdit)
                                            <small class="d-block text-danger mt-1">
                                                Permission bawaan sistem tidak dapat diubah namanya.
                                            </small>
                                        @endif
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-tni flex-fill" {{ $isCoreEdit ? 'disabled' : '' }}>
                                            <i class="fas fa-save mr-1"></i> {{ $editPermission ? 'Simpan Perubahan' : 'Simpan Permission' }}
                                        </button>
                                        @if ($editPermission)
                                            <a href="{{ route('access.permissions.index') }}" class="btn btn-secondary ml-2">
                                                Batal
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-list mr-2"></i>Daftar Permission
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="permissionsTable"
                                        class="table table-bordered table-striped table-hover table-tni"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 6%;">No</th>
                                                <th>Nama Permission</th>
                                                <th class="text-center" style="width: 16%;">Kategori</th>
                                                <th>Digunakan Role</th>
                                                <th class="text-center" style="width: 15%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $index => $permission)
                                                @php
                                                    $isCore = in_array($permission->name, $corePermissions, true);
                                                @endphp
                                                <tr class="{{ $editPermission && $editPermission->id === $permission->id ? 'table-warning' : '' }}">
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td><code>{{ $permission->name }}</code></td>
                                                    <td class="text-center">
                                                        @if ($isCore)
                                                            <span class="badge badge-secondary">Bawaan Sistem</span>
                                                        @else
                                                            <span class="badge badge-info">Kustom</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @forelse ($permission->roles as $role)
                                                            <span class="badge badge-light border mr-1">{{ $role->name }}</span>
                                                        @empty
                                                            <span class="text-muted small">-</span>
                                                        @endforelse
                                                    </td>
                                                    <td class="text-center text-nowrap">
                                                        @if (!$isCore)
                                                            <a href="{{ route('access.permissions.index', ['edit' => $permission->id]) }}"
                                                                class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('access.permissions.destroy', $permission->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus permission {{ $permission->name }}?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="text-muted small"><i class="fas fa-lock"></i> Terkunci</span>
                                                        @endif
                                                    </td>
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
            $('#permissionsTable').DataTable({
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
