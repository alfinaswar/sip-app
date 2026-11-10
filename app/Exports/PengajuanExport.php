<?php

namespace App\Exports;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengajuanExport extends DefaultValueBinder implements
    FromQuery,
    WithMapping,
    WithCustomChunkSize,
    WithHeadings,
    WithStyles,
    WithDefaultStyles,
    WithColumnWidths,
    WithCustomValueBinder
{
    public const EXPORT_COLUMNS = [
        'id',
        'NomorSIP',
        'Nama',
        'Pangkat',
        'Korps',
        'NRPNIP',
        'Jabatan',
        'Kesatuan',
        'Ktp',
        'Ttl',
        'Status',
        'JumlahTanggungan',
        'AnggotaKeluarga',
        'UntukMenempati',
        'Keterangan',
        'DigunakanSebagai',
        'Kpad',
        'AlamatRumah',
        'TypeLuas',
        'Tmt',
    ];

    private int $rowNumber = 0;

    public function __construct(private ?Builder $baseQuery = null)
    {
    }

    public function query()
    {
        $query = $this->baseQuery
            ? (clone $this->baseQuery)->select(self::EXPORT_COLUMNS)
            : DB::table('surat_izins')->select(self::EXPORT_COLUMNS);

        return $query->orderBy('id', 'desc');
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function map($item): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $this->cleanNomorSip($item->NomorSIP ?? null),
            $item->Nama ?: '-',
            $item->Pangkat ?: '-',
            $item->Korps ?: '-',
            $item->NRPNIP ?: '-',
            $item->Jabatan ?: '-',
            $item->Kesatuan ?: '-',
            $item->Ktp ?: '-',
            $item->Ttl ?: '-',
            $item->Status ?: '-',
            !empty($item->JumlahTanggungan) ? $item->JumlahTanggungan . ' orang' : '-',
            $this->formatAnggotaKeluarga($item->AnggotaKeluarga ?? null),
            $item->UntukMenempati ?: '-',
            $item->Keterangan ?: '-',
            $item->DigunakanSebagai ?: '-',
            $item->Kpad ?: '-',
            $item->AlamatRumah ?: '-',
            $item->TypeLuas ?: '-',
            $item->Tmt ?: '-',
        ];
    }

    public function bindValue(Cell $cell, $value): bool
    {
        if (in_array($cell->getColumn(), ['F', 'I'], true) && $value !== null && $value !== '' && $value !== '-') {
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }

    private function cleanNomorSip(?string $value): string
    {
        if ($value === null || trim($value) === '') {
            return '-';
        }

        $plain = str_ireplace(['<br>', '<br/>', '<br />', '</p>', '</div>'], ' ', $value);
        $plain = html_entity_decode(strip_tags($plain), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $plain = trim((string) preg_replace('/\s+/u', ' ', $plain));

        return $plain !== '' ? $plain : '-';
    }

    private function formatAnggotaKeluarga($anggotaKeluarga): string
    {
        if (empty($anggotaKeluarga)) {
            return '-';
        }

        if (is_string($anggotaKeluarga)) {
            $anggotaKeluarga = json_decode($anggotaKeluarga, true);
        }

        if (!is_array($anggotaKeluarga) || empty($anggotaKeluarga)) {
            return '-';
        }

        $anggotaList = [];
        foreach (array_values($anggotaKeluarga) as $index => $anggota) {
            if (!is_array($anggota)) {
                if (is_scalar($anggota) && trim((string) $anggota) !== '') {
                    $anggotaList[] = ($index + 1) . '. ' . trim((string) $anggota);
                }
                continue;
            }

            $nama = $anggota['nama'] ?? 'Tidak diketahui';
            $jk = $anggota['jk'] ?? '-';
            $umur = $anggota['umur'] ?? '-';
            $hubungan = $anggota['hubungan'] ?? '-';
            $keterangan = !empty($anggota['keterangan']) ? ' - ' . $anggota['keterangan'] : '';

            $anggotaList[] = ($index + 1) . '. ' . $nama . ' (' . $jk . ', ' . $umur . ' tahun, ' . $hubungan . ')' . $keterangan;
        }

        return $anggotaList ? implode("\n", $anggotaList) : '-';
    }

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
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'font' => [
                'size' => 10,
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP,
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = max(1, $sheet->getHighestRow());

        $styles = [
            'A1:T1' => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4B5320'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];

        if ($lastRow > 1) {
            $styles['M2:M' . $lastRow] = [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
                'font' => [
                    'size' => 9,
                ],
            ];
        }

        return $styles;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 20,
            'C' => 22,
            'D' => 16,
            'E' => 10,
            'F' => 18,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 15,
            'L' => 14,
            'M' => 36,
            'N' => 16,
            'O' => 20,
            'P' => 16,
            'Q' => 22,
            'R' => 28,
            'S' => 13,
            'T' => 14,
        ];
    }
}
