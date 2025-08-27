@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <script>
                window.location.reload();
            </script>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">


            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-input">
                        <h4>Edit Data</h4>
                        <p>Formulir edit data penghuni akan diletakkan di sini.</p>
                        <div class="card mb-4">
                            <div class="card-header text-white" style="background-color: #4b5320;">
                                Form Edit Data
                            </div>
                            <div class="card-body">
                                <form action="{{ route('surat-izin.update', $suratIzin->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <!-- KIRI -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="NomorSIP">Nomor SIP</label>
                                                <textarea name="NomorSIP" id="NomorSIP" class="form-control"
                                                    placeholder="Masukkan Nomor SIP">{!! old('NomorSIP', $suratIzin->NomorSIP) !!}</textarea>
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        var textarea = document.getElementById('NomorSIP');
                                                        var editor = document.createElement('div');
                                                        editor.setAttribute('contenteditable', 'true');
                                                        editor.setAttribute('style', 'min-height:100px;border:1px solid #ced4da;padding:8px;border-radius:4px;background:#fff;margin-bottom:4px;');
                                                        editor.className = 'mb-2';
                                                        editor.innerHTML = textarea.value;
                                                        textarea.style.display = 'none';
                                                        textarea.parentNode.insertBefore(editor, textarea);

                                                        textarea.form.addEventListener('submit', function () {
                                                            textarea.value = editor.innerHTML;
                                                        });
                                                    });
                                                </script>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Nama">Nama</label>
                                                <input type="text" name="Nama" id="Nama" class="form-control"
                                                    placeholder="Masukkan Nama Lengkap"
                                                    value="{{ old('Nama', $suratIzin->Nama) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Pangkat">Pangkat</label>
                                                <select name="Pangkat" id="Pangkat" class="form-control">
                                                    <option value="">Pilih Pangkat</option>
                                                    @php
                                                        $pangkatList = [
                                                            "Jenderal TNI",
                                                            "Letnan Jenderal TNI",
                                                            "Mayor Jenderal TNI",
                                                            "Brigadir Jenderal TNI",
                                                            "Kolonel",
                                                            "Letnan Kolonel",
                                                            "Mayor",
                                                            "Kapten",
                                                            "Letnan Satu",
                                                            "Letnan Dua",
                                                            "Pembantu Letnan Satu",
                                                            "Pembantu Letnan Dua",
                                                            "Sersan Mayor",
                                                            "Sersan Kepala",
                                                            "Sersan Satu",
                                                            "Sersan Dua",
                                                            "Kopral Kepala",
                                                            "Kopral Satu",
                                                            "Kopral Dua",
                                                            "Prajurit Kepala",
                                                            "Prajurit Satu",
                                                            "Prajurit Dua",
                                                            "PNS IV/d",
                                                            "PNS IV/c",
                                                            "PNS IV/b",
                                                            "PNS IV/a",
                                                            "PNS III/d",
                                                            "PNS III/c",
                                                            "PNS III/b",
                                                            "PNS III/a",
                                                            "PNS II/d",
                                                            "PNS II/c",
                                                            "PNS II/b",
                                                            "PNS II/a",
                                                            "PNS I/d",
                                                            "PNS I/c",
                                                            "PNS I/b",
                                                            "PNS I/a",
                                                            "-"
                                                        ];
                                                    @endphp
                                                    @foreach($pangkatList as $pangkat)
                                                        <option value="{{ $pangkat }}" {{ old('Pangkat', $suratIzin->Pangkat) == $pangkat ? 'selected' : '' }}>{{ $pangkat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Korps">Korps</label>
                                                <select name="Korps" id="Korps" class="form-control">
                                                    <option value="">Pilih Korps</option>
                                                    @php
                                                        $korpsList = [
                                                            "Inf",
                                                            "Arh",
                                                            "Arm",
                                                            "Kav",
                                                            "Czi",
                                                            "Cke",
                                                            "Cpl",
                                                            "Cba",
                                                            "Ckm",
                                                            "Ctp",
                                                            "Cku",
                                                            "Caj",
                                                            "Chk",
                                                            "Cpm",
                                                            "Cpn",
                                                            "-"
                                                        ];
                                                    @endphp
                                                    @foreach($korpsList as $korps)
                                                        <option value="{{ $korps }}" {{ old('Korps', $suratIzin->Korps) == $korps ? 'selected' : '' }}>{{ $korps }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="NRPNIP">NRP / NIP</label>
                                                <input type="number" name="NRPNIP" id="NRPNIP" class="form-control"
                                                    placeholder="Masukkan NRP / NIP Lengkap"
                                                    value="{{ old('NRPNIP', $suratIzin->NRPNIP) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Jabatan">Jabatan</label>
                                                <input type="text" name="Jabatan" id="Jabatan" class="form-control"
                                                    placeholder="Masukkan Jabatan"
                                                    value="{{ old('Jabatan', $suratIzin->Jabatan) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Kesatuan">Kesatuan</label>
                                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                                    placeholder="Masukkan Kesatuan"
                                                    value="{{ old('Kesatuan', $suratIzin->Kesatuan) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Ktp">No. KTP</label>
                                                <input type="text" name="Ktp" id="Ktp" class="form-control"
                                                    placeholder="Masukkan Nomor KTP"
                                                    value="{{ old('Ktp', $suratIzin->Ktp) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Ttl">Tempat, Tanggal Lahir</label>
                                                <input type="text" name="Ttl" id="Ttl" class="form-control"
                                                    placeholder="Contoh: Jakarta, 01 Januari 1990"
                                                    value="{{ old('Ttl', $suratIzin->Ttl) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Status">Status</label>
                                                <select name="Status" id="Status" class="form-control">
                                                    <option value="">Pilih Status</option>
                                                    @php
                                                        $statusList = [
                                                            "AKTIF",
                                                            "PURNAWIRAWAN",
                                                            "WARAKAWURI",
                                                            "WREDATAMA",
                                                            "JANDA WREDATAMA",
                                                            "DUDA WREDATAMA",
                                                            "DUDA",
                                                            "-"
                                                        ];
                                                    @endphp
                                                    @foreach($statusList as $status)
                                                        <option value="{{ $status }}" {{ old('Status', $suratIzin->Status) == $status ? 'selected' : '' }}>{{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan"
                                                    class="form-control" placeholder="Masukkan Jumlah Tanggungan"
                                                    value="{{ old('JumlahTanggungan', $suratIzin->JumlahTanggungan) }}">
                                            </div>
                                        </div>
                                        <!-- KANAN -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="Kpad">KPAD</label>
                                                <select name="Kpad" id="Kpad" class="form-control">
                                                    <option value="">Pilih KPAD</option>
                                                    <option value="Lainnya" {{ old('Kpad', $suratIzin->Kpad) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                    <optgroup label="WILAYAH KODIM 0501/JP">
                                                        <option value="ABDUL RAHMAN SALEH" {{ old('Kpad', $suratIzin->Kpad) == 'ABDUL RAHMAN SALEH' ? 'selected' : '' }}>1
                                                            ABDUL RAHMAN SALEH</option>
                                                        <option value="DR. WAHIDIN" {{ old('Kpad', $suratIzin->Kpad) == 'DR. WAHIDIN' ? 'selected' : '' }}>2 DR. WAHIDIN</option>
                                                        <option value="KWINI" {{ old('Kpad', $suratIzin->Kpad) == 'KWINI' ? 'selected' : '' }}>3 KWINI</option>
                                                        <option value="KWITANG TIMUR" {{ old('Kpad', $suratIzin->Kpad) == 'KWITANG TIMUR' ? 'selected' : '' }}>4
                                                            KWITANG TIMUR</option>
                                                        <option value="SENEN RAYA" {{ old('Kpad', $suratIzin->Kpad) == 'SENEN RAYA' ? 'selected' : '' }}>5 SENEN RAYA</option>
                                                        <option value="SUMUR BATU" {{ old('Kpad', $suratIzin->Kpad) == 'SUMUR BATU' ? 'selected' : '' }}>6 SUMUR BATU</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0502/JU">
                                                        <option value="LAGOA CEMARA" {{ old('Kpad', $suratIzin->Kpad) == 'LAGOA CEMARA' ? 'selected' : '' }}>7 LAGOA
                                                            CEMARA</option>
                                                        <option value="PEMANDANGAN" {{ old('Kpad', $suratIzin->Kpad) == 'PEMANDANGAN' ? 'selected' : '' }}>8
                                                            PEMANDANGAN</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0503/JB">
                                                        <option value="JELAMBAR ILIR" {{ old('Kpad', $suratIzin->Kpad) == 'JELAMBAR ILIR' ? 'selected' : '' }}>9
                                                            JELAMBAR ILIR</option>
                                                        <option value="KALIDERES" {{ old('Kpad', $suratIzin->Kpad) == 'KALIDERES' ? 'selected' : '' }}>10 KALIDERES
                                                        </option>
                                                        <option value="KEBON JERUK KODAM" {{ old('Kpad', $suratIzin->Kpad) == 'KEBON JERUK KODAM' ? 'selected' : '' }}>11
                                                            KEBON JERUK KODAM</option>
                                                        <option value="KEBON JERUK MABAD" {{ old('Kpad', $suratIzin->Kpad) == 'KEBON JERUK MABAD' ? 'selected' : '' }}>12
                                                            KEBON JERUK MABAD</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0504/JS">
                                                        <option value="TANAH KUSIR" {{ old('Kpad', $suratIzin->Kpad) == 'TANAH KUSIR' ? 'selected' : '' }}>13 TANAH KUSIR</option>
                                                        <option value="RAWAJATI" {{ old('Kpad', $suratIzin->Kpad) == 'RAWAJATI' ? 'selected' : '' }}>14 RAWAJATI
                                                        </option>
                                                        <option value="LENTENG AGUNG MABAD I" {{ old('Kpad', $suratIzin->Kpad) == 'LENTENG AGUNG MABAD I' ? 'selected' : '' }}>
                                                            15 LENTENG AGUNG MABAD I</option>
                                                        <option value="LENTENG AGUNG MABAD II" {{ old('Kpad', $suratIzin->Kpad) == 'LENTENG AGUNG MABAD II' ? 'selected' : '' }}>16 LENTENG AGUNG MABAD II</option>
                                                        <option value="BINTARO" {{ old('Kpad', $suratIzin->Kpad) == 'BINTARO' ? 'selected' : '' }}>17 BINTARO</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0505/JT">
                                                        <option value="ASRAMA SENG" {{ old('Kpad', $suratIzin->Kpad) == 'ASRAMA SENG' ? 'selected' : '' }}>18 ASRAMA
                                                            SENG</option>
                                                        <option value="BERLAND" {{ old('Kpad', $suratIzin->Kpad) == 'BERLAND' ? 'selected' : '' }}>19 BERLAND</option>
                                                        <option value="BILLIMON" {{ old('Kpad', $suratIzin->Kpad) == 'BILLIMON' ? 'selected' : '' }}>20 BILLIMON
                                                        </option>
                                                        <option value="BULAK RANTAI" {{ old('Kpad', $suratIzin->Kpad) == 'BULAK RANTAI' ? 'selected' : '' }}>21 BULAK
                                                            RANTAI</option>
                                                        <option value="CAKUNG" {{ old('Kpad', $suratIzin->Kpad) == 'CAKUNG' ? 'selected' : '' }}>22 CAKUNG</option>
                                                        <option value="CEGER" {{ old('Kpad', $suratIzin->Kpad) == 'CEGER' ? 'selected' : '' }}>23 CEGER</option>
                                                        <option value="CIBUBUR" {{ old('Kpad', $suratIzin->Kpad) == 'CIBUBUR' ? 'selected' : '' }}>24 CIBUBUR</option>
                                                        <option value="CIJANTUNG II" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG II' ? 'selected' : '' }}>25
                                                            CIJANTUNG II</option>
                                                        <option value="CIJANTUNG III (KOBANGDIKLAT)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG III (KOBANGDIKLAT)' ? 'selected' : '' }}>26 CIJANTUNG III (KOBANGDIKLAT)</option>
                                                        <option value="CIJANTUNG IV (BARET BIRU)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG IV (BARET BIRU)' ? 'selected' : '' }}>27 CIJANTUNG IV (BARET BIRU)</option>
                                                    </optgroup>
                                                    <optgroup label="NAMA KPAD">
                                                        <option value="CIJANTUNG IV (RADAR)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG IV (RADAR)' ? 'selected' : '' }}>
                                                            28 CIJANTUNG IV (RADAR)</option>
                                                        <option value="CIJANTUNG SEDERHANA" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG SEDERHANA' ? 'selected' : '' }}>29
                                                            CIJANTUNG SEDERHANA</option>
                                                        <option value="CIJANTUNG ZENI" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG ZENI' ? 'selected' : '' }}>30
                                                            CIJANTUNG ZENI</option>
                                                        <option value="CILILITAN II (3 MEI)" {{ old('Kpad', $suratIzin->Kpad) == 'CILILITAN II (3 MEI)' ? 'selected' : '' }}>
                                                            31 CILILITAN II (3 MEI)</option>
                                                        <option value="CIPAYUNG KODAM" {{ old('Kpad', $suratIzin->Kpad) == 'CIPAYUNG KODAM' ? 'selected' : '' }}>32
                                                            CIPAYUNG KODAM</option>
                                                        <option value="CIPAYUNG MABAD" {{ old('Kpad', $suratIzin->Kpad) == 'CIPAYUNG MABAD' ? 'selected' : '' }}>33
                                                            CIPAYUNG MABAD</option>
                                                        <option value="CIPINANG JAYA" {{ old('Kpad', $suratIzin->Kpad) == 'CIPINANG JAYA' ? 'selected' : '' }}>34
                                                            CIPINANG JAYA</option>
                                                        <option value="GUPUS TEKMEK" {{ old('Kpad', $suratIzin->Kpad) == 'GUPUS TEKMEK' ? 'selected' : '' }}>35 GUPUS
                                                            TEKMEK</option>
                                                        <option value="JATIWARINGIN" {{ old('Kpad', $suratIzin->Kpad) == 'JATIWARINGIN' ? 'selected' : '' }}>36
                                                            JATIWARINGIN</option>
                                                        <option value="JEND. URIP SUMOHARJO" {{ old('Kpad', $suratIzin->Kpad) == 'JEND. URIP SUMOHARJO' ? 'selected' : '' }}>
                                                            37 JEND. URIP SUMOHARJO</option>
                                                        <option value="OTISTA III" {{ old('Kpad', $suratIzin->Kpad) == 'OTISTA III' ? 'selected' : '' }}>38 OTISTA III</option>
                                                        <option value="DUMP TRUCK MENZIKON" {{ old('Kpad', $suratIzin->Kpad) == 'DUMP TRUCK MENZIKON' ? 'selected' : '' }}>39
                                                            DUMP TRUCK MENZIKON</option>
                                                        <option value="SLAMET RIYADI" {{ old('Kpad', $suratIzin->Kpad) == 'SLAMET RIYADI' ? 'selected' : '' }}>40
                                                            SLAMET RIYADI</option>
                                                        <option value="ZENI KRAMAT JATI" {{ old('Kpad', $suratIzin->Kpad) == 'ZENI KRAMAT JATI' ? 'selected' : '' }}>41
                                                            ZENI KRAMAT JATI</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0506/TGR">
                                                        <option value="REMPoa MABAD 21" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 21' ? 'selected' : '' }}>42
                                                            REMPOA MABAD 21</option>
                                                        <option value="REMPoa MABAD 25/60/124" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 25/60/124' ? 'selected' : '' }}>43 REMPOA MABAD 25/60/124</option>
                                                        <option value="REMPoa MABAD 55/65" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 55/65' ? 'selected' : '' }}>44
                                                            REMPOA MABAD 55/65</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0507/BKS">
                                                        <option value="JATIWARNA" {{ old('Kpad', $suratIzin->Kpad) == 'JATIWARNA' ? 'selected' : '' }}>45 JATIWARNA
                                                        </option>
                                                        <option value="KOLOGAD" {{ old('Kpad', $suratIzin->Kpad) == 'KOLOGAD' ? 'selected' : '' }}>46 KOLOGAD</option>
                                                        <option value="PALAD" {{ old('Kpad', $suratIzin->Kpad) == 'PALAD' ? 'selected' : '' }}>47 PALAD</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3" id="kpadLainnyaDiv"
                                                style="display: {{ old('Kpad', $suratIzin->Kpad) == 'Lainnya' ? 'block' : 'none' }};">
                                                <label for="KpadLainnya">Nama KPAD Lainnya</label>
                                                <input type="text" name="KpadLainnya" id="KpadLainnya" class="form-control"
                                                    placeholder="Masukkan Nama KPAD Lainnya"
                                                    value="{{ old('KpadLainnya', $suratIzin->KpadLainnya) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="AlamatRumah">Alamat Rumah</label>
                                                <input type="text" name="AlamatRumah" id="AlamatRumah" class="form-control"
                                                    placeholder="Masukkan Alamat Rumah"
                                                    value="{{ old('AlamatRumah', $suratIzin->AlamatRumah) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="TypeLuas">Type / Luas</label>
                                                <input type="text" name="TypeLuas" id="TypeLuas" class="form-control"
                                                    placeholder="Contoh: 36/72"
                                                    value="{{ old('TypeLuas', $suratIzin->TypeLuas) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Tmt">TMT</label>
                                                <input type="text" name="Tmt" id="Tmt" class="form-control"
                                                    placeholder="Masukkan TMT" value="{{ old('Tmt', $suratIzin->Tmt) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 mt-3">
                                        <label>Anggota Keluarga</label>
                                        <table class="table table-bordered" id="anggotaKeluargaTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Hubungan Keluarga</th>
                                                    <th>
                                                        <button type="button" id="addRow"
                                                            class="btn btn-sm btn-success">+</button>
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
                                                            <select name="AnggotaKeluarga[{{ $i }}][hubungan]"
                                                                class="form-control">
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
                                                        <td>
                                                            @if($i > 0)
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger removeRow">−</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <small class="text-muted">Maksimal 6 anggota keluarga</small>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Keterangan">Keterangan</label>
                                        <textarea name="Keterangan" id="Keterangan" class="form-control" rows="2"
                                            placeholder="Masukkan Keterangan">{{ old('Keterangan', $suratIzin->Keterangan) }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3 w-100">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @push('styles')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
            <style>
                /* Tambahan styling agar datatable lebih rapi */
                #dataTableSuratIzin th,
                #dataTableSuratIzin td {
                    vertical-align: middle !important;
                    text-align: center;
                }

                #dataTableSuratIzin_wrapper .row {
                    margin-bottom: 0.5rem;
                }

                #dataTableSuratIzin_filter {
                    text-align: right !important;
                }

                #dataTableSuratIzin_filter input {
                    border-radius: 8px;
                }
            </style>
        @endpush

        @push('scripts')
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var kpadSelect = document.getElementById('Kpad');
                    var kpadLainnyaDiv = document.getElementById('kpadLainnyaDiv');
                    kpadSelect.addEventListener('change', function () {
                        if (this.value === 'Lainnya') {
                            kpadLainnyaDiv.style.display = 'block';
                        } else {
                            kpadLainnyaDiv.style.display = 'none';
                        }
                    });
                });
            </script>
            <script>
                $(function () {
                    var table = $('#dataTableSuratIzin').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: false,
                        ajax: {
                            url: "{{ route('datatable') }}",
                            data: function (d) {
                                d.status = $('#filterStatus').val();
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
                            { data: 'JumlahTanggungan', name: 'JumlahTanggungan', className: 'align-middle' },
                            { data: 'Kpad', name: 'Kpad', className: 'align-middle' },
                            { data: 'AlamatRumah', name: 'AlamatRumah', className: 'align-middle' },
                            { data: 'TypeLuas', name: 'TypeLuas', className: 'align-middle' },
                            { data: 'Tmt', name: 'Tmt', className: 'align-middle' },
                            { data: 'action', name: 'action', className: 'align-middle' },

                        ],
                        order: [[1, 'asc']],
                        language: {
                            "search": "Cari:",
                            "lengthMenu": "Tampilkan _MENU_ data",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            "infoEmpty": "Tidak ada data",
                            "zeroRecords": "Data tidak ditemukan",
                            "paginate": {
                                "first": "Pertama",
                                "last": "Terakhir",
                                "next": "Berikutnya",
                                "previous": "Sebelumnya"
                            }
                        },
                        dom: '<"row mb-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-end"f>>rtip'
                    });

                    // Event untuk filter status
                    $('#filterStatus').on('change', function () {

                        table.ajax.reload();
                    });
                });
            </script>
            <script>
                $(function () {
                    var table = $('#tablehistory').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: false,
                        ajax: {
                            url: "{{ route('History') }}",
                            data: function (d) {
                                d.status = $('#filterStatus').val();
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
                            { data: 'JumlahTanggungan', name: 'JumlahTanggungan', className: 'align-middle' },
                            { data: 'Kpad', name: 'Kpad', className: 'align-middle' },
                            { data: 'AlamatRumah', name: 'AlamatRumah', className: 'align-middle' },
                            { data: 'TypeLuas', name: 'TypeLuas', className: 'align-middle' },
                            { data: 'Tmt', name: 'Tmt', className: 'align-middle' },
                            { data: 'action', name: 'action', className: 'align-middle' },


                        ],
                        order: [[1, 'asc']],
                        language: {
                            "search": "Cari:",
                            "lengthMenu": "Tampilkan _MENU_ data",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            "infoEmpty": "Tidak ada data",
                            "zeroRecords": "Data tidak ditemukan",
                            "paginate": {
                                "first": "Pertama",
                                "last": "Terakhir",
                                "next": "Berikutnya",
                                "previous": "Sebelumnya"
                            }
                        },
                        dom: '<"row mb-2"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-end"f>>rtip'
                    });

                    // Event untuk filter status
                    $('#filterStatus').on('change', function () {

                        table.ajax.reload();
                    });
                });
            </script>
            <script>
                // Script untuk anggota keluarga update: batasi maksimal 7 baris (0-6) berdasarkan jumlah baris di tabel
                document.addEventListener('DOMContentLoaded', function () {
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

                    // Fungsi untuk mendapatkan jumlah baris anggota keluarga saat ini
                    function getCurrentRowCount() {
                        return anggotaTable.querySelectorAll('tbody tr').length;
                    }

                    // Fungsi untuk mendapatkan index berikutnya
                    function getNextIndex() {
                        // Cari index terbesar dari input name="AnggotaKeluarga[IDX][...]" lalu +1
                        let maxIdx = -1;
                        anggotaTable.querySelectorAll('tbody tr').forEach(function (tr) {
                            const input = tr.querySelector('input[name^="AnggotaKeluarga["]');
                            if (input) {
                                const match = input.name.match(/AnggotaKeluarga\[(\d+)\]/);
                                if (match) {
                                    const idx = parseInt(match[1]);
                                    if (idx > maxIdx) maxIdx = idx;
                                }
                            }
                        });
                        return maxIdx + 1;
                    }

                    addRowBtn.addEventListener('click', function () {
                        const currentRows = getCurrentRowCount();
                        if (currentRows >= 7) {
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
                                                <td><button type="button" class="btn btn-sm btn-danger removeRow">−</button></td>
                                            `;
                        tbody.appendChild(row);
                    });

                    // Remove row handler
                    anggotaTable.addEventListener('click', function (e) {
                        if (e.target.classList.contains('removeRow')) {
                            e.target.closest('tr').remove();
                        }
                    });
                });
            </script>
        @endpush
@endsection