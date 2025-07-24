<?php

namespace App\Exports;

use App\Models\SuratIzin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PengajuanExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    ShouldAutoSize
{
    /**
     * Get collection data for export
     */
    public function collection()
    {
        return SuratIzin::all()->map(function ($item, $index) {
            return [
                $index + 1, // No urut
                $item->NomorSIP ?? '-',
                $item->Nama ?? '-',
                $item->Pangkat ?? '-',
                $item->Korps ?? '-',
                $item->NRPNIP ?? '-',
                $item->Jabatan ?? '-',
                $item->Kesatuan ?? '-',
                $item->Ktp ?? '-',
                $item->Ttl ?? '-',
                $item->Status ?? '-',
                $item->JumlahTanggungan ? $item->JumlahTanggungan . ' orang' : '-',
                $this->formatAnggotaKeluarga($item->AnggotaKeluarga),
                $item->UntukMenempati ?? '-',
                $item->Keterangan ?? '-',
                $item->DigunakanSebagai ?? '-',
                $item->Kpad ?? '-',
                $item->AlamatRumah ?? '-',
                $item->TypeLuas ?? '-',
                $item->Tmt ?? '-',
                $item->TandaTangan ?? '-',
                $item->Sebagai ?? '-',
                $item->Foto ?? '-',
                $item->Tembusan ?? '-',
            ];
        });
    }

    /**
     * Format anggota keluarga data into readable list
     */
    private function formatAnggotaKeluarga($anggotaKeluarga)
    {
        if (empty($anggotaKeluarga)) {
            return '-';
        }

        // Handle if it's a JSON string
        if (is_string($anggotaKeluarga)) {
            $anggotaKeluarga = json_decode($anggotaKeluarga, true);
        }

        // Check if it's a valid array
        if (!is_array($anggotaKeluarga) || empty($anggotaKeluarga)) {
            return '-';
        }

        $anggotaList = [];
        foreach ($anggotaKeluarga as $index => $anggota) {
            $nama = $anggota['nama'] ?? 'Tidak diketahui';
            $jk = $anggota['jk'] ?? '-';
            $umur = $anggota['umur'] ?? '-';
            $hubungan = $anggota['hubungan'] ?? '-';
            $keterangan = !empty($anggota['keterangan']) ? ' - ' . $anggota['keterangan'] : '';

            $anggotaList[] = ($index + 1) . '. ' . $nama . ' (' . $jk . ', ' . $umur . ' tahun, ' . $hubungan . ')' . $keterangan;
        }

        return implode("\n", $anggotaList);
    }

    /**
     * Define table headings
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor SIP',
            'Nama',
            'Pangkat',
            'Korps',
            'NRP/NIP',
            'Jabatan',
            'Kesatuan',
            'KTP',
            'TTL',
            'Status',
            'Jumlah Tanggungan',
            'Anggota Keluarga',
            'Untuk Menempati',
            'Keterangan',
            'Digunakan Sebagai',
            'KPAD',
            'Alamat Rumah',
            'Type / Luas',
            'TMT',
            'Tanda Tangan',
            'Sebagai',
            'Foto',
            'Tembusan',
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4B5320']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000']
                    ]
                ]
            ],

            // Data rows styling
            '2:' . $lastRow => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC']
                    ]
                ],
                'font' => [
                    'size' => 10
                ]
            ],

            // Anggota Keluarga column (column M = 13) special formatting
            'M:M' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'font' => [
                    'size' => 9
                ]
            ]
        ];
    }

    /**
     * Define column widths
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Nomor SIP
            'C' => 20,  // Nama
            'D' => 15,  // Pangkat
            'E' => 10,  // Korps
            'F' => 18,  // NRP/NIP
            'G' => 20,  // Jabatan
            'H' => 20,  // Kesatuan
            'I' => 18,  // KTP
            'J' => 15,  // TTL
            'K' => 12,  // Status
            'L' => 12,  // Jumlah Tanggungan
            'M' => 35,  // Anggota Keluarga (wider for list)
            'N' => 15,  // Untuk Menempati
            'O' => 20,  // Keterangan
            'P' => 15,  // Digunakan Sebagai
            'Q' => 12,  // KPAD
            'R' => 25,  // Alamat Rumah
            'S' => 12,  // Type/Luas
            'T' => 12,  // TMT
            'U' => 15,  // Tanda Tangan
            'V' => 12,  // Sebagai
            'W' => 15,  // Foto
            'X' => 15,  // Tembusan
        ];
    }
}
