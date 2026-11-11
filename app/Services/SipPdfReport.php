<?php

namespace App\Services;

use Dompdf\Cpdf;
use Illuminate\Database\Query\Builder;

class SipPdfReport
{
    private const PAGE_WIDTH = 935.43;  // F4 Landscape (330mm)
    private const PAGE_HEIGHT = 595.28; // F4 Landscape (210mm)
    private const MARGIN_L = 14.0;
    private const MARGIN_R = 14.0;
    private const MARGIN_T = 16.0;
    private const MARGIN_B = 24.0;

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
            [['No'], 0.023, 'center'],
            [['Nomor SIP'], 0.056, 'left'],
            [['Nama'], 0.072, 'left'],
            [['Pangkat'], 0.048, 'left'],
            [['Korps'], 0.028, 'center'],
            [['NRP / NIP'], 0.060, 'left'],
            [['Jabatan'], 0.054, 'left'],
            [['Kesatuan'], 0.050, 'left'],
            [['KTP'], 0.056, 'left'],
            [['TTL'], 0.050, 'left'],
            [['Status'], 0.044, 'left'],
            [['Jml.', 'Tangg.'], 0.032, 'center'],
            [['Anggota Keluarga'], 0.092, 'left'],
            [['Untuk', 'Menempati'], 0.046, 'left'],
            [['Ket.'], 0.040, 'left'],
            [['Digunakan', 'Sebagai'], 0.040, 'left'],
            [['KPAD'], 0.055, 'left'],
            [['Alamat Rumah'], 0.068, 'left'],
            [['Type /', 'Luas'], 0.036, 'center'],
            [['TMT'], 0.050, 'center'],
        ];

        $colWidths = [];
        $colXs = [];
        $cursorX = self::MARGIN_L;
        foreach ($cols as $idx => [$labelLines, $pct, $align]) {
            $cw = $usableW * $pct;
            $colWidths[$idx] = $cw;
            $colXs[$idx] = $cursorX;
            $cursorX += $cw;
        }

        $filterText = empty($activeFilters)
            ? 'Semua Data'
            : implode(' | ', $activeFilters);
        $printedAt = date('d-m-Y H:i');

        $y = self::PAGE_HEIGHT - self::MARGIN_T;

        // Kop / Report Header Halaman 1
        $kopH = 38.0;
        $pdf->setColor([0.961, 0.969, 0.949]);
        $pdf->filledRectangle(self::MARGIN_L, $y - $kopH, $usableW, $kopH);

        $pdf->setColor([0.294, 0.325, 0.125]);
        $pdf->filledRectangle(self::MARGIN_L, $y - $kopH, 3.5, $kopH);

        $pdf->selectFont($this->fontBold);
        $pdf->setColor([0.294, 0.325, 0.125]);
        $pdf->addText(self::MARGIN_L + 9.0, $y - 10.5, 7.0, $this->encode('TNI ANGKATAN DARAT  -  KODAM JAYA / JAYAKARTA'));

        $pdf->setColor([0.106, 0.141, 0.071]);
        $pdf->addText(self::MARGIN_L + 9.0, $y - 22.5, 11.0, $this->encode('DAFTAR PENGHUNIAN RUMAH DINAS (SIP) - KPAD'));

        $pdf->selectFont($this->fontRegular);
        $pdf->setColor([0.28, 0.33, 0.41]);
        $subtitle = sprintf(
            'Total Data: %s   |   Filter: %s   |   Dicetak: %s',
            number_format($totalRows, 0, ',', '.'),
            $filterText,
            $printedAt
        );
        $pdf->addText(self::MARGIN_L + 9.0, $y - 33.0, 6.8, $this->encode($subtitle));

        $pdf->setStrokeColor([0.749, 0.631, 0.290]);
        $pdf->setLineStyle(1.2);
        $pdf->line(self::MARGIN_L, $y - $kopH, self::MARGIN_L + $usableW, $y - $kopH);

        $y -= ($kopH + 6.0);

        $drawContinuationHeader = function () use ($pdf, $usableW, $filterText, &$y): void {
            $pdf->selectFont($this->fontBold);
            $pdf->setColor([0.294, 0.325, 0.125]);
            $pdf->addText(self::MARGIN_L, $y - 8.0, 7.0, $this->encode('DAFTAR PENGHUNIAN RUMAH DINAS (SIP) - KPAD KODAM JAYA / JAYAKARTA'));

            $pdf->selectFont($this->fontRegular);
            $pdf->setColor([0.35, 0.38, 0.42]);
            $rightText = $this->encode('Filter: ' . $filterText);
            $maxRightW = 340.0;
            while ($pdf->getTextWidth(6.3, $rightText) > $maxRightW && strlen($rightText) > 10) {
                $rightText = substr($rightText, 0, -4) . '...';
            }
            $rw = $pdf->getTextWidth(6.3, $rightText);
            $pdf->addText(self::PAGE_WIDTH - self::MARGIN_R - $rw, $y - 8.0, 6.3, $rightText);

            $pdf->setStrokeColor([0.749, 0.631, 0.290]);
            $pdf->setLineStyle(0.8);
            $pdf->line(self::MARGIN_L, $y - 12.0, self::MARGIN_L + $usableW, $y - 12.0);
            $y -= 16.0;
        };

        $drawTableHeader = function () use ($pdf, $cols, $colXs, $colWidths, $usableW, &$y): void {
            $rowH = 21.0;
            $pdf->setColor([0.294, 0.325, 0.125]); // Olive TNI (#4b5320)
            $pdf->filledRectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);

            $pdf->setStrokeColor([0.416, 0.451, 0.227]);
            $pdf->setLineStyle(0.4);
            foreach ($cols as $idx => $meta) {
                if ($idx > 0) {
                    $pdf->line($colXs[$idx], $y, $colXs[$idx], $y - $rowH);
                }
            }

            $pdf->setStrokeColor([0.184, 0.212, 0.078]);
            $pdf->setLineStyle(0.5);
            $pdf->rectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);

            $pdf->setStrokeColor([0.749, 0.631, 0.290]); // Gold accent line (#bfa14a)
            $pdf->setLineStyle(1.2);
            $pdf->line(self::MARGIN_L, $y - $rowH, self::MARGIN_L + $usableW, $y - $rowH);

            $pdf->setColor([1.0, 1.0, 1.0]);
            $pdf->selectFont($this->fontBold);
            $headerFontSize = 5.4;
            foreach ($cols as $idx => [$labelLines, $pct, $align]) {
                $lineCount = count($labelLines);
                foreach ($labelLines as $li => $label) {
                    $tw = $pdf->getTextWidth($headerFontSize, $label);
                    $tx = $colXs[$idx] + max(1.0, ($colWidths[$idx] - $tw) / 2.0);
                    $ty = $lineCount === 1
                        ? $y - 12.4
                        : $y - 8.4 - ($li * 7.0);
                    $pdf->addText($tx, $ty, $headerFontSize, $label);
                }
            }
            $pdf->selectFont($this->fontRegular);
            $y -= $rowH;
        };

        $pageNo = 1;
        $drawFooter = function () use ($pdf, $usableW, &$pageNo): void {
            $pdf->setStrokeColor([0.80, 0.84, 0.88]);
            $pdf->setLineStyle(0.5);
            $pdf->line(self::MARGIN_L, 18.0, self::MARGIN_L + $usableW, 18.0);

            $pdf->selectFont($this->fontRegular);
            $pdf->setColor([0.38, 0.42, 0.46]);
            $pdf->addText(self::MARGIN_L, 9.5, 6.5, 'SIP Rumah Dinas - KPAD Kodam Jaya / Jayakarta');

            $pdf->selectFont($this->fontBold);
            $pdf->setColor([0.294, 0.325, 0.125]);
            $pageLabel = 'Halaman ' . $pageNo;
            $tw = $pdf->getTextWidth(6.5, $pageLabel);
            $pdf->addText(self::PAGE_WIDTH - self::MARGIN_R - $tw, 9.5, 6.5, $pageLabel);
            $pdf->selectFont($this->fontRegular);
        };

        $drawTableHeader();
        $drawFooter();

        if ($totalRows === 0) {
            $rowH = 22.0;
            $pdf->setStrokeColor([0.796, 0.835, 0.882]);
            $pdf->setLineStyle(0.4);
            $pdf->rectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);
            $pdf->setColor([0.35, 0.35, 0.35]);
            $pdf->addText(self::MARGIN_L + 8, $y - 13.5, 7.5, 'Tidak ada data yang sesuai dengan filter.');

            return $pdf->output(['compress' => 1]);
        }

        $fontSize = 5.1;
        $lineH = 6.6;
        $rowIndex = 0;
        $rowsOnPage = 0;

        $query->orderBy('id', 'desc')->chunk(500, function ($rows) use (
            $pdf,
            $cols,
            $colWidths,
            $colXs,
            $usableW,
            &$y,
            &$rowIndex,
            &$rowsOnPage,
            &$pageNo,
            $fontSize,
            $lineH,
            $drawContinuationHeader,
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

                $rowH = max(12.0, $maxLines * $lineH + 4.4);

                if ($rowsOnPage > 0 && $y - $rowH < self::MARGIN_B) {
                    $pdf->newPage();
                    $pageNo++;
                    $rowsOnPage = 0;
                    $y = self::PAGE_HEIGHT - self::MARGIN_T;
                    $drawContinuationHeader();
                    $drawTableHeader();
                    $drawFooter();
                }

                if ($rowIndex % 2 === 0) {
                    $pdf->setColor([0.969, 0.976, 0.961]);
                    $pdf->filledRectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);
                }

                $pdf->setStrokeColor([0.796, 0.835, 0.882]);
                $pdf->setLineStyle(0.35);
                $pdf->rectangle(self::MARGIN_L, $y - $rowH, $usableW, $rowH);

                $pdf->setColor([0.13, 0.13, 0.13]);
                $capH = $fontSize * 0.72;
                foreach ($cols as $ci => [$labelLines, $pct, $align]) {
                    if ($ci > 0) {
                        $pdf->line($colXs[$ci], $y, $colXs[$ci], $y - $rowH);
                    }
                    $lines = $cellLines[$ci];
                    $cnt = count($lines);
                    $blockH = ($cnt - 1) * $lineH + $capH;
                    $topGap = ($rowH - $blockH) / 2.0;
                    $firstBaseline = $y - $topGap - $capH;

                    foreach ($lines as $li => $txt) {
                        if ($align === 'center') {
                            $tw = $pdf->getTextWidth($fontSize, $txt);
                            $tx = $colXs[$ci] + max(1.5, ($colWidths[$ci] - $tw) / 2.0);
                        } else {
                            $tx = $colXs[$ci] + 2.0;
                        }
                        $pdf->addText($tx, $firstBaseline - ($li * $lineH), $fontSize, $txt);
                    }
                }

                $y -= $rowH;
                $rowsOnPage++;
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
