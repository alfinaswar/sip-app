<?php

namespace Database\Seeders;

use App\Models\Korps;
use App\Models\Kpad;
use App\Models\Pangkat;
use App\Models\StatusPenghuni;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Seed the 4 core master tables for SIP Rumah Dinas.
     */
    public function run(): void
    {
        $kpads = [
            // WILAYAH KODIM 0501/JP
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'ABDUL RAHMAN SALEH'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'DR. WAHIDIN'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'KWINI'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'KWITANG TIMUR'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'SENEN RAYA'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0501/JP', 'nama_kpad' => 'SUMUR BATU'],
            // WILAYAH KODIM 0502/JU
            ['wilayah_kodim' => 'WILAYAH KODIM 0502/JU', 'nama_kpad' => 'LAGOA CEMARA'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0502/JU', 'nama_kpad' => 'PEMANDANGAN'],
            // WILAYAH KODIM 0503/JB
            ['wilayah_kodim' => 'WILAYAH KODIM 0503/JB', 'nama_kpad' => 'JELAMBAR ILIR'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0503/JB', 'nama_kpad' => 'KALIDERES'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0503/JB', 'nama_kpad' => 'KEBON JERUK KODAM'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0503/JB', 'nama_kpad' => 'KEBON JERUK MABAD'],
            // WILAYAH KODIM 0504/JS
            ['wilayah_kodim' => 'WILAYAH KODIM 0504/JS', 'nama_kpad' => 'TANAH KUSIR'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0504/JS', 'nama_kpad' => 'RAWAJATI'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0504/JS', 'nama_kpad' => 'LENTENG AGUNG MABAD I'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0504/JS', 'nama_kpad' => 'LENTENG AGUNG MABAD II'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0504/JS', 'nama_kpad' => 'BINTARO'],
            // WILAYAH KODIM 0505/JT
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'ASRAMA SENG'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'BERLAND'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'BILLIMON'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'BULAK RANTAI'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CAKUNG'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CEGER'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CIBUBUR'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CIJANTUNG II'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CIJANTUNG III (KOBANGDIKLAT)'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0505/JT', 'nama_kpad' => 'CIJANTUNG IV (BARET BIRU)'],
            // NAMA KPAD
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIJANTUNG IV (RADAR)'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIJANTUNG SEDERHANA'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIJANTUNG ZENI'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CILILITAN II (3 MEI)'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIPAYUNG KODAM'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIPAYUNG MABAD'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'CIPINANG JAYA'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'GUPUS TEKMEK'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'JATIWARINGIN'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'JEND. URIP SUMOHARJO'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'OTISTA III'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'DUMP TRUCK MENZIKON'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'SLAMET RIYADI'],
            ['wilayah_kodim' => 'NAMA KPAD', 'nama_kpad' => 'ZENI KRAMAT JATI'],
            // WILAYAH KODIM 0506/TGR
            ['wilayah_kodim' => 'WILAYAH KODIM 0506/TGR', 'nama_kpad' => 'REMPOA MABAD 21'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0506/TGR', 'nama_kpad' => 'REMPOA MABAD 25/60/124'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0506/TGR', 'nama_kpad' => 'REMPOA MABAD 55/65'],
            // WILAYAH KODIM 0507/BKS
            ['wilayah_kodim' => 'WILAYAH KODIM 0507/BKS', 'nama_kpad' => 'JATIWARNA'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0507/BKS', 'nama_kpad' => 'KOLOGAD'],
            ['wilayah_kodim' => 'WILAYAH KODIM 0507/BKS', 'nama_kpad' => 'PALAD'],
        ];

        foreach ($kpads as $i => $row) {
            Kpad::firstOrCreate(
                ['nama_kpad' => $row['nama_kpad']],
                [
                    'wilayah_kodim' => $row['wilayah_kodim'],
                    'urutan' => $i + 1,
                    'is_active' => true,
                ]
            );
        }

        $pangkats = [
            ['nama' => 'Jenderal TNI', 'kategori' => 'Militer'],
            ['nama' => 'Letnan Jenderal TNI', 'kategori' => 'Militer'],
            ['nama' => 'Mayor Jenderal TNI', 'kategori' => 'Militer'],
            ['nama' => 'Brigadir Jenderal TNI', 'kategori' => 'Militer'],
            ['nama' => 'Kolonel', 'kategori' => 'Militer'],
            ['nama' => 'Letnan Kolonel', 'kategori' => 'Militer'],
            ['nama' => 'Mayor', 'kategori' => 'Militer'],
            ['nama' => 'Kapten', 'kategori' => 'Militer'],
            ['nama' => 'Letnan Satu', 'kategori' => 'Militer'],
            ['nama' => 'Letnan Dua', 'kategori' => 'Militer'],
            ['nama' => 'Pembantu Letnan Satu', 'kategori' => 'Militer'],
            ['nama' => 'Pembantu Letnan Dua', 'kategori' => 'Militer'],
            ['nama' => 'Sersan Mayor', 'kategori' => 'Militer'],
            ['nama' => 'Sersan Kepala', 'kategori' => 'Militer'],
            ['nama' => 'Sersan Satu', 'kategori' => 'Militer'],
            ['nama' => 'Sersan Dua', 'kategori' => 'Militer'],
            ['nama' => 'Kopral Kepala', 'kategori' => 'Militer'],
            ['nama' => 'Kopral Satu', 'kategori' => 'Militer'],
            ['nama' => 'Kopral Dua', 'kategori' => 'Militer'],
            ['nama' => 'Prajurit Kepala', 'kategori' => 'Militer'],
            ['nama' => 'Prajurit Satu', 'kategori' => 'Militer'],
            ['nama' => 'Prajurit Dua', 'kategori' => 'Militer'],
            ['nama' => 'PNS IV/d', 'kategori' => 'PNS'],
            ['nama' => 'PNS IV/c', 'kategori' => 'PNS'],
            ['nama' => 'PNS IV/b', 'kategori' => 'PNS'],
            ['nama' => 'PNS IV/a', 'kategori' => 'PNS'],
            ['nama' => 'PNS III/d', 'kategori' => 'PNS'],
            ['nama' => 'PNS III/c', 'kategori' => 'PNS'],
            ['nama' => 'PNS III/b', 'kategori' => 'PNS'],
            ['nama' => 'PNS III/a', 'kategori' => 'PNS'],
            ['nama' => 'PNS II/d', 'kategori' => 'PNS'],
            ['nama' => 'PNS II/c', 'kategori' => 'PNS'],
            ['nama' => 'PNS II/b', 'kategori' => 'PNS'],
            ['nama' => 'PNS II/a', 'kategori' => 'PNS'],
            ['nama' => 'PNS I/d', 'kategori' => 'PNS'],
            ['nama' => 'PNS I/c', 'kategori' => 'PNS'],
            ['nama' => 'PNS I/b', 'kategori' => 'PNS'],
            ['nama' => 'PNS I/a', 'kategori' => 'PNS'],
            ['nama' => '-', 'kategori' => 'Lainnya'],
        ];

        foreach ($pangkats as $i => $row) {
            Pangkat::firstOrCreate(
                ['nama' => $row['nama']],
                [
                    'kategori' => $row['kategori'],
                    'urutan' => $i + 1,
                    'is_active' => true,
                ]
            );
        }

        $korps = [
            ['kode' => 'Inf', 'nama' => 'Infanteri'],
            ['kode' => 'Arh', 'nama' => 'Artileri Pertahanan Udara'],
            ['kode' => 'Arm', 'nama' => 'Artileri Medan'],
            ['kode' => 'Kav', 'nama' => 'Kavaleri'],
            ['kode' => 'Czi', 'nama' => 'Zeni'],
            ['kode' => 'Cke', 'nama' => 'Komunikasi dan Elektronika'],
            ['kode' => 'Cpl', 'nama' => 'Peralatan'],
            ['kode' => 'Cba', 'nama' => 'Pembekalan Angkutan'],
            ['kode' => 'Ckm', 'nama' => 'Kesehatan Militer'],
            ['kode' => 'Ctp', 'nama' => 'Topografi'],
            ['kode' => 'Cku', 'nama' => 'Keuangan'],
            ['kode' => 'Caj', 'nama' => 'Ajudan Jenderal'],
            ['kode' => 'Chk', 'nama' => 'Hukum'],
            ['kode' => 'Cpm', 'nama' => 'Polisi Militer'],
            ['kode' => 'Cpn', 'nama' => 'Penerbangan'],
            ['kode' => '-', 'nama' => 'Tidak Ada'],
        ];

        foreach ($korps as $i => $row) {
            Korps::firstOrCreate(
                ['kode' => $row['kode']],
                [
                    'nama' => $row['nama'],
                    'urutan' => $i + 1,
                    'is_active' => true,
                ]
            );
        }

        $statuses = [
            'AKTIF',
            'PURNAWIRAWAN',
            'WARAKAWURI',
            'WREDATAMA',
            'JANDA WREDATAMA',
            'DUDA WREDATAMA',
            'DUDA',
            '-',
        ];

        foreach ($statuses as $i => $nama) {
            StatusPenghuni::firstOrCreate(
                ['nama' => $nama],
                [
                    'urutan' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
