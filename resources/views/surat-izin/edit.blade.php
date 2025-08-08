@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <div class="card mb-4">
            <div class="card-header text-white" style="background-color: #4b5320;">
                Edit Surat Izin
            </div>
            <div class="card-body">
                <form action="{{ route('surat-izin.update', $suratIzin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- KIRI -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="NomorSIP">Nomor SIP</label>
                                <input type="text" name="NomorSIP" id="NomorSIP" class="form-control"
                                    value="{{ old('NomorSIP', $suratIzin->NomorSIP) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Nama">Nama</label>
                                <input type="text" name="Nama" id="Nama" class="form-control"
                                    value="{{ old('Nama', $suratIzin->Nama) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NRPNIP">NRP / NIP</label>
                                <input type="text" name="NRPNIP" id="NRPNIP" class="form-control"
                                    value="{{ old('NRPNIP', $suratIzin->NRPNIP) }}">
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
                                            "PNS I/a"
                                        ];
                                    @endphp
                                    @foreach($pangkatList as $pangkat)
                                        <option value="{{ $pangkat }}" {{ old('Pangkat', $suratIzin->Pangkat) == $pangkat ? 'selected' : '' }}>{{ $pangkat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Korps">Korps</label>
                                <select name="Korps" id="Korps" class="form-control">
                                    <option value="">Pilih Korps</option>
                                    @php
                                        $korpsList = ["Inf", "Arh", "Arm", "Kav", "Czi", "Cke", "Cpl", "Cba", "Ckm", "Ctp", "Cku", "Caj", "Chk", "Cpm", "Cpn"];
                                    @endphp
                                    @foreach($korpsList as $korps)
                                        <option value="{{ $korps }}" {{ old('Korps', $suratIzin->Korps) == $korps ? 'selected' : '' }}>{{ $korps }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Jabatan">Jabatan</label>
                                <input type="text" name="Jabatan" id="Jabatan" class="form-control"
                                    value="{{ old('Jabatan', $suratIzin->Jabatan) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Kesatuan">Kesatuan</label>
                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                    value="{{ old('Kesatuan', $suratIzin->Kesatuan) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Ktp">No. KTP</label>
                                <input type="text" name="Ktp" id="Ktp" class="form-control"
                                    value="{{ old('Ktp', $suratIzin->Ktp) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" name="Ttl" id="Ttl" class="form-control"
                                    value="{{ old('Ttl', $suratIzin->Ttl) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Status">Status</label>
                                <select name="Status" id="Status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    @php
                                        $statusList = ["AKTIF", "PURNAWIRAWAN", "WARAKAWURI", "WREDATAMA", "JANDA WREDATAMA", "DUDA WREDATAMA", "DUDA"];
                                    @endphp
                                    @foreach($statusList as $status)
                                        <option value="{{ $status }}" {{ old('Status', $suratIzin->Status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan" class="form-control"
                                    value="{{ old('JumlahTanggungan', $suratIzin->JumlahTanggungan) }}">
                            </div>

                        </div>
                        <!-- KANAN -->
                        <div class="col-md-6">


                            <div class="form-group mb-3">
                                <label for="Kpad">KPAD</label>
                                <select name="Kpad" id="Kpad" class="form-control">
                                    <option value="">Pilih KPAD</option>
                                    <optgroup label="WILAYAH KODIM 0501/JP">
                                        <option value="ABDUL RAHMAN SALEH" {{ old('Kpad', $suratIzin->Kpad) == 'ABDUL RAHMAN SALEH' ? 'selected' : '' }}>1 ABDUL RAHMAN SALEH</option>
                                        <option value="DR. WAHIDIN" {{ old('Kpad', $suratIzin->Kpad) == 'DR. WAHIDIN' ? 'selected' : '' }}>2 DR. WAHIDIN</option>
                                        <option value="KWINI" {{ old('Kpad', $suratIzin->Kpad) == 'KWINI' ? 'selected' : '' }}>3 KWINI</option>
                                        <option value="KWITANG TIMUR" {{ old('Kpad', $suratIzin->Kpad) == 'KWITANG TIMUR' ? 'selected' : '' }}>4 KWITANG TIMUR</option>
                                        <option value="SENEN RAYA" {{ old('Kpad', $suratIzin->Kpad) == 'SENEN RAYA' ? 'selected' : '' }}>5 SENEN RAYA</option>
                                        <option value="SUMUR BATU" {{ old('Kpad', $suratIzin->Kpad) == 'SUMUR BATU' ? 'selected' : '' }}>6 SUMUR BATU</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0502/JU">
                                        <option value="LAGOA CEMARA" {{ old('Kpad', $suratIzin->Kpad) == 'LAGOA CEMARA' ? 'selected' : '' }}>7 LAGOA CEMARA</option>
                                        <option value="PEMANDANGAN" {{ old('Kpad', $suratIzin->Kpad) == 'PEMANDANGAN' ? 'selected' : '' }}>8 PEMANDANGAN</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0503/JB">
                                        <option value="JELAMBAR ILIR" {{ old('Kpad', $suratIzin->Kpad) == 'JELAMBAR ILIR' ? 'selected' : '' }}>9 JELAMBAR ILIR</option>
                                        <option value="KALIDERES" {{ old('Kpad', $suratIzin->Kpad) == 'KALIDERES' ? 'selected' : '' }}>10 KALIDERES</option>
                                        <option value="KEBON JERUK KODAM" {{ old('Kpad', $suratIzin->Kpad) == 'KEBON JERUK KODAM' ? 'selected' : '' }}>11 KEBON JERUK KODAM</option>
                                        <option value="KEBON JERUK MABAD" {{ old('Kpad', $suratIzin->Kpad) == 'KEBON JERUK MABAD' ? 'selected' : '' }}>12 KEBON JERUK MABAD</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0504/JS">
                                        <option value="TANAH KUSIR" {{ old('Kpad', $suratIzin->Kpad) == 'TANAH KUSIR' ? 'selected' : '' }}>13 TANAH KUSIR</option>
                                        <option value="RAWAJATI" {{ old('Kpad', $suratIzin->Kpad) == 'RAWAJATI' ? 'selected' : '' }}>14 RAWAJATI</option>
                                        <option value="LENTENG AGUNG MABAD I" {{ old('Kpad', $suratIzin->Kpad) == 'LENTENG AGUNG MABAD I' ? 'selected' : '' }}>15 LENTENG AGUNG MABAD I</option>
                                        <option value="LENTENG AGUNG MABAD II" {{ old('Kpad', $suratIzin->Kpad) == 'LENTENG AGUNG MABAD II' ? 'selected' : '' }}>16 LENTENG AGUNG MABAD II</option>
                                        <option value="BINTARO" {{ old('Kpad', $suratIzin->Kpad) == 'BINTARO' ? 'selected' : '' }}>17 BINTARO</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0505/JT">
                                        <option value="ASRAMA SENG" {{ old('Kpad', $suratIzin->Kpad) == 'ASRAMA SENG' ? 'selected' : '' }}>18 ASRAMA SENG</option>
                                        <option value="BERLAND" {{ old('Kpad', $suratIzin->Kpad) == 'BERLAND' ? 'selected' : '' }}>19 BERLAND</option>
                                        <option value="BILLIMON" {{ old('Kpad', $suratIzin->Kpad) == 'BILLIMON' ? 'selected' : '' }}>20 BILLIMON</option>
                                        <option value="BULAK RANTAI" {{ old('Kpad', $suratIzin->Kpad) == 'BULAK RANTAI' ? 'selected' : '' }}>21 BULAK RANTAI</option>
                                        <option value="CAKUNG" {{ old('Kpad', $suratIzin->Kpad) == 'CAKUNG' ? 'selected' : '' }}>22 CAKUNG</option>
                                        <option value="CEGER" {{ old('Kpad', $suratIzin->Kpad) == 'CEGER' ? 'selected' : '' }}>23 CEGER</option>
                                        <option value="CIBUBUR" {{ old('Kpad', $suratIzin->Kpad) == 'CIBUBUR' ? 'selected' : '' }}>24 CIBUBUR</option>
                                        <option value="CIJANTUNG II" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG II' ? 'selected' : '' }}>25 CIJANTUNG II</option>
                                        <option value="CIJANTUNG III (KOBANGDIKLAT)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG III (KOBANGDIKLAT)' ? 'selected' : '' }}>26
                                            CIJANTUNG III (KOBANGDIKLAT)</option>
                                        <option value="CIJANTUNG IV (BARET BIRU)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG IV (BARET BIRU)' ? 'selected' : '' }}>27 CIJANTUNG
                                            IV (BARET BIRU)</option>
                                    </optgroup>
                                    <optgroup label="NAMA KPAD">
                                        <option value="CIJANTUNG IV (RADAR)" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG IV (RADAR)' ? 'selected' : '' }}>28 CIJANTUNG IV (RADAR)</option>
                                        <option value="CIJANTUNG SEDERHANA" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG SEDERHANA' ? 'selected' : '' }}>29 CIJANTUNG SEDERHANA</option>
                                        <option value="CIJANTUNG ZENI" {{ old('Kpad', $suratIzin->Kpad) == 'CIJANTUNG ZENI' ? 'selected' : '' }}>30 CIJANTUNG ZENI</option>
                                        <option value="CILILITAN II (3 MEI)" {{ old('Kpad', $suratIzin->Kpad) == 'CILILITAN II (3 MEI)' ? 'selected' : '' }}>31 CILILITAN II (3 MEI)</option>
                                        <option value="CIPAYUNG KODAM" {{ old('Kpad', $suratIzin->Kpad) == 'CIPAYUNG KODAM' ? 'selected' : '' }}>32 CIPAYUNG KODAM</option>
                                        <option value="CIPAYUNG MABAD" {{ old('Kpad', $suratIzin->Kpad) == 'CIPAYUNG MABAD' ? 'selected' : '' }}>33 CIPAYUNG MABAD</option>
                                        <option value="CIPINANG JAYA" {{ old('Kpad', $suratIzin->Kpad) == 'CIPINANG JAYA' ? 'selected' : '' }}>34 CIPINANG JAYA</option>
                                        <option value="GUPUS TEKMEK" {{ old('Kpad', $suratIzin->Kpad) == 'GUPUS TEKMEK' ? 'selected' : '' }}>35 GUPUS TEKMEK</option>
                                        <option value="JATIWARINGIN" {{ old('Kpad', $suratIzin->Kpad) == 'JATIWARINGIN' ? 'selected' : '' }}>36 JATIWARINGIN</option>
                                        <option value="JEND. URIP SUMOHARJO" {{ old('Kpad', $suratIzin->Kpad) == 'JEND. URIP SUMOHARJO' ? 'selected' : '' }}>37 JEND. URIP SUMOHARJO</option>
                                        <option value="OTISTA III" {{ old('Kpad', $suratIzin->Kpad) == 'OTISTA III' ? 'selected' : '' }}>38 OTISTA III</option>
                                        <option value="DUMP TRUCK MENZIKON" {{ old('Kpad', $suratIzin->Kpad) == 'DUMP TRUCK MENZIKON' ? 'selected' : '' }}>39 DUMP TRUCK MENZIKON</option>
                                        <option value="SLAMET RIYADI" {{ old('Kpad', $suratIzin->Kpad) == 'SLAMET RIYADI' ? 'selected' : '' }}>40 SLAMET RIYADI</option>
                                        <option value="ZENI KRAMAT JATI" {{ old('Kpad', $suratIzin->Kpad) == 'ZENI KRAMAT JATI' ? 'selected' : '' }}>41 ZENI KRAMAT JATI</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0506/TGR">
                                        <option value="REMPoa MABAD 21" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 21' ? 'selected' : '' }}>42 REMPOA MABAD 21</option>
                                        <option value="REMPoa MABAD 25/60/124" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 25/60/124' ? 'selected' : '' }}>43 REMPOA MABAD 25/60/124</option>
                                        <option value="REMPoa MABAD 55/65" {{ old('Kpad', $suratIzin->Kpad) == 'REMPoa MABAD 55/65' ? 'selected' : '' }}>44 REMPOA MABAD 55/65</option>
                                    </optgroup>
                                    <optgroup label="WILAYAH KODIM 0507/BKS">
                                        <option value="JATIWARNA" {{ old('Kpad', $suratIzin->Kpad) == 'JATIWARNA' ? 'selected' : '' }}>45 JATIWARNA</option>
                                        <option value="KOLOGAD" {{ old('Kpad', $suratIzin->Kpad) == 'KOLOGAD' ? 'selected' : '' }}>46 KOLOGAD</option>
                                        <option value="PALAD" {{ old('Kpad', $suratIzin->Kpad) == 'PALAD' ? 'selected' : '' }}>47 PALAD</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="AlamatRumah">Alamat Rumah</label>
                                <input type="text" name="AlamatRumah" id="AlamatRumah" class="form-control"
                                    value="{{ old('AlamatRumah', $suratIzin->AlamatRumah) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="TypeLuas">Type / Luas</label>
                                <input type="text" name="TypeLuas" id="TypeLuas" class="form-control"
                                    value="{{ old('TypeLuas', $suratIzin->TypeLuas) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Tmt">TMT</label>
                                <input type="text" name="Tmt" id="Tmt" class="form-control"
                                    value="{{ old('Tmt', $suratIzin->Tmt) }}">
                            </div>


                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const dropArea = document.getElementById('foto-drop-area');
                                    const fileInput = document.getElementById('Foto');
                                    const preview = document.getElementById('foto-preview');
                                    const dropText = document.getElementById('foto-drop-text');

                                    ['dragenter', 'dragover'].forEach(eventName => {
                                        dropArea.addEventListener(eventName, (e) => {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            dropArea.classList.add('bg-primary', 'bg-opacity-10');
                                        }, false);
                                    });

                                    ['dragleave', 'drop'].forEach(eventName => {
                                        dropArea.addEventListener(eventName, (e) => {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            dropArea.classList.remove('bg-primary', 'bg-opacity-10');
                                        }, false);
                                    });

                                    dropArea.addEventListener('click', function () {
                                        fileInput.click();
                                    });

                                    dropArea.addEventListener('drop', function (e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                                            fileInput.files = e.dataTransfer.files;
                                            tampilkanPreview(fileInput.files[0]);
                                        }
                                    });

                                    fileInput.addEventListener('change', function () {
                                        if (fileInput.files && fileInput.files[0]) {
                                            tampilkanPreview(fileInput.files[0]);
                                        }
                                    });

                                    function tampilkanPreview(file) {
                                        if (!file.type.startsWith('image/')) {
                                            preview.innerHTML = '<span class="text-danger">File bukan gambar!</span>';
                                            return;
                                        }
                                        const reader = new FileReader();
                                        reader.onload = function (e) {
                                            preview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto" class="img-thumbnail mt-2" style="max-width: 200px;">`;
                                            dropText.textContent = "Foto berhasil dipilih. Ganti dengan drag & drop atau klik lagi.";
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>

                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Anggota Keluarga</label>
                        <table class="table table-bordered" id="anggotaKeluargaTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Hubungan Keluarga</th>
                                    <th>Keterangan</th>
                                    <th>
                                        <button type="button" id="addRow" class="btn btn-sm btn-success">+</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $anggotaKeluarga = old('AnggotaKeluarga', $suratIzin->AnggotaKeluarga ?? []);
                                    if (!is_array($anggotaKeluarga) || count($anggotaKeluarga) == 0) {
                                        $anggotaKeluarga = [['nama' => '', 'umur' => '', 'jk' => '', 'hubungan' => '', 'keterangan' => '']];
                                    }
                                @endphp
                                @foreach($anggotaKeluarga as $i => $anggota)
                                    <tr>
                                        <td><input type="text" name="AnggotaKeluarga[{{ $i }}][nama]" class="form-control"
                                                value="{{ $anggota['nama'] ?? '' }}"></td>
                                        <td><input type="number" name="AnggotaKeluarga[{{ $i }}][umur]" class="form-control"
                                                value="{{ $anggota['umur'] ?? '' }}"></td>
                                        <td>
                                            <select name="AnggotaKeluarga[{{ $i }}][jk]" class="form-control">
                                                <option value="">Pilih</option>
                                                <option value="Laki-laki" {{ ($anggota['jk'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ ($anggota['jk'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="AnggotaKeluarga[{{ $i }}][hubungan]" class="form-control">
                                                @php
                                                    $hubunganList = ["Suami", "Istri", "Anak", "Ayah", "Ibu", "Kakak", "Adik", "Mertua", "Menantu", "Cucu", "Keponakan", "Lainnya"];
                                                @endphp
                                                <option value="">Pilih</option>
                                                @foreach($hubunganList as $hub)
                                                    <option value="{{ $hub }}" {{ ($anggota['hubungan'] ?? '') == $hub ? 'selected' : '' }}>{{ $hub }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="AnggotaKeluarga[{{ $i }}][keterangan]" class="form-control"
                                                value="{{ $anggota['keterangan'] ?? '' }}"></td>
                                        <td>
                                            @if($i > 0)
                                                <button type="button" class="btn btn-sm btn-danger removeRow">−</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <small class="text-muted">Maksimal 6 anggota keluarga</small>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let rowIdx = {{ count($anggotaKeluarga) }};
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

        document.getElementById('addRow').addEventListener('click', function () {
            if (rowIdx >= 6) return alert("Maksimal 6 anggota keluarga");

            const tbody = document.querySelector('#anggotaKeluargaTable tbody');
            const row = document.createElement('tr');

            row.innerHTML = `
                                        <td><input type="text" name="AnggotaKeluarga[${rowIdx}][nama]" class="form-control"></td>
                                        <td><input type="number" name="AnggotaKeluarga[${rowIdx}][umur]" class="form-control"></td>
                                        <td>
                                            <select name="AnggotaKeluarga[${rowIdx}][jk]" class="form-control">
                                                <option value="">Pilih</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="AnggotaKeluarga[${rowIdx}][hubungan]" class="form-control">
                                                ${hubunganOptions}
                                            </select>
                                        </td>
                                        <td><input type="text" name="AnggotaKeluarga[${rowIdx}][keterangan]" class="form-control"></td>
                                        <td><button type="button" class="btn btn-sm btn-danger removeRow">−</button></td>
                                    `;

            tbody.appendChild(row);
            rowIdx++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
                rowIdx--;
            }
        });
    </script>
@endsection