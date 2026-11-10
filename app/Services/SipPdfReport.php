<?php

namespace App\Services;

use Dompdf\Cpdf;
use Illuminate\Database\Query\Builder;

class SipPdfReport
{
    private const PAGE_WIDTH = 935.43;  // F4 Landscape (330mm)
    private const PAGE_HEIGHT = 595.28; // F4 Landscape (210mm)
    private const MARGIN_L = 16.0;
    private const MARGIN_R = 16.0;
    private const MARGIN_T = 18.0;
    private const MARGIN_B = 22.0;

    private string $fontRegular;
    private string $fontBold;

    public function __construct()
    {
        $fontDir = base_path('vendor/dompdf/dompdf/lib/fonts/');
        $this->fontRegular = $fontDir . 'Helvetica.afm';
        $this->fontBold = $fontDir . 'Helvetica-Bold.afm';
    }

    /**
     * Generate F4 landscape PDF binary by streaming rows in chunks via Cpdf.
     * Avoids DomPDF HTML/Cellmap overhead so thousands of rows stay fast and low-memory.
     */
    public function generate(Builder $query, array $activeFilters = []): string
    {
        $totalRows = (clone $query)->count();

        $pdf = new Cpdf([0, 0, self::PAGE_WIDTH, self::PAGE_HEIGHT]);
        $pdf->selectFont($this->fontRegular);

        $usableW = self::PAGE_WIDTH - self::MARGIN_L - self::MARGIN_R;
        $cols = [
            ['No', 0.025],
            ['Nomor SIP', 0.055],
            ['Nama', 0.070],
            ['Pangkat', 0.050],
            ['Korps', 0.032],
            ['NRP/NIP', 0.055],
            ['Jabatan', 0.058],
            ['Kesatuan', 0.055],
            ['KTP', 0.058],
            ['TTL', 0.055],
            ['Status', 0.048],
            ['Tangg.', 0.035],
            ['Anggota Keluarga', 0.095],
            ['Menempati', 0.050],
            ['Ket.', 0.045],
            ['Fungsi', 0.045],
            ['KPAD', 0.058],
            ['Alamat Rumah', 0.070],
            ['Type/Luas', 0.036],
            ['TMT', 0.035],
        ];

        $colWidths = [];
        $colXs = [];
        $cursorX = self::MARGIN_L;
        foreach ($cols as $idx => [$label, $pct]) {
            $cw = $usableW * $pct;
            $colWidths[$idx] = $cw;
            $colXs[$idx] = $cursorX;
            $cursorX += $cw;
        }

        $y = self::PAGE_HEIGHT - self::MARGIN_T;

        // Report Title Header
        $pdf->selectFont($this->fontBold);
        $pdf->setColor([0.12, 0.17, 0.10]);
        $pdf->addText(self::MARGIN_L, $y, 12, $this->encode('DAFTAR PENGHUNIAN RUMAH DINAS - KPAD KODAM JAYA/JAYAKARTA'));
        $y -= 12;

        $pdf->selectFont($this->fontRegular);
        $pdf->setColor([0.35, 0.35, 0.35]);
        $filterText = empty($activeFilters)
            ? 'Semua Data'
            : implode(' | ', $activeFilters);
        $subtitle = sprintf(
            'Total Data: %s | Filter: %s | Dicetak: %s',
            number_format($totalRows, 0, ',', '.'),
            $filterText,
            date('d-m-Y H:i')
        );
        $pdf->addText(self::MARGIN_L, $y, 7.5, $this->encode($subtitle));
        $y -= 10;

        $drawTableHeader = function () use ($pdf, $cols, $colXs, $usableW, &$y): void {
            $rowH = 16.0;
            $pdf->setColor([0.29, 0.33, 0.13]); // Olive TNI (#4b5320)
            $pdf->filledRectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);
            $pdf->setColor([0.75, 0.63, 0.29]); // Gold accent line (#bfa14a)
            $pdf->setLineStyle(1.0);
            $pdf->line(self::MARGIN_L, $y - $rowH, self::MARGIN_L + $usableW, $y - $rowH);

            $pdf->setColor([1.0, 1.0, 1.0]);
            $pdf->selectFont($this->fontBold);
            foreach ($cols as $idx => [$label, $pct]) {
                $pdf->addText($colXs[$idx] + 2, $y - 11, 6.2, $label);
            }
            $pdf->selectFont($this->fontRegular);
            $y -= $rowH;
        };

