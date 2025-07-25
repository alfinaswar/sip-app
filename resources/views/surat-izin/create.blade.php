@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
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

        <form action="{{ route('surat-izin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4">
                <div class="card-header text-white" style="background-color: #4b5320;">
                    Form Input Data
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- KIRI -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="NomorSIP">Nomor SIP</label>
                                <input type="text" name="NomorSIP" id="NomorSIP" class="form-control"
                                    placeholder="Masukkan Nomor SIP">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Nama">Nama</label>
                                <input type="text" name="Nama" id="Nama" class="form-control"
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Nama">NRP / NIP</label>
                                <input type="number" name="NRPNIP" id="NRPNIP" class="form-control"
                                    placeholder="Masukkan NRP / NIP Lengkap">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Pangkat">Pangkat</label>
                                <select name="Pangkat" id="Pangkat" class="form-control">
                                    <option value="">Pilih Pangkat</option>
                                    <option value="Jenderal TNI">Jenderal TNI</option>
                                    <option value="Letnan Jenderal TNI">Letnan Jenderal TNI</option>
                                    <option value="Mayor Jenderal TNI">Mayor Jenderal TNI</option>
                                    <option value="Brigadir Jenderal TNI">Brigadir Jenderal TNI</option>
                                    <option value="Kolonel">Kolonel</option>
                                    <option value="Letnan Kolonel">Letnan Kolonel</option>
                                    <option value="Mayor">Mayor</option>
                                    <option value="Kapten">Kapten</option>
                                    <option value="Letnan Satu">Letnan Satu</option>
                                    <option value="Letnan Dua">Letnan Dua</option>
                                    <option value="Pembantu Letnan Satu">Pembantu Letnan Satu</option>
                                    <option value="Pembantu Letnan Dua">Pembantu Letnan Dua</option>
                                    <option value="Sersan Mayor">Sersan Mayor</option>
                                    <option value="Sersan Kepala">Sersan Kepala</option>
                                    <option value="Sersan Satu">Sersan Satu</option>
                                    <option value="Sersan Dua">Sersan Dua</option>
                                    <option value="Kopral Kepala">Kopral Kepala</option>
                                    <option value="Kopral Satu">Kopral Satu</option>
                                    <option value="Kopral Dua">Kopral Dua</option>
                                    <option value="Prajurit Kepala">Prajurit Kepala</option>
                                    <option value="Prajurit Satu">Prajurit Satu</option>
                                    <option value="Prajurit Dua">Prajurit Dua</option>
                                    <option value="PNS IV/d">PNS IV/d</option>
                                    <option value="PNS IV/c">PNS IV/c</option>
                                    <option value="PNS IV/b">PNS IV/b</option>
                                    <option value="PNS IV/a">PNS IV/a</option>
                                    <option value="PNS III/d">PNS III/d</option>
                                    <option value="PNS III/c">PNS III/c</option>
                                    <option value="PNS III/b">PNS III/b</option>
                                    <option value="PNS III/a">PNS III/a</option>
                                    <option value="PNS II/d">PNS II/d</option>
                                    <option value="PNS II/c">PNS II/c</option>
                                    <option value="PNS II/b">PNS II/b</option>
                                    <option value="PNS II/a">PNS II/a</option>
                                    <option value="PNS I/d">PNS I/d</option>
                                    <option value="PNS I/c">PNS I/c</option>
                                    <option value="PNS I/b">PNS I/b</option>
                                    <option value="PNS I/a">PNS I/a</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Korps">Korps</label>
                                <select name="Korps" id="Korps" class="form-control">
                                    <option value="">Pilih Korps</option>
                                    <option value="Inf">Inf</option>
                                    <option value="Arh">Arh</option>
                                    <option value="Arm">Arm</option>
                                    <option value="Kav">Kav</option>
                                    <option value="Czi">Czi</option>
                                    <option value="Cke">Cke</option>
                                    <option value="Cpl">Cpl</option>
                                    <option value="Cba">Cba</option>
                                    <option value="Ckm">Ckm</option>
                                    <option value="Ctp">Ctp</option>
                                    <option value="Cku">Cku</option>
                                    <option value="Caj">Caj</option>
                                    <option value="Chk">Chk</option>
                                    <option value="Cpm">Cpm</option>
                                    <option value="Cpn">Cpn</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="Jabatan">Jabatan</label>
                                <input type="text" name="Jabatan" id="Jabatan" class="form-control"
                                    placeholder="Masukkan Jabatan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Kesatuan">Kesatuan</label>
                                <input type="text" name="Kesatuan" id="Kesatuan" class="form-control"
                                    placeholder="Masukkan Kesatuan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Ktp">No. KTP</label>
                                <input type="text" name="Ktp" id="Ktp" class="form-control"
                                    placeholder="Masukkan Nomor KTP">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Ttl">Tempat, Tanggal Lahir</label>
                                <input type="text" name="Ttl" id="Ttl" class="form-control"
                                    placeholder="Contoh: Jakarta, 01 Januari 1990">
                            </div>
                            <div class="form-group mb-3">
                                <label for="Status">Status</label>
                                <select name="Status" id="Status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="AKTIF">AKTIF</option>
                                    <option value="PURNAWIRAWAN">PURNAWIRAWAN</option>
                                    <option value="WARAKAWURI">WARAKAWURI</option>
                                    <option value="WREDATAMA">WREDATAMA</option>
                                    <option value="JANDA WREDATAMA">JANDA WREDATAMA</option>
                                    <option value="DUDA WREDATAMA">DUDA WREDATAMA</option>
                                    <option value="DUDA">DUDA</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan" class="form-control"
                                    placeholder="Masukkan Jumlah Tanggungan">
                            </div>

                            <!-- Anggota Keluarga -->

                            <div class="form-group mb-3">
                                <label for="UntukMenempati">Untuk Menempati</label>
                                <input type="text" name="UntukMenempati" id="UntukMenempati" class="form-control"
                                    placeholder="Masukkan Lokasi/Tempat">
                            </div>


                        </div>

                        <!-- KANAN -->
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label for="Keterangan">Keterangan</label>
                                <input type="text" name="Keterangan" id="Keterangan" class="form-control"
                                    placeholder="Masukkan Keterangan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="DigunakanSebagai">Digunakan Sebagai</label>
                                <input type="text" name="DigunakanSebagai" id="DigunakanSebagai" class="form-control"
                                    placeholder="Masukkan Penggunaan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Kpad">KPAD</label>
                                <input type="text" name="Kpad" id="Kpad" class="form-control" placeholder="Masukkan KPAD">
                            </div>

                            <div class="form-group mb-3">
                                <label for="AlamatRumah">Alamat Rumah</label>
                                <input type="text" name="AlamatRumah" id="AlamatRumah" class="form-control"
                                    placeholder="Masukkan Alamat Rumah">
                            </div>

                            <div class="form-group mb-3">
                                <label for="TypeLuas">Type / Luas</label>
                                <input type="text" name="TypeLuas" id="TypeLuas" class="form-control"
                                    placeholder="Contoh: 36/72">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Tmt">TMT</label>
                                <input type="text" name="Tmt" id="Tmt" class="form-control" placeholder="Masukkan TMT">
                            </div>

                            <div class="form-group mb-3">
                                <label for="TandaTangan">Tanda Tangan</label>
                                <input type="text" name="TandaTangan" id="TandaTangan" class="form-control"
                                    placeholder="Masukkan Nama Penandatangan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Sebagai">Sebagai</label>
                                <input type="text" name="Sebagai" id="Sebagai" class="form-control"
                                    placeholder="Masukkan Jabatan Penandatangan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="Foto">Foto</label>
                                <div id="foto-drop-area" class="border border-2 border-primary rounded p-4 text-center"
                                    style="background: #f8f9fa; cursor: pointer;">
                                    <i class="fa fa-cloud-upload-alt fa-2x mb-2 text-primary"></i>
                                    <p id="foto-drop-text" class="mb-2">Seret dan lepas foto di sini atau klik untuk memilih
                                        file</p>
                                    <input type="file" name="Foto" id="Foto" class="d-none" accept="image/*">
                                    <div id="foto-preview" class="mt-2"></div>
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
                                    placeholder='Contoh: Bagian A, Bagian B'></textarea>
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
                                <tr>
                                    <td><input type="text" name="AnggotaKeluarga[0][nama]" class="form-control"></td>
                                    <td><input type="number" name="AnggotaKeluarga[0][umur]" class="form-control"></td>
                                    <td>
                                        <select name="AnggotaKeluarga[0][jk]" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="AnggotaKeluarga[0][hubungan]" class="form-control">
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
                                    <td><input type="text" name="AnggotaKeluarga[0][keterangan]" class="form-control"></td>
                                    <td></td>
                                </tr>
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
        let rowIdx = 1;
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