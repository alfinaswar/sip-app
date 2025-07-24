@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <div class="alert alert-info">
                <h5 class="mb-2"><i class="fa fa-info-circle"></i> Petunjuk Pengisian Formulir</h5>
                <ul class="mb-0">
                    <li>Isi data dengan lengkap dan sesuai dokumen resmi.</li>
                    <li>Pada bagian <strong>Anggota Keluarga</strong>, maksimal dapat menambahkan 6 anggota.</li>
                    <li>Pilih <strong>Hubungan Keluarga</strong> dari pilihan yang tersedia.</li>
                    <li>Gunakan tombol <strong>(+)</strong> untuk menambah baris anggota keluarga, dan <strong>(−)</strong>
                        untuk menghapus.</li>
                    <li>Pastikan semua data telah diisi sebelum menyimpan.</li>
                </ul>
            </div>
        @endif

        <form action="{{ route('surat-izin.update', $suratIzin->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header text-white" style="background-color: #4b5320;">
                    Form Edit Data
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- KIRI -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="NomorSIP">Nomor SIP</label>
                                <input type="text" name="NomorSIP" id="NomorSIP" class="form-control"
                                    placeholder="Masukkan Nomor SIP" value="{{ old('NomorSIP', $suratIzin->NomorSIP) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Nama">Nama</label>
                                <input type="text" name="Nama" id="Nama" class="form-control"
                                    placeholder="Masukkan Nama Lengkap" value="{{ old('Nama', $suratIzin->Nama) }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="NRPNIP">NRP / NIP</label>
                                <input type="text" name="NRPNIP" id="NRPNIP" class="form-control"
                                    placeholder="Masukkan NRP / NIP Lengkap"
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
                                    placeholder="Masukkan Jabatan" value="{{ old('Jabatan', $suratIzin->Jabatan) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Kesatuan">Kesatuan</label>
                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                    placeholder="Masukkan Kesatuan" value="{{ old('Kesatuan', $suratIzin->Kesatuan) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Ktp">No. KTP</label>
                                <input type="text" name="Ktp" id="Ktp" class="form-control" placeholder="Masukkan Nomor KTP"
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
                                    placeholder="Masukkan Jumlah Tanggungan"
                                    value="{{ old('JumlahTanggungan', $suratIzin->JumlahTanggungan) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="UntukMenempati">Untuk Menempati</label>
                                <input type="text" name="UntukMenempati" id="UntukMenempati" class="form-control"
                                    placeholder="Masukkan Lokasi/Tempat"
                                    value="{{ old('UntukMenempati', $suratIzin->UntukMenempati) }}">
                            </div>
                        </div>

                        <!-- KANAN -->
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label for="Keterangan">Keterangan</label>
                                <input type="text" name="Keterangan" id="Keterangan" class="form-control"
                                    placeholder="Masukkan Keterangan"
                                    value="{{ old('Keterangan', $suratIzin->Keterangan) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="DigunakanSebagai">Digunakan Sebagai</label>
                                <input type="text" name="DigunakanSebagai" id="DigunakanSebagai" class="form-control"
                                    placeholder="Masukkan Penggunaan"
                                    value="{{ old('DigunakanSebagai', $suratIzin->DigunakanSebagai) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Kpad">KPAD</label>
                                <input type="text" name="Kpad" id="Kpad" class="form-control" placeholder="Masukkan KPAD"
                                    value="{{ old('Kpad', $suratIzin->Kpad) }}">
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
                                    placeholder="Contoh: 36/72" value="{{ old('TypeLuas', $suratIzin->TypeLuas) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Tmt">TMT</label>
                                <input type="text" name="Tmt" id="Tmt" class="form-control" placeholder="Masukkan TMT"
                                    value="{{ old('Tmt', $suratIzin->Tmt) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="TandaTangan">Tanda Tangan</label>
                                <input type="text" name="TandaTangan" id="TandaTangan" class="form-control"
                                    placeholder="Masukkan Nama Penandatangan"
                                    value="{{ old('TandaTangan', $suratIzin->TandaTangan) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Sebagai">Sebagai</label>
                                <input type="text" name="Sebagai" id="Sebagai" class="form-control"
                                    placeholder="Masukkan Jabatan Penandatangan"
                                    value="{{ old('Sebagai', $suratIzin->Sebagai) }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Foto">Foto</label>
                                <div id="foto-drop-area" class="border border-2 border-primary rounded p-4 text-center"
                                    style="background: #f8f9fa; cursor: pointer;">
                                    <i class="fa fa-cloud-upload-alt fa-2x mb-2 text-primary"></i>
                                    <p id="foto-drop-text" class="mb-2">Seret dan lepas foto di sini atau klik untuk memilih
                                        file</p>
                                    <input type="file" name="Foto" id="Foto" class="d-none" accept="image/*">
                                    <div id="foto-preview" class="mt-2">
                                        @if($suratIzin->Foto)
                                            <img src="{{ asset('storage/' . $suratIzin->Foto) }}" alt="Preview Foto"
                                                class="img-thumbnail mt-2" style="max-width: 200px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const dropArea = document.getElementById('foto-drop-area');
                                    const fileInput = document.getElementById('Foto');
                                    const preview = document.getElementById('foto-preview');
                                    const dropText = document.getElementById('foto-drop-text');

                                    // Highlight area saat drag
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

                                    // Klik area untuk pilih file
                                    dropArea.addEventListener('click', function () {
                                        fileInput.click();
                                    });

                                    // Drag & drop file
                                    dropArea.addEventListener('drop', function (e) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                                            fileInput.files = e.dataTransfer.files;
                                            tampilkanPreview(fileInput.files[0]);
                                        }
                                    });

                                    // Pilih file manual
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

                            <div class="form-group mb-3">
                                <label for="Tembusan">Tembusan (Pisahkan Dengan Koma (,) Jika Lebih Dari 1)</label>
                                <textarea name="Tembusan" id="Tembusan" class="form-control" rows="2"
                                    placeholder='Contoh: Bagian A, Bagian B'>{{ old('Tembusan', $suratIzin->Tembusan) }}</textarea>
                            </div>
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

                    <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript untuk tambah/hapus baris -->
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