        $pageNo = 1;
        $drawFooter = function () use ($pdf, &$pageNo): void {
            $pdf->setColor([0.45, 0.45, 0.45]);
            $pdf->addText(self::MARGIN_L, 10, 6.8, 'SIP Rumah Dinas - Kodam Jaya/Jayakarta');
            $pageLabel = 'Halaman ' . $pageNo;
            $tw = $pdf->getTextWidth(6.8, $pageLabel);
            $pdf->addText(self::PAGE_WIDTH - self::MARGIN_R - $tw, 10, 6.8, $pageLabel);
        };

        $drawTableHeader();
        $drawFooter();

        if ($totalRows === 0) {
            $rowH = 22.0;
            $pdf->setStrokeColor([0.80, 0.84, 0.86]);
            $pdf->setLineStyle(0.4);
            $pdf->rectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);
            $pdf->setColor([0.35, 0.35, 0.35]);
            $pdf->addText(self::MARGIN_L + 8, $y - 14, 8, 'Tidak ada data yang sesuai dengan filter.');

            return $pdf->output(['compress' => 1]);
        }

        $fontSize = 6.0;
        $lineH = 7.4;
        $rowIndex = 0;

        $query->orderBy('id', 'desc')->chunk(500, function ($rows) use (
            $pdf,
            $cols,
            $colWidths,
            $colXs,
            $usableW,
            &$y,
            &$rowIndex,
            &$pageNo,
            $fontSize,
            $lineH,
            $drawTableHeader,
            $drawFooter
        ) {
            foreach ($rows as $item) {
                $rowIndex++;
                $vals = [
                    (string) $rowIndex,
                    $this->cleanHtml($item->NomorSIP ?? null),
                    $this->cleanStr($item->Nama ?? null),
                    $this->cleanStr($item->Pangkat ?? null),
                    $this->cleanStr($item->Korps ?? null),
                    $this->cleanStr($item->NRPNIP ?? null),
                    $this->cleanStr($item->Jabatan ?? null),
                    $this->cleanStr($item->Kesatuan ?? null),
                    $this->cleanStr($item->Ktp ?? null),
                    $this->cleanStr($item->Ttl ?? null),
                    $this->cleanStr($item->Status ?? null),
                    !empty($item->JumlahTanggungan) ? $this->cleanStr($item->JumlahTanggungan) . ' org' : '-',
                    $this->formatAnggotaKeluarga($item->AnggotaKeluarga ?? null),
                    $this->cleanStr($item->UntukMenempati ?? null),
                    $this->cleanStr($item->Keterangan ?? null),
                    $this->cleanStr($item->DigunakanSebagai ?? null),
                    $this->cleanStr($item->Kpad ?? null),
                    $this->cleanStr($item->AlamatRumah ?? null),
                    $this->cleanStr($item->TypeLuas ?? null),
                    $this->cleanStr($item->Tmt ?? null),
                ];

                $cellLines = [];
                $maxLines = 1;
                foreach ($cols as $ci => $meta) {
                    $lines = $this->wrapText($pdf, $vals[$ci], $colWidths[$ci] - 4.0, $fontSize);
                    $cellLines[$ci] = $lines;
                    $cnt = count($lines);
                    if ($cnt > $maxLines) {
                        $maxLines = $cnt;
                    }
                }

                $rowH = max(12.0, $maxLines * $lineH + 4.0);

                // Prevent oversized single row from breaking loop
                if ($y - $rowH < self::MARGIN_B) {
                    $pdf->newPage();
                    $pageNo++;
                    $y = self::PAGE_HEIGHT - self::MARGIN_T;
                    $drawTableHeader();
                    $drawFooter();
                }

                if ($rowIndex % 2 === 0) {
                    $pdf->setColor([0.96, 0.97, 0.96]);
                    $pdf->filledRectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);
                }

                $pdf->setStrokeColor([0.80, 0.84, 0.86]);
                $pdf->setLineStyle(0.35);
                $pdf->rectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);

                $pdf->setColor([0.13, 0.13, 0.13]);
                foreach ($cols as $ci => $meta) {
                    if ($ci > 0) {
                        $pdf->line($colXs[$ci], $y, $colXs[$ci], $y - $rowH);
                    }
                    $tx = $colXs[$ci] + 2.0;
                    foreach ($cellLines[$ci] as $li => $txt) {
                        $pdf->addText($tx, $y - 8.2 - ($li * $lineH), $fontSize, $txt);
                    }
                }

                $y -= $rowH;
            }
        });

        return $pdf->output(['compress' => 1]);
    }

    private function wrapText(Cpdf $pdf, string $raw, float $maxWidth, float $fontSize): array
    {
        $text = $this->encode($raw);
        if ($text === '' || $text === '-') {
            return ['-'];
        }

        $paragraphs = preg_split('/\r\n|\r|\n/', $text);
        $lines = [];

        foreach ($paragraphs as $para) {
            $para = trim($para);
            if ($para === '') {
                continue;
            }
            $words = preg_split('/\s+/', $para);
            $line = '';
            foreach ($words as $word) {
                if ($word === '') {
                    continue;
                }
                $test = $line === '' ? $word : $line . ' ' . $word;
                if ($pdf->getTextWidth($fontSize, $test) <= $maxWidth) {
                    $line = $test;
                } else {
                    if ($line !== '') {
                        $lines[] = $line;
                    }
                    if ($pdf->getTextWidth($fontSize, $word) > $maxWidth) {
                        $chunk = '';
                        $len = strlen($word);
                        for ($k = 0; $k < $len; $k++) {
                            $ch = $word[$k];
                            if ($pdf->getTextWidth($fontSize, $chunk . $ch) <= $maxWidth) {
                                $chunk .= $ch;
                            } else {
                                if ($chunk !== '') {
                                    $lines[] = $chunk;
                                }
                                $chunk = $ch;
                            }
                        }
                        $line = $chunk;
                    } else {
                        $line = $word;
                    }
                }
            }
            if ($line !== '') {
                $lines[] = $line;
            }
        }

        return $lines ?: ['-'];
    }

    private function formatAnggotaKeluarga($anggotaKeluarga): string
    {
        if (empty($anggotaKeluarga)) {
            return '-';
        }

        if (is_string($anggotaKeluarga)) {
            $decoded = json_decode($anggotaKeluarga, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->cleanStr($anggotaKeluarga);
            }
            $anggotaKeluarga = $decoded;
        }

        if (!is_array($anggotaKeluarga) || empty($anggotaKeluarga)) {
            return '-';
        }

        $list = [];
        foreach (array_values($anggotaKeluarga) as $idx => $a) {
            if (is_array($a)) {
                $nama = trim((string) ($a['nama'] ?? ''));
                $umur = trim((string) ($a['umur'] ?? ''));
                $hub = trim((string) ($a['hubungan'] ?? ''));
                if ($nama === '' && $umur === '' && $hub === '') {
                    continue;
                }
                $info = array_filter([$hub, $umur !== '' ? $umur . 'th' : '']);
                $list[] = ($idx + 1) . '. ' . ($nama ?: '-') . ($info ? ' (' . implode(', ', $info) . ')' : '');
            } elseif (is_scalar($a) && trim((string) $a) !== '') {
                $list[] = ($idx + 1) . '. ' . trim((string) $a);
            }
        }

        return $list ? implode("\n", $list) : '-';
    }

    private function cleanHtml(?string $value): string
    {
        if ($value === null || trim($value) === '') {
            return '-';
        }
        $plain = str_ireplace(['<br>', '<br/>', '<br />', '</p>', '</div>'], ' ', $value);
        $plain = html_entity_decode(strip_tags($plain), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $plain = trim((string) preg_replace('/\s+/u', ' ', $plain));
        return $plain !== '' ? $plain : '-';
    }

    private function cleanStr($value): string
    {
        if ($value === null) {
            return '-';
        }
        $str = trim((string) $value);
        return $str !== '' ? $str : '-';
    }

    private function encode(string $utf8): string
    {
        $converted = @iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $utf8);
        if ($converted === false) {
            return preg_replace('/[^\x20-\x7E\n]/', '', $utf8) ?? '';
        }
        return $converted;
    }
}
