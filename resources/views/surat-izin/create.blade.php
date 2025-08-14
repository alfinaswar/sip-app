@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tab-input" class="nav-link active" data-bs-toggle="tab">Input Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-all" class="nav-link" data-bs-toggle="tab">All Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-history" class="nav-link" data-bs-toggle="tab">History</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-input">
                        <h4>Input Data</h4>
                        <p>Formulir input data penghuni akan diletakkan di sini.</p>
                        <div class="card mb-4">
                            <div class="card-header text-white" style="background-color: #4b5320;">
                                Form Input Data
                            </div>
                            <div class="card-body">
                                <form action="{{ route('surat-izin.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- KIRI -->
                                        <div class="col-md-6">
                                            <!-- ... (form kiri tetap) ... -->
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
                                                    <option value="-">Tidak Ada</option>
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
                                                    <option value="-">Tidak Ada</option>
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
                                                    <option value="-">Tidak Ada</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="JumlahTanggungan">Jumlah Tanggungan</label>
                                                <input type="text" name="JumlahTanggungan" id="JumlahTanggungan"
                                                    class="form-control" placeholder="Masukkan Jumlah Tanggungan">
                                            </div>
                                        </div>
                                        <!-- KANAN -->
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="Kpad">KPAD</label>
                                                <select name="Kpad" id="Kpad" class="form-control">
                                                    <option value="">Pilih KPAD</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                    <optgroup label="WILAYAH KODIM 0501/JP">
                                                        <option value="ABDUL RAHMAN SALEH">1 ABDUL RAHMAN SALEH</option>
                                                        <option value="DR. WAHIDIN">2 DR. WAHIDIN</option>
                                                        <option value="KWINI">3 KWINI</option>
                                                        <option value="KWITANG TIMUR">4 KWITANG TIMUR</option>
                                                        <option value="SENEN RAYA">5 SENEN RAYA</option>
                                                        <option value="SUMUR BATU">6 SUMUR BATU</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0502/JU">
                                                        <option value="LAGOA CEMARA">7 LAGOA CEMARA</option>
                                                        <option value="PEMANDANGAN">8 PEMANDANGAN</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0503/JB">
                                                        <option value="JELAMBAR ILIR">9 JELAMBAR ILIR</option>
                                                        <option value="KALIDERES">10 KALIDERES</option>
                                                        <option value="KEBON JERUK KODAM">11 KEBON JERUK KODAM</option>
                                                        <option value="KEBON JERUK MABAD">12 KEBON JERUK MABAD</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0504/JS">
                                                        <option value="TANAH KUSIR">13 TANAH KUSIR</option>
                                                        <option value="RAWAJATI">14 RAWAJATI</option>
                                                        <option value="LENTENG AGUNG MABAD I">15 LENTENG AGUNG MABAD I
                                                        </option>
                                                        <option value="LENTENG AGUNG MABAD II">16 LENTENG AGUNG MABAD II
                                                        </option>
                                                        <option value="BINTARO">17 BINTARO</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0505/JT">
                                                        <option value="ASRAMA SENG">18 ASRAMA SENG</option>
                                                        <option value="BERLAND">19 BERLAND</option>
                                                        <option value="BILLIMON">20 BILLIMON</option>
                                                        <option value="BULAK RANTAI">21 BULAK RANTAI</option>
                                                        <option value="CAKUNG">22 CAKUNG</option>
                                                        <option value="CEGER">23 CEGER</option>
                                                        <option value="CIBUBUR">24 CIBUBUR</option>
                                                        <option value="CIJANTUNG II">25 CIJANTUNG II</option>
                                                        <option value="CIJANTUNG III (KOBANGDIKLAT)">26 CIJANTUNG III
                                                            (KOBANGDIKLAT)</option>
                                                        <option value="CIJANTUNG IV (BARET BIRU)">27 CIJANTUNG IV (BARET
                                                            BIRU)</option>
                                                    </optgroup>
                                                    <optgroup label="NAMA KPAD">
                                                        <option value="CIJANTUNG IV (RADAR)">28 CIJANTUNG IV (RADAR)
                                                        </option>
                                                        <option value="CIJANTUNG SEDERHANA">29 CIJANTUNG SEDERHANA</option>
                                                        <option value="CIJANTUNG ZENI">30 CIJANTUNG ZENI</option>
                                                        <option value="CILILITAN II (3 MEI)">31 CILILITAN II (3 MEI)
                                                        </option>
                                                        <option value="CIPAYUNG KODAM">32 CIPAYUNG KODAM</option>
                                                        <option value="CIPAYUNG MABAD">33 CIPAYUNG MABAD</option>
                                                        <option value="CIPINANG JAYA">34 CIPINANG JAYA</option>
                                                        <option value="GUPUS TEKMEK">35 GUPUS TEKMEK</option>
                                                        <option value="JATIWARINGIN">36 JATIWARINGIN</option>
                                                        <option value="JEND. URIP SUMOHARJO">37 JEND. URIP SUMOHARJO
                                                        </option>
                                                        <option value="OTISTA III">38 OTISTA III</option>
                                                        <option value="DUMP TRUCK MENZIKON">39 DUMP TRUCK MENZIKON</option>
                                                        <option value="SLAMET RIYADI">40 SLAMET RIYADI</option>
                                                        <option value="ZENI KRAMAT JATI">41 ZENI KRAMAT JATI</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0506/TGR">
                                                        <option value="REMPoa MABAD 21">42 REMPOA MABAD 21</option>
                                                        <option value="REMPoa MABAD 25/60/124">43 REMPOA MABAD 25/60/124
                                                        </option>
                                                        <option value="REMPoa MABAD 55/65">44 REMPOA MABAD 55/65</option>
                                                    </optgroup>
                                                    <optgroup label="WILAYAH KODIM 0507/BKS">
                                                        <option value="JATIWARNA">45 JATIWARNA</option>
                                                        <option value="KOLOGAD">46 KOLOGAD</option>
                                                        <option value="PALAD">47 PALAD</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3" id="kpadLainnyaDiv" style="display: none;">
                                                <label for="KpadLainnya">Nama KPAD Lainnya</label>
                                                <input type="text" name="KpadLainnya" id="KpadLainnya" class="form-control"
                                                    placeholder="Masukkan Nama KPAD Lainnya">
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
                                                <input type="text" name="Tmt" id="Tmt" class="form-control"
                                                    placeholder="Masukkan TMT">
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
                                                    <th>Keterangan</th>
                                                    <th>
                                                        <button type="button" id="addRow"
                                                            class="btn btn-sm btn-success">+</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="AnggotaKeluarga[0][nama]"
                                                            class="form-control"></td>
                                                    <td><input type="number" name="AnggotaKeluarga[0][umur]"
                                                            class="form-control"></td>
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
                                                    <td><input type="text" name="AnggotaKeluarga[0][keterangan]"
                                                            class="form-control"></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <small class="text-muted">Maksimal 6 anggota keluarga</small>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-all">
                        <h4>All Data</h4>
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <strong> EKSPOR DATA PENGHUNI RUMAH DINAS</strong>
                            </div>
                            <div class="card-body">
                                <p class="mb-3 text-muted">
                                    Anda dapat mengunduh seluruh data pengajuan rumah dinas dalam format Excel atau PDF
                                    untuk keperluan dokumentasi atau pelaporan. Silakan pilih salah satu tombol di bawah
                                    ini:
                                </p>
                                <div class="d-flex gap-2 mb-2">
                                    <a href="{{ route('exportExcel') }}" class="btn btn-success btn-sm"
                                        title="Unduh data dalam format Excel">
                                        <i class="fa fa-file-excel-o"></i> Download Excel
                                    </a>
                                    <a href="{{ route('exportPdf') }}" class="btn btn-danger btn-sm"
                                        title="Unduh data dalam format PDF">
                                        <i class="fa fa-file-pdf-o"></i> Download PDF
                                    </a>
                                </div>
                                <small class="text-secondary d-block mt-2">
                                    * Pastikan data sudah benar sebelum melakukan ekspor.
                                </small>
                                <hr>
                                <p class="mb-2 text-muted">
                                    Anda juga dapat melakukan <strong>import data</strong> dari file Excel untuk mempercepat
                                    pengisian data penghuni rumah dinas. Silakan gunakan template yang telah disediakan,
                                    lalu upload file Excel Anda melalui tombol di bawah ini:
                                </p>
                                <div class="d-flex gap-2 mb-2">

                                    <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data"
                                        class="d-inline">
                                        @csrf
                                        <input type="file" name="file" accept=".xlsx,.xls"
                                            class="form-control form-control-sm d-inline"
                                            style="width:auto; display:inline-block;" required>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-upload"></i> Import Excel
                                        </button>
                                    </form>
                                </div>
                                <small class="text-secondary d-block">
                                    * Pastikan format file sesuai dengan template yang diberikan.
                                </small>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-white" style="background-color: #4b5320;">
                                <h5 class="mb-0"><i class="fa fa-home"></i> DATA PENGHUNI RUMAH DINAS</h5>
                            </div>
                            <div class="card-body">
                                <!-- Fitur Pencarian Status -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="filterStatus" class="form-label">Cari Berdasarkan Status</label>
                                        <select id="filterStatus" class="form-select">
                                            <option value="">Semua Status</option>
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="PURNAWIRAWAN">PURNAWIRAWAN</option>
                                            <option value="WARAKAWURI">WARAKAWURI</option>
                                            <option value="WREDATAMA">WREDATAMA</option>
                                            <option value="JANDA WREDATAMA">JANDA WREDATAMA</option>
                                            <option value="DUDA WREDATAMA">DUDA WREDATAMA</option>
                                            <option value="DUDA">DUDA</option>
                                            <option value="-">Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle" id="dataTableSuratIzin"
                                        style="width:100%">
                                        <thead class="table-dark align-middle text-center">
                                            <tr>
                                                <th style="width: 5%;">No</th>
                                                <th>Nama</th>
                                                <th>Pangkat/Gol</th>
                                                <th>Korps</th>
                                                <th>NRP/NIP</th>
                                                <th>Jabatan</th>
                                                <th>Kesatuan</th>
                                                <th>Nomor KTP</th>
                                                <th>Tempat tanggal lahir</th>
                                                <th>Status</th>
                                                <th>Jumlah Keluarga yang menjadi tanggungan</th>
                                                <th>Nama KPAD</th>
                                                <th>Alamat Rumah</th>
                                                <th>Type dan Luas</th>
                                                <th>Menempati rumah TMT</th>
                                                <th>Aksi</th>
                                                <!-- tambah kolom lainnya -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data akan diisi oleh DataTables -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-history">
                        <h4>All Data</h4>
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <strong> EKSPOR DATA HISTORY PENGHUNI RUMAH DINAS</strong>
                            </div>
                            <div class="card-body">
                                <p class="mb-3 text-muted">
                                    Anda dapat mengunduh seluruh history pengajuan rumah dinas dalam format Excel atau PDF
                                    untuk keperluan dokumentasi atau pelaporan. Silakan pilih salah satu tombol di bawah
                                    ini:
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('exportExcelHistory') }}" class="btn btn-success btn-sm"
                                        title="Unduh data dalam format Excel">
                                        <i class="fa fa-file-excel-o"></i> Download Excel
                                    </a>
                                    <a href="{{ route('exportPdfHistory') }}" class="btn btn-danger btn-sm"
                                        title="Unduh data dalam format PDF">
                                        <i class="fa fa-file-pdf-o"></i> Download PDF
                                    </a>
                                </div>
                                <small class="text-secondary d-block mt-2">
                                    * Pastikan data sudah benar sebelum melakukan ekspor.
                                </small>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle" id="tablehistory"
                                style="width:100%">
                                <thead class="table-dark align-middle text-center">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama</th>
                                        <th>Pangkat/Gol</th>
                                        <th>Korps</th>
                                        <th>NRP/NIP</th>
                                        <th>Jabatan</th>
                                        <th>Kesatuan</th>
                                        <th>Nomor KTP</th>
                                        <th>Tempat tanggal lahir</th>
                                        <th>Status</th>
                                        <th>Jumlah Keluarga yang menjadi tanggungan</th>
                                        <th>Nama KPAD</th>
                                        <th>Alamat Rumah</th>
                                        <th>Type dan Luas</th>
                                        <th>Menempati rumah TMT</th>

                                        <!-- tambah kolom lainnya -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh DataTables -->
                                </tbody>
                            </table>
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
                // Script untuk anggota keluarga tetap sama
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
        @endpush
@endsection
