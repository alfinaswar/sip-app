<?php

namespace Tests\Feature;

use App\Exports\PengajuanExport;
use App\Models\SuratIzin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tests\TestCase;

class ExportReportTest extends TestCase
{
    use DatabaseTransactions;

    private function actingAsExporter(): User
    {
        $user = User::whereHas('roles', fn ($q) => $q->where('name', 'Super Admin'))->first();
        if (!$user) {
            $this->markTestSkipped('Seeded Super Admin user is required.');
        }

        $this->actingAs($user);

        return $user;
    }

    public function test_excel_export_renders_kop_header_styles_and_empty_state(): void
    {
        $this->actingAsExporter();

        $response = $this->get(route('exportExcel', ['kpad' => '__TIDAK_ADA__']));
        $response->assertStatus(200);

        $filePath = $response->baseResponse->getFile()->getPathname();
        $sheet = IOFactory::load($filePath)->getActiveSheet();

        $this->assertSame('TNI ANGKATAN DARAT  —  KODAM JAYA / JAYAKARTA', $sheet->getCell('A1')->getValue());
        $this->assertSame('DAFTAR PENGHUNIAN RUMAH DINAS (SIP) - KPAD', $sheet->getCell('A2')->getValue());
        $this->assertStringContainsString('Filter: KPAD: __TIDAK_ADA__', (string) $sheet->getCell('A3')->getValue());
        $this->assertStringContainsString('Total Data: 0', (string) $sheet->getCell('A3')->getValue());
        $this->assertSame('No', $sheet->getCell('A5')->getValue());
        $this->assertSame('TMT', $sheet->getCell('T5')->getValue());
        $this->assertSame(5, $sheet->getHighestRow());
        $this->assertSame('A6', $sheet->getFreezePane());
        $this->assertSame('A5:T5', $sheet->getAutoFilter()->getRange());
        $this->assertContains('A1:T1', $sheet->getMergeCells());
        $this->assertContains('A2:T2', $sheet->getMergeCells());
        $this->assertContains('A3:T3', $sheet->getMergeCells());

        $sampleKpad = DB::table('surat_izins')->whereNotNull('Kpad')->value('Kpad');
        if ($sampleKpad) {
            $dataResp = $this->get(route('exportExcel', ['kpad' => $sampleKpad]));
            $dataResp->assertStatus(200);
            $dataSheet = IOFactory::load($dataResp->baseResponse->getFile()->getPathname())->getActiveSheet();
            $this->assertGreaterThanOrEqual(6, $dataSheet->getHighestRow());
            $this->assertSame(1, (int) $dataSheet->getCell('A6')->getValue());
        }
    }

    public function test_pdf_export_streams_valid_pdf_for_filtered_and_empty_queries(): void
    {
        $this->actingAsExporter();

        $emptyResp = $this->get(route('exportPdf', ['kpad' => '__TIDAK_ADA__']));
        $emptyResp->assertStatus(200);
        $emptyResp->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $emptyResp->getContent());

        $sampleKpad = DB::table('surat_izins')->whereNotNull('Kpad')->value('Kpad');
        if ($sampleKpad) {
            $dataResp = $this->get(route('exportPdf', ['kpad' => $sampleKpad]));
            $dataResp->assertStatus(200);
            $dataResp->assertHeader('Content-Type', 'application/pdf');
            $this->assertStringStartsWith('%PDF-', $dataResp->getContent());
        }
    }

    public function test_import_excel_skips_report_kop_and_imports_from_data_row(): void
    {
        $this->actingAsExporter();

        $marker = 'TEST-SIP-KOP-' . uniqid();
        $sourceId = DB::table('surat_izins')->insertGetId([
            'NomorSIP' => $marker,
            'Nama' => 'Uji Kop Header',
            'Pangkat' => 'Mayor',
            'Korps' => 'Czi',
            'NRPNIP' => '11000011223344',
            'Kpad' => 'KWINI',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $query = DB::table('surat_izins')
            ->select(PengajuanExport::EXPORT_COLUMNS)
            ->where('id', $sourceId);

        $tmpXlsx = tempnam(sys_get_temp_dir(), 'sip_export_') . '.xlsx';
        file_put_contents($tmpXlsx, Excel::raw(new PengajuanExport($query, ['KPAD: KWINI']), \Maatwebsite\Excel\Excel::XLSX));

        $beforeCount = SuratIzin::count();
        $upload = new UploadedFile($tmpXlsx, 'export.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);

        try {
            $resp = $this->post(route('importExcel'), ['file' => $upload]);
            $resp->assertRedirect();
            $resp->assertSessionHas('success');

            $this->assertSame($beforeCount + 1, SuratIzin::count());
            $this->assertSame(2, SuratIzin::where('NomorSIP', $marker)->count());
            $this->assertSame(0, SuratIzin::where('NomorSIP', 'Nomor SIP')->count());
        } finally {
            @unlink($tmpXlsx);
        }
    }

    public function test_excel_export_matches_datatable_multi_term_search(): void
    {
        $this->actingAsExporter();

        $uniqueTag = 'UNIK' . uniqid();
        DB::table('surat_izins')->insert([
            'NomorSIP' => 'SIP-' . $uniqueTag,
            'Nama' => 'Budi ' . $uniqueTag,
            'Pangkat' => 'Mayor',
            'Korps' => 'Czi',
            'Kpad' => 'KWINI',
            'Status' => 'AKTIF',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $searchTerm = 'mayor ' . strtolower($uniqueTag);

        $columns = collect([
            'Nama', 'Pangkat', 'Korps', 'NRPNIP', 'Jabatan', 'Kesatuan',
            'Ktp', 'Ttl', 'Status', 'JumlahTanggungan', 'Kpad', 'AlamatRumah', 'TypeLuas', 'Tmt',
        ])->map(fn ($col) => [
            'data' => $col,
            'name' => $col,
            'searchable' => 'true',
            'orderable' => 'true',
            'search' => ['value' => '', 'regex' => 'false'],
        ])->all();

        $dtResp = $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])
            ->getJson(route('datatable', [
                'draw' => 1,
                'start' => 0,
                'length' => 10,
                'search' => ['value' => $searchTerm, 'regex' => 'false'],
                'columns' => $columns,
            ]));
        $dtResp->assertStatus(200);
        $this->assertSame(1, $dtResp->json('recordsFiltered'));

        $exResp = $this->get(route('exportExcel', ['search' => $searchTerm]));
        $exResp->assertStatus(200);

        $sheet = IOFactory::load($exResp->baseResponse->getFile()->getPathname())->getActiveSheet();
        $this->assertSame(6, $sheet->getHighestRow());
        $this->assertSame('Budi ' . $uniqueTag, $sheet->getCell('C6')->getValue());
    }
}
