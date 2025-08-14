<!DOCTYPE html>
<html>

<head>
    <title>Data Pengajuan Rumah Dinas</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15px 20px 15px 20px;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 11px;
            background: #f8f9fa;
            color: #222;
        }

        .container {
            width: 98%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 8px;
            font-size: 22px;
            letter-spacing: 1px;
            color: #2d3e50;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #bfc9d1;
            padding: 5px 4px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #4b5320;
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background: #f4f6f8;
        }

        tr:hover {
            background: #e9f0e1;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Pengajuan Rumah Dinas</h2>
        <div class="subtitle">Laporan Data Penting Pengajuan Rumah Dinas</div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SIP</th>
                    <th>Nama</th>
                    <th>Pangkat</th>
                    <th>Korps</th>
                    <th>NRP/NIP</th>
                    <th>Jabatan</th>
                    <th>Kesatuan</th>
                    <th>KTP</th>
                    <th>TTL</th>
                    <th>Status</th>
                    <th>Jumlah Tanggungan</th>
                    <th>Anggota Keluarga</th>
                    <th>Untuk Menempati</th>
                    <th>Keterangan</th>
                    <th>Digunakan Sebagai</th>
                    <th>KPAD</th>
                    <th>Alamat Rumah</th>
                    <th>Type / Luas</th>
                    <th>TMT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <td class="nowrap">{{ $i + 1 }}</td>
                        <td>{{ $item->NomorSIP ?? '-' }}</td>
                        <td>{{ $item->Nama ?? '-' }}</td>
                        <td>{{ $item->Pangkat ?? '-' }}</td>
                        <td>{{ $item->Korps ?? '-' }}</td>
                        <td>{{ $item->NRPNIP ?? '-' }}</td>
                        <td>{{ $item->Jabatan ?? '-' }}</td>
                        <td>{{ $item->Kesatuan ?? '-' }}</td>
                        <td>{{ $item->Ktp ?? '-' }}</td>
                        <td>{{ $item->Ttl ?? '-' }}</td>
                        <td>{{ $item->Status ?? '-' }}</td>
                        <td>
                            @if(isset($item->JumlahTanggungan))
                                {{ $item->JumlahTanggungan . ' orang' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @php
                                // Format anggota keluarga jika array/json
                                $anggota = $item->AnggotaKeluarga ?? '-';
                                if (is_string($anggota)) {
                                    $decoded = json_decode($anggota, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $anggota = implode(', ', array_map(function ($a) {
                                            if (is_array($a)) {
                                                return implode(' ', $a);
                                            }
                                            return $a;
                                        }, $decoded));
                                    }
                                }
                            @endphp
                            {{ $anggota ?: '-' }}
                        </td>
                        <td>{{ $item->UntukMenempati ?? '-' }}</td>
                        <td>{{ $item->Keterangan ?? '-' }}</td>
                        <td>{{ $item->DigunakanSebagai ?? '-' }}</td>
                        <td>{{ $item->Kpad ?? '-' }}</td>
                        <td>{{ $item->AlamatRumah ?? '-' }}</td>
                        <td>{{ $item->TypeLuas ?? '-' }}</td>
                        <td>{{ $item->Tmt ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
