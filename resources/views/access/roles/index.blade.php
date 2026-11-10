@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Manajemen Role &amp; Permission</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Role &amp; Permission</li>
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
                        <a href="{{ route('access.roles.index') }}" class="nav-link active">
                            <i class="fas fa-user-tag mr-1"></i> Daftar Role &amp; Hak Akses
                            <span class="badge badge-light ml-1">{{ $roles->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('access.permissions.index') }}" class="nav-link">
                            <i class="fas fa-key mr-1"></i> Daftar Permission
                            <span class="badge badge-light ml-1">{{ $totalPermissions }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas {{ $editRole ? 'fa-edit' : 'fa-plus-circle' }} mr-2"></i>
                                    {{ $editRole ? 'Edit Role: ' . $editRole->name : 'Tambah Role Baru' }}
                                </h3>
                            </div>
                            <div class="card-body">
                                @php $isSuperAdminEdit = $editRole && $editRole->name === 'Super Admin'; @endphp
                                <form
                                    action="{{ $editRole ? route('access.roles.update', $editRole->id) : route('access.roles.store') }}"
                                    method="POST">
                                    @csrf
                                    @if ($editRole)
                                        @method('PUT')
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Nama Role <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $editRole->name ?? '') }}"
                                            placeholder="Contoh: Verifikator"
                                            {{ $isSuperAdminEdit ? 'readonly' : 'required' }}>
                                        @if ($isSuperAdminEdit)
                                            <small class="text-muted">Nama role Super Admin tidak dapat diubah.</small>
                                        @endif
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @php
                                        $selectedPermissions = old('_token') !== null
                                            ? (array) old('permissions', [])
                                            : ($editRole ? $editRole->permissions->pluck('name')->all() : []);
                                    @endphp

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label class="mb-0">Hak Akses (Permission)</label>
                                            @if (!$isSuperAdminEdit)
                                                <div>
                                                    <button type="button" class="btn btn-xs btn-outline-success js-check-all">Pilih Semua</button>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary js-uncheck-all">Kosongkan</button>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($isSuperAdminEdit)
                                            <div class="alert alert-info py-2 px-3 small mb-2">
                                                <i class="fas fa-shield-alt mr-1"></i>
                                                Role <strong>Super Admin</strong> otomatis memiliki akses penuh ke seluruh fitur dan permission.
                                            </div>
                                        @endif

                                        <div class="border rounded p-2 bg-light" style="max-height: 360px; overflow-y: auto;">
                                            @foreach ($permissionGroups as $groupLabel => $groupPermissions)
                                                <div class="mb-2">
                                                    <div class="small font-weight-bold text-uppercase text-success border-bottom pb-1 mb-1">
                                                        {{ $groupLabel }}
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($groupPermissions as $perm)
                                                            <div class="col-sm-6 mb-1">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input js-role-permission"
                                                                        id="role_perm_{{ $perm->id }}"
                                                                        name="permissions[]"
                                                                        value="{{ $perm->name }}"
                                                                        {{ $isSuperAdminEdit || in_array($perm->name, $selectedPermissions, true) ? 'checked' : '' }}
                                                                        {{ $isSuperAdminEdit ? 'disabled' : '' }}>
                                                                    <label class="custom-control-label font-weight-normal small"
                                                                        for="role_perm_{{ $perm->id }}">
                                                                        <code>{{ $perm->name }}</code>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-tni flex-fill">
                                            <i class="fas fa-save mr-1"></i> {{ $editRole ? 'Simpan Perubahan' : 'Simpan Role' }}
                                        </button>
                                        @if ($editRole)
                                            <a href="{{ route('access.roles.index') }}" class="btn btn-secondary ml-2">
                                                Batal
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-list mr-2"></i>Daftar Role Sistem
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-tni mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 6%;">No</th>
                                                <th style="width: 22%;">Role</th>
                                                <th class="text-center" style="width: 10%;">User</th>
                                                <th>Hak Akses (Permission)</th>
                                                <th class="text-center" style="width: 16%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $index => $role)
                                                <tr class="{{ $editRole && $editRole->id === $role->id ? 'table-warning' : '' }}">
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td class="font-weight-semibold">
                                                        {{ $role->name }}
                                                        @if ($role->name === 'Super Admin')
                                                            <span class="badge badge-danger d-inline-block mt-1">Akses Penuh</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-info">{{ $role->users_count }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($role->name === 'Super Admin')
                                                            <span class="badge badge-success">Semua Permission ({{ $totalPermissions }})</span>
                                                        @else
                                                            @forelse ($role->permissions as $perm)
                                                                <span class="badge badge-light border mr-1 mb-1">{{ $perm->name }}</span>
                                                            @empty
                                                                <span class="text-muted small">Belum ada permission</span>
                                                            @endforelse
                                                        @endif
                                                    </td>
                                                    <td class="text-center text-nowrap">
                                                        <a href="{{ route('access.roles.index', ['edit' => $role->id]) }}"
                                                            class="btn btn-sm btn-warning" title="Edit Role">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($role->name !== 'Super Admin')
                                                            <form action="{{ route('access.roles.destroy', $role->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus role {{ $role->name }}?')">
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
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.js-check-all').on('click', function () {
            $('.js-role-permission:not(:disabled)').prop('checked', true);
        });
        $('.js-uncheck-all').on('click', function () {
            $('.js-role-permission:not(:disabled)').prop('checked', false);
        });
    });
</script>
@endpush
