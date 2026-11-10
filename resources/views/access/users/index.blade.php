@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Manajemen Pengguna</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Manajemen User</li>
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

        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="card card-tni mb-0">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas {{ $editUser ? 'fa-user-edit' : 'fa-user-plus' }} mr-2"></i>
                            {{ $editUser ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $editUser ? route('access.users.update', $editUser->id) : route('access.users.store') }}"
                            method="POST">
                            @csrf
                            @if ($editUser)
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $editUser->name ?? '') }}"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $editUser->email ?? '') }}"
                                    placeholder="contoh@tni-ad.mil.id" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">
                                    Kata Sandi
                                    @if ($editUser)
                                        <small class="text-muted font-weight-normal">(kosongkan jika tidak diubah)</small>
                                    @else
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter" {{ $editUser ? '' : 'required' }}>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control"
                                    placeholder="Ulangi kata sandi" {{ $editUser ? '' : 'required' }}>
                            </div>

                            @php
                                $selectedRoles = old('_token') !== null
                                    ? (array) old('roles', [])
                                    : ($editUser ? $editUser->roles->pluck('name')->all() : []);
                                $selectedDirectPermissions = old('_token') !== null
                                    ? (array) old('permissions', [])
                                    : ($editUser ? $editUser->permissions->pluck('name')->all() : []);
                            @endphp

                            <div class="form-group">
                                <label class="d-block">Role Pengguna</label>
                                <div class="border rounded p-2 bg-light">
                                    @foreach ($roles as $role)
                                        <div class="custom-control custom-checkbox mb-1">
                                            <input type="checkbox" class="custom-control-input"
                                                id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}"
                                                {{ in_array($role->name, $selectedRoles, true) ? 'checked' : '' }}>
                                            <label class="custom-control-label font-weight-normal" for="role_{{ $role->id }}">
                                                <strong>{{ $role->name }}</strong>
                                                <small class="text-muted">({{ $role->permissions->count() }} permission)</small>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <a class="small font-weight-bold text-secondary" data-toggle="collapse"
                                    href="#directPermissionsBox" role="button"
                                    aria-expanded="{{ count($selectedDirectPermissions) ? 'true' : 'false' }}">
                                    <i class="fas fa-sliders-h mr-1"></i> Permission Tambahan Langsung (Opsional)
                                    @if (count($selectedDirectPermissions))
                                        <span class="badge badge-info ml-1">{{ count($selectedDirectPermissions) }}</span>
                                    @endif
                                </a>
                                <div class="collapse {{ count($selectedDirectPermissions) ? 'show' : '' }} mt-2"
                                    id="directPermissionsBox">
                                    <div class="border rounded p-2 bg-light" style="max-height: 180px; overflow-y: auto;">
                                        @foreach ($permissions as $permission)
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="perm_{{ $permission->id }}" name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, $selectedDirectPermissions, true) ? 'checked' : '' }}>
                                                <label class="custom-control-label font-weight-normal small"
                                                    for="perm_{{ $permission->id }}">
                                                    <code>{{ $permission->name }}</code>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-tni flex-fill">
                                    <i class="fas fa-save mr-1"></i> {{ $editUser ? 'Simpan Perubahan' : 'Simpan Pengguna' }}
                                </button>
                                @if ($editUser)
                                    <a href="{{ route('access.users.index') }}" class="btn btn-secondary ml-2">
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
                            <i class="fas fa-users mr-2"></i>Daftar Pengguna Sistem
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-bordered table-striped table-hover table-tni"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 6%;">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Permission Langsung</th>
                                        <th class="text-center" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr class="{{ $editUser && $editUser->id === $user->id ? 'table-warning' : '' }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="font-weight-semibold">
                                                {{ $user->name }}
                                                @if ($user->id === auth()->id())
                                                    <span class="badge badge-info ml-1">Anda</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @forelse ($user->roles as $role)
                                                    @php
                                                        $badgeClass = match ($role->name) {
                                                            'Super Admin' => 'badge-danger',
                                                            'Operator' => 'badge-success',
                                                            default => 'badge-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }} mr-1">{{ $role->name }}</span>
                                                @empty
                                                    <span class="text-muted small">Belum ada role</span>
                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse ($user->permissions as $perm)
                                                    <span class="badge badge-light border mr-1">{{ $perm->name }}</span>
                                                @empty
                                                    <span class="text-muted small">-</span>
                                                @endforelse
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('access.users.index', ['edit' => $user->id]) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if ($user->id !== auth()->id())
                                                    <form action="{{ route('access.users.destroy', $user->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
            $('#usersTable').DataTable({
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
