@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Database Penghuni Rumah Dinas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Database</li>
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

        @php
            $canCreateSip = auth()->user()->can('sip.create');
            $canViewSip = auth()->user()->can('sip.view');
            $canExportSip = auth()->user()->can('sip.export');
            $canImportSip = auth()->user()->can('sip.import');
        @endphp

        <div class="card card-tni card-tni-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="sipTab" role="tablist">
                    @if ($canCreateSip)
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-input-link" data-toggle="tab" href="#tab-input" role="tab"
                                aria-controls="tab-input" aria-selected="true">
                                <i class="fas fa-edit mr-1"></i> Input Data
                            </a>
                        </li>
                    @endif
                    @if ($canViewSip)
                        <li class="nav-item">
                            <a class="nav-link {{ !$canCreateSip ? 'active' : '' }}" id="tab-all-link" data-toggle="tab" href="#tab-all" role="tab"
                                aria-controls="tab-all" aria-selected="{{ !$canCreateSip ? 'true' : 'false' }}">
                                <i class="fas fa-table mr-1"></i> All Data
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="sipTabContent">
                    @if ($canCreateSip)
                    <div class="tab-pane fade show active" id="tab-input" role="tabpanel"
                        aria-labelledby="tab-input-link">
                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-user-plus mr-2"></i>Form Input Data Penghuni Rumah Dinas
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('surat-izin.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- KIRI -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="NomorSIP">Nomor SIP</label>
                                                <textarea name="NomorSIP" id="NomorSIP" class="form-control"
                                                    placeholder="Masukkan Nomor SIP">{{ old('NomorSIP') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="Nama">Nama</label>
                                                <input type="text" name="Nama" id="Nama" class="form-control"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ old('Nama') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Pangkat">Pangkat</label>
                                                <select name="Pangkat" id="Pangkat" class="form-control">
                                                    <option value="">Pilih Pangkat</option>
                                                    @foreach ($pangkats as $pangkat)
                                                        <option value="{{ $pangkat->nama }}" {{ old('Pangkat') == $pangkat->nama ? 'selected' : '' }}>
                                                            {{ $pangkat->nama === '-' ? 'Tidak Ada' : $pangkat->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="Korps">Korps</label>
                                                <select name="Korps" id="Korps" class="form-control">
                                                    <option value="">Pilih Korps</option>
                                                    @foreach ($korpsList as $korps)
                                                        <option value="{{ $korps->kode }}" {{ old('Korps') == $korps->kode ? 'selected' : '' }}>
                                                            {{ $korps->kode === '-' ? 'Tidak Ada' : $korps->kode . ($korps->nama ? ' - ' . $korps->nama : '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="NRPNIP">NRP / NIP</label>
                                                <input type="text" name="NRPNIP" id="NRPNIP" class="form-control"
                                                    placeholder="Masukkan NRP / NIP Lengkap" value="{{ old('NRPNIP') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Jabatan">Jabatan</label>
                                                <input type="text" name="Jabatan" id="Jabatan" class="form-control"
                                                    placeholder="Masukkan Jabatan" value="{{ old('Jabatan') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Kesatuan">Kesatuan</label>
                                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                                    placeholder="Masukkan Kesatuan" value="{{ old('Kesatuan') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Ktp">No. KTP</label>
                                                <input type="text" name="Ktp" id="Ktp" class="form-control"
                                                    placeholder="Masukkan Nomor KTP" value="{{ old('Ktp') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Ttl">Tempat, Tanggal Lahir</label>
                                                <input type="text" name="Ttl" id="Ttl" class="form-control"
                                                    placeholder="Contoh: Jakarta, 01 Januari 1990"
                                                    value="{{ old('Ttl') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Status">Status</label>
                                                <select name="Status" id="Status" class="form-control">
                                                    <option value="">Pilih Status</option>
                                                    @foreach ($statusList as $status)
                                                        <option value="{{ $status->nama }}" {{ old('Status') == $status->nama ? 'selected' : '' }}>
                                                            {{ $status->nama === '-' ? 'Tidak Ada' : $status->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan"
                                                    class="form-control" placeholder="Masukkan Jumlah Tanggungan"
                                                    value="{{ old('JumlahTanggungan') }}">
                                            </div>
                                        </div>

                                        <!-- KANAN -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Kpad">KPAD</label>
                                                <select name="Kpad" id="Kpad" class="form-control">
                                                    <option value="">Pilih KPAD</option>
                                                    <option value="Lainnya" {{ old('Kpad') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                    @php $kpadCounter = 1; @endphp
                                                    @foreach ($kpadGroups as $wilayah => $kpads)
                                                        <optgroup label="{{ $wilayah }}">
                                                            @foreach ($kpads as $kpad)
                                                                <option value="{{ $kpad->nama_kpad }}" {{ old('Kpad') == $kpad->nama_kpad ? 'selected' : '' }}>
                                                                    {{ $kpadCounter++ }} {{ $kpad->nama_kpad }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" id="kpadLainnyaDiv"
                                                style="display: {{ old('Kpad') == 'Lainnya' ? 'block' : 'none' }};">
                                                <label for="KpadLainnya">Nama KPAD Lainnya</label>
                                                <input type="text" name="KpadLainnya" id="KpadLainnya" class="form-control"
                                                    placeholder="Masukkan Nama KPAD Lainnya"
                                                    value="{{ old('KpadLainnya') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="AlamatRumah">Alamat Rumah</label>
                                                <input type="text" name="AlamatRumah" id="AlamatRumah" class="form-control"
                                                    placeholder="Masukkan Alamat Rumah" value="{{ old('AlamatRumah') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="TypeLuas">Type / Luas</label>
                                                <input type="text" name="TypeLuas" id="TypeLuas" class="form-control"
                                                    placeholder="Contoh: 36/72" value="{{ old('TypeLuas') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Tmt">TMT</label>
                                                <input type="text" name="Tmt" id="Tmt" class="form-control"
                                                    placeholder="Masukkan TMT" value="{{ old('Tmt') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="NamaTtd">Nama Tanda Tangan</label>
                                                <input type="text" name="NamaTtd" id="NamaTtd" class="form-control"
                                                    placeholder="Nama yang bertanda tangan" value="{{ old('NamaTtd') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="NamaTtd2">Pangkat NRP / NIP</label>
                                                <input type="text" name="NamaTtd2" id="NamaTtd2" class="form-control"
                                                    placeholder="Kolonel Czi NRP 11000050710979"
                                                    value="{{ old('NamaTtd2') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="TanggalDibuat">Tanggal Dikeluarkan (Pada Tanggal)</label>
                                                <input type="date" name="TanggalDibuat" id="TanggalDibuat" class="form-control"
                                                    value="{{ old('TanggalDibuat', date('Y-m-d')) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="MasaBerlaku">Masa Berlaku SIP</label>
                                                <select name="MasaBerlaku" id="MasaBerlaku" class="form-control">
                                                    @php $selectedMasaBerlaku = (int) old('MasaBerlaku', 1); @endphp
                                                    @for ($tahun = 1; $tahun <= 5; $tahun++)
                                                        <option value="{{ $tahun }}" {{ $selectedMasaBerlaku === $tahun ? 'selected' : '' }}>
                                                            {{ $tahun }} Tahun
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>Anggota Keluarga</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="anggotaKeluargaTable">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Hubungan Keluarga</th>
                                                        <th class="text-center" style="width: 50px;">
                                                            <button type="button" id="addRow"
                                                                class="btn btn-sm btn-success" title="Tambah Baris">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="AnggotaKeluarga[0][nama]"
                                                                class="form-control"></td>
                                                        <td><input type="text" name="AnggotaKeluarga[0][umur]"
                                                                class="form-control"></td>
                                                        <td>
                                                            <select name="AnggotaKeluarga[0][jk]" class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="AnggotaKeluarga[0][hubungan]"
                                                                class="form-control">
                                                                <option value="">Pilih</option>
                                                                <option value="Suami">Suami</option>
                                                                <option value="Istri">Istri</option>
                                                                <option value="Anak">Anak</option>
                                                                <option value="Ayah">Ayah</option>
                                                                <option value="Ibu">Ibu</option>
                                                                <option value="Kakak">Kakak</option>
                                                                <option value="Adik">Adik</option>
                                                                <option value="Mertua">Mertua</option>
                                                                <option value="Menantu">Menantu</option>
                                                                <option value="Cucu">Cucu</option>
                                                                <option value="Keponakan">Keponakan</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <small class="text-muted">Maksimal 6 anggota keluarga (total 7 baris)</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="Keterangan">Keterangan</label>
                                        <textarea name="Keterangan" id="Keterangan" class="form-control" rows="2"
                                            placeholder="Masukkan Keterangan">{{ old('Keterangan') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-tni btn-block mt-3">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($canViewSip)
                    <div class="tab-pane fade {{ !$canCreateSip ? 'show active' : '' }}" id="tab-all" role="tabpanel" aria-labelledby="tab-all-link">
                        @if ($canExportSip || $canImportSip)
                        <div class="card card-outline card-success mb-3">
                            <div class="card-header bg-light">
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-file-export mr-2 text-success"></i>Ekspor &amp; Impor Data Penghuni Rumah Dinas
                                </h3>
                            </div>
                            <div class="card-body">
                                @if ($canExportSip)
                                    <p class="mb-2 text-muted">
                                        Anda dapat mengunduh data pengajuan rumah dinas dalam format Excel atau PDF.
                                        Filter dan pencarian aktif pada tabel di bawah otomatis ikut diterapkan saat mengunduh:
                                    </p>
                                    <div class="d-flex flex-wrap align-items-center mb-2">
                                        <a href="{{ route('exportExcel') }}" id="btnExportExcel"
                                            class="btn btn-success btn-sm mr-2 mb-1 js-export-excel"
                                            title="Unduh data sesuai filter aktif dalam format Excel">
                                            <i class="fas fa-file-excel mr-1"></i> Download Excel
                                        </a>
                                        <a href="{{ route('exportPdf') }}" id="btnExportPdf" target="_blank"
                                            class="btn btn-danger btn-sm mr-2 mb-1 js-export-pdf"
                                            title="Unduh data sesuai filter aktif dalam format PDF">
                                            <i class="fas fa-file-pdf mr-1"></i> Download PDF
                                        </a>
                                        <span id="exportFilterBadge" class="badge badge-light border text-dark px-2 py-1 mb-1">
                                            <i class="fas fa-filter mr-1 text-success"></i>Semua Data
                                        </span>
                                    </div>
                                    <small class="text-secondary d-block">
                                        * Pastikan data sudah benar sebelum melakukan ekspor. Untuk ribuan data, ekspor diproses per batch agar tetap ringan.
                                    </small>
                                @endif

                                @if ($canExportSip && $canImportSip)
                                    <hr>
                                @endif

                                @if ($canImportSip)
                                    <p class="mb-2 text-muted">
                                        Anda juga dapat melakukan <strong>import data</strong> dari file Excel untuk
                                        mempercepat pengisian data penghuni rumah dinas:
                                    </p>
                                    <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="col-md-5 mb-2 mb-md-0">
                                                <div class="custom-file">
                                                    <input type="file" name="file" accept=".xlsx,.xls"
                                                        class="custom-file-input" id="importExcelFile" required>
                                                    <label class="custom-file-label" for="importExcelFile">Pilih file Excel (.xlsx / .xls)...</label>
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <button type="submit" class="btn btn-tni btn-sm">
                                                    <i class="fas fa-upload mr-1"></i> Import Excel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <small class="text-secondary d-block mt-2">
                                        * Pastikan format file sesuai dengan template yang diberikan.
                                    </small>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="card card-tni mb-0">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">
                                    <i class="fas fa-home mr-2"></i>Data Penghuni Rumah Dinas
                                </h3>
                                @if ($canExportSip)
                                <div class="card-tools">
                                    <a href="{{ route('exportExcel') }}"
                                        class="btn btn-success btn-xs mr-1 js-export-excel"
                                        title="Download Excel sesuai filter aktif">
                                        <i class="fas fa-file-excel mr-1"></i> Excel
                                    </a>
                                    <a href="{{ route('exportPdf') }}" target="_blank"
                                        class="btn btn-danger btn-xs js-export-pdf"
                                        title="Download PDF sesuai filter aktif">
                                        <i class="fas fa-file-pdf mr-1"></i> PDF
                                    </a>
                                </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="border rounded bg-light p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label for="filterWilayah" class="small font-weight-bold mb-1">Wilayah Kodim</label>
                                            <select id="filterWilayah" class="custom-select custom-select-sm sip-filter">
                                                <option value="">Semua Wilayah</option>
                                                @foreach ($filterWilayahList as $wilayah)
                                                    <option value="{{ $wilayah }}">{{ $wilayah }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label for="filterKpad" class="small font-weight-bold mb-1">Nama KPAD</label>
                                            <select id="filterKpad" class="custom-select custom-select-sm sip-filter">
                                                <option value="">Semua KPAD</option>
                                                @foreach ($filterKpadGroups as $wilayah => $kpads)
                                                    <optgroup label="{{ $wilayah }}">
                                                        @foreach ($kpads as $kpad)
                                                            <option value="{{ $kpad->nama_kpad }}">{{ $kpad->nama_kpad }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                                <option value="__LAINNYA__">KPAD Lainnya (Data Lama/Manual)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label for="filterStatus" class="small font-weight-bold mb-1">Status Penghuni</label>
                                            <select id="filterStatus" class="custom-select custom-select-sm sip-filter">
                                                <option value="">Semua Status</option>
                                                @foreach ($filterStatusList as $status)
                                                    <option value="{{ $status->nama }}">
                                                        {{ $status->nama === '-' ? 'Tidak Ada' : $status->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2 mb-md-0">
                                            <label for="filterPangkat" class="small font-weight-bold mb-1">Pangkat / Gol</label>
                                            <select id="filterPangkat" class="custom-select custom-select-sm sip-filter">
                                                <option value="">Semua Pangkat/Gol</option>
                                                @foreach ($filterPangkats as $pangkat)
                                                    <option value="{{ $pangkat->nama }}">{{ $pangkat->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2 mb-md-0">
                                            <label for="filterKorps" class="small font-weight-bold mb-1">Korps</label>
                                            <select id="filterKorps" class="custom-select custom-select-sm sip-filter">
                                                <option value="">Semua Korps</option>
                                                @foreach ($filterKorpsList as $korps)
                                                    <option value="{{ $korps->nama }}">{{ $korps->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end justify-content-between">
                                            <button type="button" id="btnResetFilter" class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-undo mr-1"></i> Reset Filter
                                            </button>
                                            <span id="tableFilterSummary" class="small text-muted text-right ml-2">
                                                Semua data
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-tni"
                                        id="dataTableSuratIzin" style="width:100%">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th>Nama</th>
                                                <th>Pangkat/Gol</th>
                                                <th>Korps</th>
                                                <th>NRP/NIP</th>
                                                <th>Jabatan</th>
                                                <th>Kesatuan</th>
                                                <th>Nomor KTP</th>
                                                <th>Tempat Tanggal Lahir</th>
                                                <th>Status</th>
                                                <th>Jumlah Tanggungan</th>
                                                <th>Nama KPAD</th>
                                                <th>Alamat Rumah</th>
                                                <th>Type dan Luas</th>
                                                <th>Menempati Rumah TMT</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        #dataTableSuratIzin th,
        #dataTableSuratIzin td {
            vertical-align: middle !important;
        }

        #dataTableSuratIzin th {
            text-align: center;
        }

        .sip-editor-box {
            min-height: 100px;
            border: 1px solid #ced4da;
            padding: 8px 12px;
            border-radius: 4px;
            background: #ffffff;
            margin-bottom: 4px;
        }

        .sip-editor-box:focus {
            outline: none;
            border-color: #bfa14a;
            box-shadow: 0 0 0 0.2rem rgba(191, 161, 74, 0.25);
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof bsCustomFileInput !== 'undefined') {
                bsCustomFileInput.init();
            }

            var textarea = document.getElementById('NomorSIP');
            if (textarea) {
                var editor = document.createElement('div');
                editor.setAttribute('contenteditable', 'true');
                editor.className = 'sip-editor-box mb-2';
                editor.innerHTML = textarea.value;
                textarea.style.display = 'none';
                textarea.parentNode.insertBefore(editor, textarea);

                textarea.form.addEventListener('submit', function () {
                    textarea.value = editor.innerHTML;
                });
            }

            var kpadSelect = document.getElementById('Kpad');
            var kpadLainnyaDiv = document.getElementById('kpadLainnyaDiv');
            if (kpadSelect && kpadLainnyaDiv) {
                kpadSelect.addEventListener('change', function () {
                    kpadLainnyaDiv.style.display = this.value === 'Lainnya' ? 'block' : 'none';
                });
            }
        });
    </script>

    @if ($canViewSip)
    <script>
        $(function () {
            var baseExcelUrl = "{{ route('exportExcel') }}";
            var basePdfUrl = "{{ route('exportPdf') }}";
            var kpadGroupsData = @json($filterKpadGroups->map(fn ($items) => $items->pluck('nama_kpad')->values()));

            function populateKpadOptions(wilayah, preserveValue) {
                var $kpad = $('#filterKpad');
                $kpad.empty();

                if (!wilayah) {
                    $kpad.append($('<option>', { value: '', text: 'Semua KPAD' }));
                    $.each(kpadGroupsData, function (groupName, names) {
                        var $group = $('<optgroup>', { label: groupName });
                        $.each(names, function (_, name) {
                            $group.append($('<option>', { value: name, text: name }));
                        });
                        $kpad.append($group);
                    });
                    $kpad.append($('<option>', { value: '__LAINNYA__', text: 'KPAD Lainnya (Data Lama/Manual)' }));
                } else {
                    $kpad.append($('<option>', { value: '', text: 'Semua KPAD (' + wilayah + ')' }));
                    var list = kpadGroupsData[wilayah] || [];
                    $.each(list, function (_, name) {
                        $kpad.append($('<option>', { value: name, text: name }));
                    });
                }

                var hasPreserved = preserveValue && $kpad.find('option').filter(function () {
                    return this.value === preserveValue;
                }).length > 0;
                $kpad.val(hasPreserved ? preserveValue : '');
            }

            var table = $('#dataTableSuratIzin').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                searchDelay: 350,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('datatable') }}",
                    data: function (d) {
                        d.wilayah_kodim = $('#filterWilayah').val();
                        d.kpad = $('#filterKpad').val();
                        d.status = $('#filterStatus').val();
                        d.pangkat = $('#filterPangkat').val();
                        d.korps = $('#filterKorps').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'align-middle text-center' },
                    { data: 'Nama', name: 'Nama', className: 'align-middle' },
                    { data: 'Pangkat', name: 'Pangkat', className: 'align-middle' },
                    { data: 'Korps', name: 'Korps', className: 'align-middle' },
                    { data: 'NRPNIP', name: 'NRPNIP', className: 'align-middle' },
                    { data: 'Jabatan', name: 'Jabatan', className: 'align-middle' },
                    { data: 'Kesatuan', name: 'Kesatuan', className: 'align-middle' },
                    { data: 'Ktp', name: 'Ktp', className: 'align-middle' },
                    { data: 'Ttl', name: 'Ttl', className: 'align-middle' },
                    { data: 'Status', name: 'Status', className: 'align-middle' },
                    { data: 'JumlahTanggungan', name: 'JumlahTanggungan', className: 'align-middle text-center' },
                    { data: 'Kpad', name: 'Kpad', className: 'align-middle' },
                    { data: 'AlamatRumah', name: 'AlamatRumah', className: 'align-middle' },
                    { data: 'TypeLuas', name: 'TypeLuas', className: 'align-middle' },
                    { data: 'Tmt', name: 'Tmt', className: 'align-middle' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'align-middle text-center' }
                ],
                order: [[1, 'asc']],
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

            function getCurrentSearchValue() {
                var $searchInput = $('#dataTableSuratIzin_filter input');
                if ($searchInput.length) {
                    return $.trim($searchInput.val() || '');
                }
                return $.trim(table.search() || '');
            }

            function syncExportLinks() {
                var params = new URLSearchParams();
                var labels = [];

                var wilayah = $('#filterWilayah').val();
                var kpad = $('#filterKpad').val();
                var status = $('#filterStatus').val();
                var pangkat = $('#filterPangkat').val();
                var korps = $('#filterKorps').val();
                var search = getCurrentSearchValue();

                if (wilayah) {
                    params.set('wilayah_kodim', wilayah);
                    labels.push('Wilayah: ' + wilayah);
                }
                if (kpad) {
                    params.set('kpad', kpad);
                    labels.push('KPAD: ' + (kpad === '__LAINNYA__' ? 'Lainnya' : kpad));
                }
                if (status) {
                    params.set('status', status);
                    labels.push('Status: ' + (status === '-' ? 'Tidak Ada' : status));
                }
                if (pangkat) {
                    params.set('pangkat', pangkat);
                    labels.push('Pangkat: ' + pangkat);
                }
                if (korps) {
                    params.set('korps', korps);
                    labels.push('Korps: ' + korps);
                }
                if (search) {
                    params.set('search', search);
                    labels.push('Cari: "' + search + '"');
                }

                var qs = params.toString();
                var suffix = qs ? ('?' + qs) : '';
                $('.js-export-excel').attr('href', baseExcelUrl + suffix);
                $('.js-export-pdf').attr('href', basePdfUrl + suffix);

                var info = table.page.info();
                var countText = typeof info.recordsDisplay === 'number'
                    ? info.recordsDisplay.toLocaleString('id-ID') + ' data'
                    : '';

                if (labels.length > 0) {
                    var labelText = labels.join(' | ');
                    $('#exportFilterBadge')
                        .removeClass('badge-light text-dark')
                        .addClass('badge-warning text-dark')
                        .html('<i class="fas fa-filter mr-1"></i>Filter Aktif (' + countText + '): ' + $('<div>').text(labelText).html());
                    $('#tableFilterSummary').html('<strong>' + labels.length + ' filter aktif</strong> (' + countText + ')');
                } else {
                    $('#exportFilterBadge')
                        .removeClass('badge-warning')
                        .addClass('badge-light text-dark')
                        .html('<i class="fas fa-filter mr-1 text-success"></i>Semua Data' + (countText ? ' (' + countText + ')' : ''));
                    $('#tableFilterSummary').text(countText ? 'Menampilkan semua (' + countText + ')' : 'Semua data');
                }
            }

            $('#filterWilayah').on('change', function () {
                populateKpadOptions($(this).val(), $('#filterKpad').val());
                syncExportLinks();
                table.ajax.reload();
            });

            $('#filterKpad, #filterStatus, #filterPangkat, #filterKorps').on('change', function () {
                syncExportLinks();
                table.ajax.reload();
            });

            $('#btnResetFilter').on('click', function () {
                $('#filterWilayah').val('');
                populateKpadOptions('', '');
                $('#filterStatus').val('');
                $('#filterPangkat').val('');
                $('#filterKorps').val('');
                table.search('');
                syncExportLinks();
                table.ajax.reload();
            });

            table.on('draw.dt', function () {
                syncExportLinks();
            });

            $(document).on('input search', '#dataTableSuratIzin_filter input', function () {
                syncExportLinks();
            });

            $('.js-export-excel, .js-export-pdf').on('mousedown click', function () {
                syncExportLinks();
            });

            $('a[data-toggle="tab"][href="#tab-all"]').on('shown.bs.tab', function () {
                table.columns.adjust().responsive.recalc();
                syncExportLinks();
            });

            syncExportLinks();
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const anggotaTable = document.getElementById('anggotaKeluargaTable');
            const addRowBtn = document.getElementById('addRow');
            if (!anggotaTable || !addRowBtn) {
                return;
            }

            const hubunganOptions = `
                <option value="">Pilih</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Ayah">Ayah</option>
                <option value="Ibu">Ibu</option>
                <option value="Kakak">Kakak</option>
                <option value="Adik">Adik</option>
                <option value="Mertua">Mertua</option>
                <option value="Menantu">Menantu</option>
                <option value="Cucu">Cucu</option>
                <option value="Keponakan">Keponakan</option>
                <option value="Lainnya">Lainnya</option>
            `;

            function getCurrentRowCount() {
                return anggotaTable.querySelectorAll('tbody tr').length;
            }

            function getNextIndex() {
                let maxIdx = -1;
                anggotaTable.querySelectorAll('tbody tr').forEach(function (tr) {
                    const input = tr.querySelector('input[name^="AnggotaKeluarga["]');
                    if (input) {
                        const match = input.name.match(/AnggotaKeluarga\[(\d+)\]/);
                        if (match) {
                            const idx = parseInt(match[1], 10);
                            if (idx > maxIdx) maxIdx = idx;
                        }
                    }
                });
                return maxIdx + 1;
            }

            addRowBtn.addEventListener('click', function () {
                if (getCurrentRowCount() >= 7) {
                    alert("Maksimal 7 anggota keluarga");
                    return;
                }
                const nextIdx = getNextIndex();
                const tbody = anggotaTable.querySelector('tbody');
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="AnggotaKeluarga[${nextIdx}][nama]" class="form-control"></td>
                    <td><input type="text" name="AnggotaKeluarga[${nextIdx}][umur]" class="form-control"></td>
                    <td>
                        <select name="AnggotaKeluarga[${nextIdx}][jk]" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </td>
                    <td>
                        <select name="AnggotaKeluarga[${nextIdx}][hubungan]" class="form-control">
                            ${hubunganOptions}
                        </select>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger removeRow" title="Hapus Baris">
                            <i class="fas fa-minus"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            anggotaTable.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.removeRow');
                if (removeBtn) {
                    removeBtn.closest('tr').remove();
                }
            });
        });
    </script>
@endpush
