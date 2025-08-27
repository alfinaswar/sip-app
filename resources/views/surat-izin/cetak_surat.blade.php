<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Penghunian</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin-top: 2.0cm;
            margin-bottom: 0.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-size: 14px;
            text-align: justify;
            line-height: 0.7cm;
        }

        .header {
            text-align: center;
        }

        .watermark {
            position: fixed;
            bottom: 0px;
            left: 0px;
            top: 0px;
            right: 0px;
            width: 21cm;
            height: 29.7cm;
            z-index: -10;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }

        .table-solid {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #000;
        }

        .table-solid th {
            border: 1px solid #000 !important;
            line-height: 1.1;
            padding: 2px 6px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-left,
        .signature-right {
            width: 45%;
        }

        .signature-box {
            width: 100px;
            height: 120px;
            border: 0px solid #000;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .name-title {
            font-weight: bold;
            margin-top: 10px;
        }

        .rank-number {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="watermark">
        <img src="{{ public_path('assets/img/bgdokumen.png') }}" alt="" width="100%" height="100%">
    </div>

    <div class="text-al" style="text-align: center; margin-bottom: 10px;">
        <span style="font-size: 20px; font-weight: bold; letter-spacing: 2px;">SURAT IZIN PENGHUNIAN</span>
        <br>
        <span style="font-size: 19px;">Nomor SIP {!! $data->NomorSIP !!}</span>
    </div>
    <div class="content">
        <div class="dasar" style="line-height: 20px;">
            <h3>Dasar:</h3>
            <ol>
                <li>Peraturan Menhan RI Nomor 13 Tahun 2018 tentang Pembinaan Rumah Negara di lingkungan Kemhan dan TNI.
                </li>
                <li>Peraturan Kasad Nomor 57 Tahun 2022 tanggal 5 Desember 2022 tentang Pembinaan Rumah Negara di
                    lingkungan TNI AD.</li>
                <li>Surat Telegram Kasad Nomor ST/273/2022 tanggal 8 Februari 2022 tentang Perintah tertib penggunaan
                    aset BMN berupa rumah dinas TNI AD.</li>
            </ol>
            <hr>
        </div>

        <div class="izin-section" style="line-height: 20px;">
            <div class="izin-intro">
                <p>Diberikan izin penghunian rumah dinas TNI AD golongan II kepada:</p>
            </div>

            <div class="detail-list">
                <table style="width:100%; border-collapse: collapse; line-height: 20px;">
                    <tr>
                        <td style="width: 3%; text-align: right;">1.</td>
                        <td style="width: 27%;">&nbsp;Nama</td>
                        <td style="width: 2%;">:</td>
                        <td>{{ $data->Nama }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">2.</td>
                        <td>&nbsp;Pangkat/Gol</td>
                        <td>:</td>
                        <td>{{ $data->Pangkat }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">3.</td>
                        <td>&nbsp;Jabatan</td>
                        <td>:</td>
                        <td>{{ $data->Jabatan }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">4.</td>
                        <td>&nbsp;Kesatuan</td>
                        <td>:</td>
                        <td>{{ $data->Kesatuan }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">5.</td>
                        <td>&nbsp;Nomor KTP</td>
                        <td>:</td>
                        <td>{{ $data->Ktp }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">6.</td>
                        <td>&nbsp;Tempat tanggal lahir</td>
                        <td>:</td>
                        <td>{{ $data->Ttl }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">7.</td>
                        <td>&nbsp;Status</td>
                        <td>:</td>
                        <td>{{ $data->Status }}</td>
                    </tr>
                </table>
                <!-- Floating box untuk Korps dan NRP/NIP, bisa diposisikan di mana saja dengan drag (jika ingin interaktif, perlu JS tambahan) -->
                <div id="floating-korps-nrp"
                    style="position: absolute; top: 395px; left: 450px; padding: 10px 20px;  z-index: 1000;">
                    <table border-collapse: collapse;">
                        <tr>
                            <td style="width: 40px;">Korps</td>
                            <td style="width: 12px;">:</td>
                            <td style="width: 10px;">{{ $data->Korps }}</td>
                            <td style="width: 20px;"></td> <!-- Jarak tambahan antara Korps dan NRP/NIP -->
                            <td style="width: 60px;">NRP/NIP</td>
                            <td style="width: 12px;">:</td>
                            <td style="width: 120px;">{{ $data->NRPNIP }}</td>
                        </tr>
                    </table>
                </div>
                <!--
                    Catatan:
                    - Ubah nilai 'top' dan 'left' pada style div di atas untuk memindahkan posisi floating box sesuai kebutuhan.
                    - Jika ingin bisa drag & drop, tambahkan script JS drag and drop.
                -->

                <table style="margin-left: 3px;">
                    <tr>
                        <td style="width: 3%; text-align: right;">8.</td>
                        <td>&nbsp;Jumlah keluarga yang menjadi tanggungan</td>
                        <td>:</td>
                        <td>{{ $data->JumlahTanggungan }} orang</td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="table-container">
                <table class="table-solid" width="100%">
                    <thead>
                        <tr>
                            <td style="text-align: center;">NO</td>
                            <td width="30%" style="text-align: center;">NAMA</td>
                            <td style="text-align: center;">UMUR</td>
                            <td style="text-align: center;">JK</td>
                            <td style="text-align: center;">HUB. KEL</td>
                            <td style="text-align: center;">KET</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $jumlahAnggota = count($data->AnggotaKeluarga);
                        @endphp
                        @foreach ($data->AnggotaKeluarga as $key => $ak)
                            <tr class="table-row">
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $ak['nama'] }}</td>
                                <td>{{ $ak['umur'] }}</td>
                                <td>
                                    @if(strtolower($ak['jk']) == 'perempuan')
                                        PR
                                    @else
                                        LK
                                    @endif
                                </td>
                                <td>{{ $ak['hubungan'] }}</td>
                                @if ($key == 0)
                                    <td rowspan="{{ $jumlahAnggota }}" style="vertical-align: top;">
                                        {{ $data->Keterangan }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="requirements">
                <table style="width:100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 3%; text-align: right;">9.</td>
                        <td style="width: 27%;">&nbsp;Untuk menempati</td>
                        <td style="width: 2%;">:</td>
                        <td><strong>Rumah Dinas TNI AD Golongan II</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">10.</td>
                        <td>&nbsp;Keterangan ruangan</td>
                        <td>:</td>
                        <td><strong>Seluruh Rumah Dinas</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">11.</td>
                        <td>&nbsp;Digunakan sebagai</td>
                        <td>:</td>
                        <td><strong>Tempat Tinggal</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">12.</td>
                        <td>&nbsp;Nama KPAD</td>
                        <td>:</td>
                        <td>{{ $data->Kpad }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; vertical-align: top;">13.</td>
                        <td style="vertical-align: top; white-space: nowrap;">&nbsp;Alamat rumah</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">{{ $data->AlamatRumah }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">14.</td>
                        <td>&nbsp;Type dan luas</td>
                        <td>:</td>
                        <td>{{ $data->TypeLuas }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">15.</td>
                        <td>&nbsp;Menempati rumah TMT</td>
                        <td>:</td>
                        <td>{{ $data->Tmt }}</td>
                    </tr>
                </table>
            </div>

            <div class="closing-statement">
                <p><strong>Mematuhi semua ketentuan penghunian rumah dinas TNI AD Golongan II yang tertuang dalam Surat
                        Izin Penghunian ini.</strong></p>
            </div>


            <table style="width:100%; margin-top:40px;">
                <tr>
                    <!-- Kolom Kiri: Tembusan -->
                    <td style="vertical-align:top; width:30%; min-width:180px; border:0px solid #000; padding:8px;">
                        <div
                            style="margin-top: 10px; border:2px solid #800080; background-color: #ffffff; padding:8px; text-align:center;">
                            <div style="margin-bottom: 4px;">
                                <strong>SIP BERLAKU S.D.</strong>
                            </div>
                            <hr
                                style="border: 1.5px solid #800080; background-color: #800080; margin-left:-8px; margin-right:-8px; width:calc(100% + 16px);">
                            <div>
                                <strong>
                                    @php
                                        use Carbon\Carbon;
                                        $bulanIndo = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember',
                                        ];
                                        $tanggalBerlakuObj = Carbon::parse($data->created_at)->addYear();
                                        $hariBerlaku = $tanggalBerlakuObj->format('d');
                                        $bulanBerlaku = (int) $tanggalBerlakuObj->format('m');
                                        $tahunBerlaku = $tanggalBerlakuObj->format('Y');
                                        $tanggalBerlaku = $hariBerlaku . ' ' . $bulanIndo[$bulanBerlaku] . ' ' . $tahunBerlaku;
                                    @endphp
                                    {{ $tanggalBerlaku }}
                                </strong>
                            </div>
                        </div>
                        <div style="margin-top: 15px;">
                            <p>Tembusan:</strong></p>
                            <span style="text-decoration: underline;">- Kazidam Jaya</span>
                        </div>

                    </td>
                    <!-- Kolom Tengah: Foto -->
                    <td style="vertical-align:top; width:25%; text-align:center; padding:0;">
                        <div style="margin-top: 0px;">
                            <div class="signature-box"
                                style="margin-bottom: 10px; width:90px; height:120px; border:1px solid #000; display:flex; align-items:center; justify-content:center; margin-left:auto; margin-right:auto;">
                                <span style="font-size:12px;">Foto<br>3x4</span>
                            </div>
                        </div>
                        <div class="name-title" style="margin-top: 10px; text-align: center;">
                            <strong></strong>
                        </div>
                    </td>
                    <!-- Kolom Kanan: Tanda Tangan Panglima -->
                    <td style="vertical-align:top; width:30%; min-width:180px; text-align:left; padding:4px;">
                        <div class="date-location" style="margin-bottom:1px; font-size:13px; line-height:1.1;">
                            Dikeluarkan di Jakarta
                        </div>
                        @php
                            $bulanIndo = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ];
                            $tanggalObj = date_create($data->created_at);
                            $hari = date_format($tanggalObj, 'd');
                            $bulan = (int) date_format($tanggalObj, 'm');
                            $tahun = date_format($tanggalObj, 'Y');
                            $tanggalIndonesia = $hari . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
                        @endphp

                        <div class="date-location" style="margin-bottom:3px; font-size:13px; line-height:1.1;">pada
                            tanggal
                            {{ $tanggalIndonesia }}
                        </div>
                        <hr style="width: 95%; margin-left: 0;">
                        <div style="font-size:13px; margin-bottom:1px; line-height:1.1; text-align:center;">
                            a.n. Panglima Kodam Jaya/Jayakarta<br>
                            Asisten Logistik,
                        </div>
                        <div class="signature-box" style="height: 40px; margin-bottom: 6px;"></div>
                        <div class="rank-number"
                            style="margin-top:1px; font-size:13px; line-height:1.1; text-align:center;">
                            Didid Yusnadi, M.Si<br>&nbsp;Kolonel Czi NRP 11000050710979
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>