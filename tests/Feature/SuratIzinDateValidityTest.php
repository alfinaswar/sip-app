<?php

namespace Tests\Feature;

use App\Models\RiwayatUpdate;
use App\Models\SuratIzin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SuratIzinDateValidityTest extends TestCase
{
    use DatabaseTransactions;

    private function actingAsAdmin(): User
    {
        $user = User::whereHas('roles', fn ($q) => $q->where('name', 'Super Admin'))->first();
        if (!$user) {
            $this->markTestSkipped('Seeded Super Admin user is required.');
        }

        $this->actingAs($user);

        return $user;
    }

    public function test_store_and_print_use_custom_tanggal_dibuat_and_masa_berlaku(): void
    {
        $this->actingAsAdmin();

        $ktp = 'TEST-KTP-' . uniqid();
        $resp = $this->post(route('surat-izin.store'), [
            'Nama' => 'Uji Tanggal Terbit',
            'Ktp' => $ktp,
            'Kpad' => 'KWINI',
            'AnggotaKeluarga' => [['nama' => null, 'umur' => null, 'jk' => null, 'hubungan' => null]],
            'TanggalDibuat' => '2026-03-15',
            'MasaBerlaku' => 4,
        ]);

        $resp->assertRedirect();
        $resp->assertSessionHas('success');

        $surat = SuratIzin::where('Ktp', $ktp)->firstOrFail();
        $this->assertSame('2026-03-15', $surat->TanggalDibuat);
        $this->assertSame(4, (int) $surat->MasaBerlaku);

        $html = view('surat-izin.cetak_surat', [
            'data' => $surat,
            'namaPemilik' => $surat->Nama,
        ])->render();

        $this->assertStringContainsString('15 Maret 2026', $html);
        $this->assertStringContainsString('15 Maret 2030', $html);

        $pdfResp = $this->get(route('surat-izin.show', $surat->id));
        $pdfResp->assertStatus(200);
        $pdfResp->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $pdfResp->getContent());
    }

    public function test_update_preserves_history_snapshot_and_updates_history_record(): void
    {
        $this->actingAsAdmin();

        $surat = SuratIzin::create([
            'Nama' => 'Uji History Tanggal',
            'Ktp' => 'TEST-HIST-' . uniqid(),
            'Kpad' => 'KWINI',
            'AnggotaKeluarga' => [['nama' => null, 'umur' => null, 'jk' => null, 'hubungan' => null]],
            'TanggalDibuat' => '2025-05-10',
            'MasaBerlaku' => 2,
        ]);

        $updateResp = $this->put(route('surat-izin.update', $surat->id), [
            'Nama' => 'Uji History Tanggal Baru',
            'Ktp' => $surat->Ktp,
            'Kpad' => 'KWINI',
            'AnggotaKeluarga' => [['nama' => null, 'umur' => null, 'jk' => null, 'hubungan' => null]],
            'TanggalDibuat' => '2026-08-20',
            'MasaBerlaku' => 5,
        ]);
        $updateResp->assertRedirect(route('surat-izin.create'));

        $surat->refresh();
        $this->assertSame('2026-08-20', $surat->TanggalDibuat);
        $this->assertSame(5, (int) $surat->MasaBerlaku);

        $history = RiwayatUpdate::where('IdSurat', $surat->id)->latest('id')->firstOrFail();
        $this->assertSame('2025-05-10', $history->TanggalDibuat);
        $this->assertSame(2, (int) $history->MasaBerlaku);

        $histEditResp = $this->get(route('surat-izin-history.edit', $history->id));
        $histEditResp->assertStatus(200);
        $histEditResp->assertSee('value="2025-05-10"', false);

        $histUpdateResp = $this->put(route('surat-izin-history.update', $history->id), [
            'Nama' => 'Uji History Diedit',
            'Kpad' => 'KWINI',
            'TanggalDibuat' => '2024-01-05',
            'MasaBerlaku' => 3,
        ]);
        $histUpdateResp->assertRedirect(route('surat-izin-history.edit', $history->id));

        $history->refresh();
        $this->assertSame('2024-01-05', $history->TanggalDibuat);
        $this->assertSame(3, (int) $history->MasaBerlaku);

        $histHtml = view('surat-izin.cetak_surat', [
            'data' => $history,
            'namaPemilik' => $history->Nama,
        ])->render();
        $this->assertStringContainsString('05 Januari 2024', $histHtml);
        $this->assertStringContainsString('05 Januari 2027', $histHtml);

        $histPdfResp = $this->get(route('surat-izin-history.show', $history->id));
        $histPdfResp->assertStatus(200);
        $this->assertStringStartsWith('%PDF-', $histPdfResp->getContent());
    }

    public function test_legacy_record_without_tanggal_dibuat_falls_back_to_created_at_and_one_year(): void
    {
        $surat = new SuratIzin([
            'Nama' => 'Data Lama',
            'AnggotaKeluarga' => [['nama' => null, 'umur' => null, 'jk' => null, 'hubungan' => null]],
            'TanggalDibuat' => null,
            'MasaBerlaku' => null,
        ]);
        $surat->created_at = '2024-06-11 08:00:00';

        $html = view('surat-izin.cetak_surat', [
            'data' => $surat,
            'namaPemilik' => 'Data Lama',
        ])->render();

        $this->assertStringContainsString('11 Juni 2024', $html);
        $this->assertStringContainsString('11 Juni 2025', $html);
    }

    public function test_validation_rejects_invalid_date_and_out_of_range_masa_berlaku(): void
    {
        $this->actingAsAdmin();

        $resp = $this->post(route('surat-izin.store'), [
            'Nama' => 'Invalid Input',
            'Ktp' => 'TEST-INV-' . uniqid(),
            'TanggalDibuat' => 'bukan-tanggal',
            'MasaBerlaku' => 6,
        ]);

        $resp->assertSessionHasErrors(['TanggalDibuat', 'MasaBerlaku']);
    }

    public function test_forms_render_tanggal_dibuat_and_masa_berlaku_options(): void
    {
        $this->actingAsAdmin();

        $createResp = $this->get(route('surat-izin.create'));
        $createResp->assertStatus(200);
        $createResp->assertSee('name="TanggalDibuat"', false);
        $createResp->assertSee('name="MasaBerlaku"', false);
        for ($i = 1; $i <= 5; $i++) {
            $createResp->assertSee($i . ' Tahun');
        }

        $surat = SuratIzin::create([
            'Nama' => 'Form Edit Check',
            'Ktp' => 'TEST-EDIT-' . uniqid(),
            'TanggalDibuat' => '2026-04-01',
            'MasaBerlaku' => 3,
        ]);

        $editResp = $this->get(route('surat-izin.edit', $surat->id));
        $editResp->assertStatus(200);
        $editResp->assertSee('value="2026-04-01"', false);
        $editResp->assertSee('<option value="3" selected>', false);
    }
}
