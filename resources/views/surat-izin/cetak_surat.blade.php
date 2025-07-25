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
        }

        .table-solid th,
        .table-solid td {
            border: 1px solid #000;
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
        <img src="{{public_path('assets/img/icon/bgsurat.png')}}" alt="" width="100%" height="100%">
    </div>

    <div class="text-al" style="text-align: center; margin-bottom: 10px;">
        <span style="font-size: 20px; font-weight: bold; letter-spacing: 2px;">SURAT IZIN PENGHUNIAN</span>
        <br>
        <span style="font-size: 12px;">Nomor SIP {{$data->NomorSIP}}</span>
    </div>
    <div class="content">
        <div class="dasar" style="line-height: 20px;">
            <h3>Dasar:</h3>
            <ol>
                <li>Peraturan Menhan RI Nomor 13 Tahun 2018 tentang Pembinaan Rumah Negara di lingkungan Kemhan dan TNI;
                </li>
                <li>Peraturan Kasad Nomor 57 Tahun 2022 tanggal 5 Desember 2022 tentang Pembinaan Rumah Negara di
                    lingkungan TNI AD;</li>
                <li>Surat Telegram Kasad Nomor ST/273/2022 tanggal 8 Februari 2022 tentang Perintah tertib penghunian
                    aset BMN berupa rumah dinas TNI AD.</li>
            </ol>
            <hr>
        </div>

        <div class="izin-section" style="line-height: 20px;">
            <div class="izin-intro">
                <p>Diberikan izin penghunian rumah dinas TNI AD golongan II kepada:</p>
            </div>

            <div class="detail-list">
                <table style="width:100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 3%;">1.</td>
                        <td style="width: 27%;">Nama</td>
                        <td style="width: 2%;">:</td>
                        <td>{{$data->Nama}}</td>
                        <td style="width: 10%;"></td>
                        <td style="width: 10%;">Korps</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 20%;">{{$data->Korps}}</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td>{{$data->Pangkat}}</td>
                        <td></td>
                        <td>NRP/NIP</td>
                        <td>:</td>
                        <td>{{$data->NRPNIP}}</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{$data->Jabatan}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Kesatuan</td>
                        <td>:</td>
                        <td>{{$data->Kesatuan}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Nomor KTP</td>
                        <td>:</td>
                        <td>{{$data->Ktp}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Tempat tanggal lahir</td>
                        <td>:</td>
                        <td>{{$data->Ttl}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{$data->Status}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Jumlah keluarga yang menjadi tanggungan</td>
                        <td>:</td>
                        <td>{{$data->JumlahTanggungan}} orang</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="table-container">
                <table class="table-solid">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>UMUR</th>
                            <th>JENIS KELAMIN</th>
                            <th>HUBUNGAN KELUARGA</th>
                            <th>KET</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->AnggotaKeluarga as $key => $ak)
                            <tr class="table-row">
                                <td>{{$key + 1}}</td>
                                <td>{{$ak['nama']}}</td>
                                <td>{{$ak['umur']}}</td>
                                <td>{{$ak['jk']}}</td>
                                <td>{{$ak['hubungan']}}</td>
                                <td>{{$ak['keterangan']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="requirements">
                <table class="">
                    <tr>
                        <td>9.</td>
                        <td>Untuk menempati</td>
                        <td>:</td>
                        <td>{{$data->UntukMenempati}}</td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Keterangan ruangan</td>
                        <td>:</td>
                        <td>{{$data->Keterangan}}</td>
                    </tr>
                    <tr>
                        <td>11.</td>
                        <td>Digunakan sebagai</td>
                        <td>:</td>
                        <td>{{$data->DigunakanSebagai}}</td>
                    </tr>
                    <tr>
                        <td>12.</td>
                        <td>Nama HPAD</td>
                        <td>:</td>
                        <td>{{$data->Kpad}}</td>
                    </tr>
                    <tr>
                        <td>13.</td>
                        <td>Alamat rumah</td>
                        <td>:</td>
                        <td>{{$data->AlamatRumah}}</td>
                    </tr>
                    <tr>
                        <td>14.</td>
                        <td>Type dan luas</td>
                        <td>:</td>
                        <td>{{$data->TypeLuas}}</td>
                    </tr>
                    <tr>
                        <td>15.</td>
                        <td>Menempati rumah TMT</td>
                        <td>:</td>
                        <td>{{$data->Tmt}}</td>
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
                        <div style="margin-top: 30px; border:1px solid #000; padding:8px; text-align:center;">
                            <strong>SIP BERLAKU S.D.</strong><br>
                            <strong>
                                @php
                                    use Carbon\Carbon;
                                    $tanggalBerlaku = Carbon::parse($data->created_at)->addYear()->format('d-m-Y');
                                @endphp
                                {{$tanggalBerlaku}}
                            </strong>
                        </div>
                        <div style="margin-top: 15px;">
                            <p><strong>Tembusan:</strong></p>
                            @if(!empty($data->Tembusan))
                                @foreach(explode(';', $data->Tembusan) as $tembusan)
                                    <p>- {{$tembusan}}</p>
                                @endforeach
                            @endif
                        </div>

                    </td>
                    <!-- Kolom Tengah: Foto -->
                    <td style="vertical-align:top; width:50%; text-align:center;">
                        <div class="signature-box" style="margin-bottom: 10px;">
                            @if(!empty($data->Foto))
                                <img src="{{ asset('storage/foto/' . $data->Foto) }}" alt="Foto"
                                    style="width:100px; height:120px; object-fit:cover; border:1px solid #000;">
                            @else
                                <img src="{{ asset('storage/foto/' . $data->Foto) }}" alt="Foto"
                                    style="width:100px; height:120px; object-fit:cover; border:1px solid #000;">
                            @endif
                        </div>
                        <div class="name-title" style="margin-top: 10px;">

                            <strong></strong>
                        </div>
                    </td>
                    <!-- Kolom Kanan: Tanda Tangan Panglima -->
                    <td style="vertical-align:top; width:30%; min-width:180px; text-align:left;">
                        <div class="date-location" style="margin-bottom: 5px;">Dikeluarkan di Jakarta</div>
                        @php
                            $bulanIndo = [
                                1 => 'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            ];
                            $tanggalObj = date_create($data->created_at);
                            $hari = date_format($tanggalObj, 'd');
                            $bulan = (int) date_format($tanggalObj, 'm');
                            $tahun = date_format($tanggalObj, 'Y');
                            $tanggalIndonesia = $hari . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
                        @endphp
                        <div class="date-location" style="margin-bottom: 20px;">pada tanggal {{$tanggalIndonesia}}</div>
                        <div class="signature-box" style="height: 60px; margin-bottom: 10px;">

                        </div>
                        <div class="name-title" style="font-weight: bold; margin-top: 2px; margin-bottom: 2px;">
                            {{$data->TandaTangan}}
                        </div>
                        <div class="rank-number" style="margin-top: 2px;">{{$data->Pangkat}} {{$data->Korps}}
                            {{$data->NRPNIP}}
                        </div>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
