@extends('layouts.app')

@section('content-header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">Edit Data Riwayat</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('surat-izin.create') }}">Database</a></li>
                <li class="breadcrumb-item active">Edit Riwayat</li>
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

        <div class="mb-3">
            <a href="{{ route('surat-izin.create') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="card card-tni">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-user-edit mr-2"></i>Form Edit Data Riwayat Penghuni
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('surat-izin-history.update', $suratIzin->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- KIRI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NomorSIP">Nomor SIP</label>
                                <textarea name="NomorSIP" id="NomorSIP" class="form-control"
                                    placeholder="Masukkan Nomor SIP">{!! old('NomorSIP', $suratIzin->NomorSIP) !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input type="text" name="Nama" id="Nama" class="form-control"
                                    placeholder="Masukkan Nama Lengkap"
                                    value="{{ old('Nama', $suratIzin->Nama) }}">
                            </div>
                            <div class="form-group">
                                <label for="Pangkat">Pangkat</label>
                                <select name="Pangkat" id="Pangkat" class="form-control">
                                    <option value="">Pilih Pangkat</option>
                                    @php $selectedPangkat = old('Pangkat', $suratIzin->Pangkat); @endphp
                                    @foreach($pangkats as $pangkat)
                                        <option value="{{ $pangkat->nama }}" {{ $selectedPangkat == $pangkat->nama ? 'selected' : '' }}>
                                            {{ $pangkat->nama === '-' ? 'Tidak Ada' : $pangkat->nama }}
                                        </option>
                                    @endforeach
                                    @if($selectedPangkat && !$pangkats->contains('nama', $selectedPangkat))
                                        <option value="{{ $selectedPangkat }}" selected>{{ $selectedPangkat }} (Data Lama)</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Korps">Korps</label>
                                <select name="Korps" id="Korps" class="form-control">
                                    <option value="">Pilih Korps</option>
                                    @php $selectedKorps = old('Korps', $suratIzin->Korps); @endphp
                                    @foreach($korpsList as $korps)
                                        <option value="{{ $korps->kode }}" {{ $selectedKorps == $korps->kode ? 'selected' : '' }}>
                                            {{ $korps->kode === '-' ? 'Tidak Ada' : $korps->kode . ($korps->nama ? ' - ' . $korps->nama : '') }}
                                        </option>
                                    @endforeach
                                    @if($selectedKorps && !$korpsList->contains('kode', $selectedKorps))
                                        <option value="{{ $selectedKorps }}" selected>{{ $selectedKorps }} (Data Lama)</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="NRPNIP">NRP / NIP</label>
                                <input type="text" name="NRPNIP" id="NRPNIP" class="form-control"
                                    placeholder="Masukkan NRP / NIP Lengkap"
                                    value="{{ old('NRPNIP', $suratIzin->NRPNIP) }}">
                            </div>
                            <div class="form-group">
                                <label for="Jabatan">Jabatan</label>
                                <input type="text" name="Jabatan" id="Jabatan" class="form-control"
                                    placeholder="Masukkan Jabatan"
                                    value="{{ old('Jabatan', $suratIzin->Jabatan) }}">
                            </div>
                            <div class="form-group">
                                <label for="Kesatuan">Kesatuan</label>
                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                    placeholder="Masukkan Kesatuan"
                                    value="{{ old('Kesatuan', $suratIzin->Kesatuan) }}">
                            </div>
                            <div class="form-group">
                                <label for="Ktp">No. KTP</label>
                                <input type="text" name="Ktp" id="Ktp" class="form-control"
                                    placeholder="Masukkan Nomor KTP"
                                    value="{{ old('Ktp', $suratIzin->Ktp) }}">
                            </div>
                            <div class="form-group">
                                <label for="Ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" name="Ttl" id="Ttl" class="form-control"
                                    placeholder="Contoh: Jakarta, 01 Januari 1990"
                                    value="{{ old('Ttl', $suratIzin->Ttl) }}">
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select name="Status" id="Status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    @php $selectedStatus = old('Status', $suratIzin->Status); @endphp
                                    @foreach($statusList as $status)
                                        <option value="{{ $status->nama }}" {{ $selectedStatus == $status->nama ? 'selected' : '' }}>
                                            {{ $status->nama === '-' ? 'Tidak Ada' : $status->nama }}
                                        </option>
                                    @endforeach
                                    @if($selectedStatus && !$statusList->contains('nama', $selectedStatus))
                                        <option value="{{ $selectedStatus }}" selected>{{ $selectedStatus }} (Data Lama)</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan"
                                    class="form-control" placeholder="Masukkan Jumlah Tanggungan"
                                    value="{{ old('JumlahTanggungan', $suratIzin->JumlahTanggungan) }}">
                            </div>
                        </div>

                        <!-- KANAN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Kpad">KPAD</label>
                                <select name="Kpad" id="Kpad" class="form-control">
                                    @php
                                        $selectedKpad = old('Kpad', $suratIzin->Kpad);
                                        $kpadMatched = false;
                                        $kpadCounter = 1;
                                    @endphp
                                    <option value="">Pilih KPAD</option>
                                    <option value="Lainnya" {{ $selectedKpad == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    @foreach($kpadGroups as $wilayah => $kpads)
                                        <optgroup label="{{ $wilayah }}">
                                            @foreach($kpads as $kpad)
                                                @php
                                                    $isMatch = $selectedKpad && strcasecmp((string) $selectedKpad, (string) $kpad->nama_kpad) === 0;
                                                    if ($isMatch) {
                                                        $kpadMatched = true;
                                                    }
                                                @endphp
                                                <option value="{{ $kpad->nama_kpad }}" {{ $isMatch ? 'selected' : '' }}>
                                                    {{ $kpadCounter++ }} {{ $kpad->nama_kpad }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                    @if($selectedKpad && $selectedKpad !== 'Lainnya' && !$kpadMatched)
                                        <option value="{{ $selectedKpad }}" selected>{{ $selectedKpad }} (Data Lama / Lainnya)</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group" id="kpadLainnyaDiv"
                                style="display: {{ old('Kpad', $suratIzin->Kpad) == 'Lainnya' ? 'block' : 'none' }};">
                                <label for="KpadLainnya">Nama KPAD Lainnya</label>
                                <input type="text" name="KpadLainnya" id="KpadLainnya" class="form-control"
                                    placeholder="Masukkan Nama KPAD Lainnya"
                                    value="{{ old('KpadLainnya', $suratIzin->KpadLainnya) }}">
                            </div>
                            <div class="form-group">
                                <label for="AlamatRumah">Alamat Rumah</label>
                                <input type="text" name="AlamatRumah" id="AlamatRumah" class="form-control"
                                    placeholder="Masukkan Alamat Rumah"
                                    value="{{ old('AlamatRumah', $suratIzin->AlamatRumah) }}">
                            </div>
                            <div class="form-group">
                                <label for="TypeLuas">Type / Luas</label>
                                <input type="text" name="TypeLuas" id="TypeLuas" class="form-control"
                                    placeholder="Contoh: 36/72"
                                    value="{{ old('TypeLuas', $suratIzin->TypeLuas) }}">
                            </div>
                            <div class="form-group">
                                <label for="Tmt">TMT</label>
                                <input type="text" name="Tmt" id="Tmt" class="form-control"
                                    placeholder="Masukkan TMT" value="{{ old('Tmt', $suratIzin->Tmt) }}">
                            </div>
                            <div class="form-group">
                                <label for="NamaTtd">Nama Tanda Tangan</label>
                                <input type="text" name="NamaTtd" id="NamaTtd" class="form-control"
                                    value="{{ old('NamaTtd', $suratIzin->NamaTtd) }}"
                                    placeholder="Nama yang bertanda tangan">
                            </div>
                            <div class="form-group">
                                <label for="NamaTtd2">Pangkat NRP / NIP</label>
                                <input type="text" name="NamaTtd2" id="NamaTtd2" class="form-control"
                                    value="{{ old('NamaTtd2', $suratIzin->NamaTtd2) }}"
                                    placeholder="Kolonel Czi NRP 11000050710979">
                            </div>
                            <div class="form-group">
                                <label for="TanggalDibuat">Tanggal Dikeluarkan (Pada Tanggal)</label>
                                <input type="date" name="TanggalDibuat" id="TanggalDibuat" class="form-control"
                                    value="{{ old('TanggalDibuat', $suratIzin->TanggalDibuat) }}">
                                <small class="form-text text-muted">Kosongkan untuk memakai tanggal input data.</small>
                            </div>
                            <div class="form-group">
                                <label for="MasaBerlaku">Masa Berlaku SIP</label>
                                <select name="MasaBerlaku" id="MasaBerlaku" class="form-control">
                                    @php $selectedMasaBerlaku = (int) old('MasaBerlaku', $suratIzin->MasaBerlaku ?: 1); @endphp
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
                                            <button type="button" id="addRow" class="btn btn-sm btn-success"
                                                title="Tambah Baris">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $anggotaKeluarga = old('AnggotaKeluarga', $suratIzin->AnggotaKeluarga ?? []);
                                        if (!is_array($anggotaKeluarga)) {
                                            $anggotaKeluarga = json_decode($anggotaKeluarga, true) ?: [];
                                        }
                                        if (empty($anggotaKeluarga)) {
                                            $anggotaKeluarga = [[]];
                                        }
                                    @endphp
                                    @foreach($anggotaKeluarga as $i => $anggota)
                                        <tr>
                                            <td>
                                                <input type="text" name="AnggotaKeluarga[{{ $i }}][nama]"
                                                    class="form-control" value="{{ $anggota['nama'] ?? '' }}">
                                            </td>
                                            <td>
                                                <input type="text" name="AnggotaKeluarga[{{ $i }}][umur]"
                                                    class="form-control" value="{{ $anggota['umur'] ?? '' }}">
                                            </td>
                                            <td>
                                                <select name="AnggotaKeluarga[{{ $i }}][jk]" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="Laki-laki" {{ ($anggota['jk'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ ($anggota['jk'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="AnggotaKeluarga[{{ $i }}][hubungan]" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="Suami" {{ ($anggota['hubungan'] ?? '') == 'Suami' ? 'selected' : '' }}>Suami</option>
                                                    <option value="Istri" {{ ($anggota['hubungan'] ?? '') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                                    <option value="Anak" {{ ($anggota['hubungan'] ?? '') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                                    <option value="Ayah" {{ ($anggota['hubungan'] ?? '') == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                                    <option value="Ibu" {{ ($anggota['hubungan'] ?? '') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                                    <option value="Kakak" {{ ($anggota['hubungan'] ?? '') == 'Kakak' ? 'selected' : '' }}>Kakak</option>
                                                    <option value="Adik" {{ ($anggota['hubungan'] ?? '') == 'Adik' ? 'selected' : '' }}>Adik</option>
                                                    <option value="Mertua" {{ ($anggota['hubungan'] ?? '') == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                                                    <option value="Menantu" {{ ($anggota['hubungan'] ?? '') == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                                                    <option value="Cucu" {{ ($anggota['hubungan'] ?? '') == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                                    <option value="Keponakan" {{ ($anggota['hubungan'] ?? '') == 'Keponakan' ? 'selected' : '' }}>Keponakan</option>
                                                    <option value="Lainnya" {{ ($anggota['hubungan'] ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                @if($i > 0)
                                                    <button type="button" class="btn btn-sm btn-danger removeRow"
                                                        title="Hapus Baris">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <small class="text-muted">Maksimal 6 anggota keluarga (total 7 baris)</small>
                    </div>

                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <textarea name="Keterangan" id="Keterangan" class="form-control" rows="2"
                            placeholder="Masukkan Keterangan">{{ old('Keterangan', $suratIzin->Keterangan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-tni btn-block mt-3">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            const anggotaTable = document.getElementById('anggotaKeluargaTable');
            const addRowBtn = document.getElementById('addRow');

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
