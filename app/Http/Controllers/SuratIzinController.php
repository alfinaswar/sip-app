<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
use App\Exports\PengajuanExportHistory;
use App\Models\Korps;
use App\Models\Kpad;
use App\Models\Pangkat;
use App\Models\RiwayatUpdate;
use App\Models\StatusPenghuni;
use App\Models\SuratIzin;
use App\Services\SipPdfReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SuratIzinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sip.view|sip.create')->only(['create']);
        $this->middleware('permission:sip.view')->only(['index', 'show', 'Datatable', 'History']);
        $this->middleware('permission:sip.create')->only(['store']);
        $this->middleware('permission:sip.edit')->only(['edit', 'update']);
        $this->middleware('permission:sip.delete')->only(['destroy']);
        $this->middleware('permission:sip.export')->only(['exportExcel', 'exportPdf', 'exportExcelHistory', 'exportPdfHistory']);
        $this->middleware('permission:sip.import')->only(['importExcel']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratIzin::orderBy('id', 'DESC')->get();
        return view('surat-izin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pangkats = Pangkat::active()->get();
        $korpsList = Korps::active()->get();
        $statusList = StatusPenghuni::active()->get();
        $kpadGroups = Kpad::active()->get()->groupBy('wilayah_kodim');

        $filterStatusList = StatusPenghuni::orderBy('urutan')->orderBy('id')->get();
        $filterPangkats = Pangkat::orderBy('urutan')->orderBy('id')->get();
        $filterKorpsList = Korps::orderBy('urutan')->orderBy('id')->get();
        $filterKpadGroups = Kpad::orderBy('urutan')->orderBy('id')->get()->groupBy('wilayah_kodim');
        $filterWilayahList = $filterKpadGroups->keys();

        return view('surat-izin.create', compact(
            'pangkats',
            'korpsList',
            'statusList',
            'kpadGroups',
            'filterStatusList',
            'filterPangkats',
            'filterKorpsList',
            'filterKpadGroups',
            'filterWilayahList'
        ));
    }

    /**
     * Build shared filtered query for DataTables, Excel export, and PDF export.
     *
     * @return array{0: Builder, 1: array<int, string>}
     */
    private function buildFilteredQuery(Request $request): array
    {
        $query = DB::table('surat_izins');
        $activeFilters = [];

        if ($request->filled('wilayah_kodim')) {
            $wilayah = (string) $request->input('wilayah_kodim');
            $kpadNames = Kpad::where('wilayah_kodim', $wilayah)->pluck('nama_kpad');
            if ($kpadNames->isNotEmpty()) {
                $query->whereIn('Kpad', $kpadNames->all());
            } else {
                $query->whereRaw('1 = 0');
            }
            $activeFilters[] = 'Wilayah: ' . $wilayah;
        }

        if ($request->filled('kpad')) {
            $kpad = (string) $request->input('kpad');
            if ($kpad === '__LAINNYA__') {
                $masterKpads = Kpad::pluck('nama_kpad')->all();
                $query->whereNotNull('Kpad')
                    ->where('Kpad', '!=', '')
                    ->when(!empty($masterKpads), fn ($q) => $q->whereNotIn('Kpad', $masterKpads));
                $activeFilters[] = 'KPAD: Lainnya';
            } else {
                $query->where('Kpad', $kpad);
                $activeFilters[] = 'KPAD: ' . $kpad;
            }
        }

        if ($request->filled('status')) {
            $status = (string) $request->input('status');
            $query->where('Status', $status);
            $activeFilters[] = 'Status: ' . ($status === '-' ? 'Tidak Ada' : $status);
        }

        if ($request->filled('pangkat')) {
            $pangkat = (string) $request->input('pangkat');
            $query->where('Pangkat', $pangkat);
            $activeFilters[] = 'Pangkat: ' . ($pangkat === '-' ? 'Tidak Ada' : $pangkat);
        }

        if ($request->filled('korps')) {
            $korps = (string) $request->input('korps');
            $query->where('Korps', $korps);
            $activeFilters[] = 'Korps: ' . ($korps === '-' ? 'Tidak Ada' : $korps);
        }

        $search = $request->input('search');
        if (is_string($search) && trim($search) !== '') {
            $keyword = trim($search);
            $terms = preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY) ?: [];

            foreach ($terms as $term) {
                $like = '%' . mb_strtolower($term, 'UTF-8') . '%';
                $query->where(function (Builder $q) use ($like) {
                    $q->whereRaw('LOWER(Nama) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Pangkat) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Korps) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(NRPNIP) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Jabatan) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Kesatuan) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Ktp) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Ttl) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Status) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(JumlahTanggungan) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Kpad) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(AlamatRumah) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(TypeLuas) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(Tmt) LIKE ?', [$like]);
                });
            }

            $activeFilters[] = 'Cari: "' . $keyword . '"';
        }

        return [$query, $activeFilters];
    }

    public function Datatable(Request $request)
    {
        if ($request->ajax()) {
            [$query] = $this->buildFilteredQuery($request);
            $query->select([
                'id',
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
                'Kpad',
                'AlamatRumah',
                'TypeLuas',
                'Tmt',
            ])->orderBy('id', 'DESC');

            $user = $request->user();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $btn = '<div class="d-inline-flex align-items-center">';
                    if ($user && $user->can('sip.edit')) {
                        $editUrl = route('surat-izin.edit', $row->id);
                        $btn .= '<a href="' . $editUrl . '" class="btn btn-sm btn-warning mr-1" title="Edit"><i class="fas fa-edit"></i> Edit</a>';
                    }
                    if ($user && $user->can('sip.view')) {
                        $printUrl = route('surat-izin.show', $row->id);
                        $btn .= '<a href="' . $printUrl . '" class="btn btn-sm btn-success mr-1" target="_blank" title="Cetak"><i class="fas fa-print"></i> Print</a>';
                    }
                    if ($user && $user->can('sip.delete')) {
                        $deleteUrl = route('surat-izin.destroy', $row->id);
                        $btn .= '<form action="' . $deleteUrl . '" method="POST" class="d-inline m-0" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                        $btn .= csrf_field();
                        $btn .= method_field('DELETE');
                        $btn .= '<button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i> Delete</button>';
                        $btn .= '</form>';
                    }
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function History(Request $request)
    {
        if ($request->ajax()) {
            // Urutkan dari data terbaru
            $query = RiwayatUpdate::orderBy('id', 'DESC');

            if ($request->filled('status')) {
                $query->where('Status', $request->status);
            }

            $user = $request->user();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $btn = '';
                    if ($user && $user->can('sip.edit')) {
                        $editUrl = route('surat-izin-history.edit', $row->id);
                        $btn .= '<a href="' . $editUrl . '" class="btn btn-sm btn-primary mr-1">Edit</a>';
                    }
                    if ($user && $user->can('sip.delete')) {
                        $deleteUrl = route('surat-izin-history.destroy', $row->id);
                        $btn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                        $btn .= csrf_field();
                        $btn .= method_field('DELETE');
                        $btn .= '<button type="submit" class="btn btn-sm btn-danger mr-1">Delete</button>';
                        $btn .= '</form>';
                    }
                    if ($user && $user->can('sip.view')) {
                        $printUrl = route('surat-izin-history.show', $row->id);
                        $btn .= '<a href="' . $printUrl . '" class="btn btn-sm btn-success" target="_blank">Print</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function updatepassword(Request $request)
    {
        return view('surat-izin.update-password');
    }
    public function simpanpassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = auth()->user();

        // Cek password lama
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        // Update password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TanggalDibuat' => 'nullable|date',
            'MasaBerlaku' => 'nullable|integer|min:1|max:5',
        ]);

        // Cek apakah No KTP sudah terdaftar
        $cekKtp = SuratIzin::where('Ktp', $request->Ktp)->first();
        if ($cekKtp) {
            return redirect()->back()->withInput()->with('error', 'Nomor KTP sudah terdaftar pada data Surat Izin lain.');
        }
        $data = $request->all();
        $data['TanggalDibuat'] = $validated['TanggalDibuat'] ?? null;
        $data['MasaBerlaku'] = (int) ($validated['MasaBerlaku'] ?? 1);
        if ($request->Kpad == 'Lainnya') {
            $data['Kpad'] = $request->KpadLainnya;
        } else {
            $data['Kpad'] = $request->Kpad;
        }

        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('foto', $namaFile, 'public');
            $data['Foto'] = $namaFile;
        }
        SuratIzin::create($data);
        return redirect()->back()->with('success', 'Surat Izin Berhasil Disimpan');
    }

    /**
    /**
     * Menampilkan resource yang dipilih.
     * Ukuran kertas: F4 (210mm x 330mm)
     */
    public function show($id)
    {
        $data = SuratIzin::find($id);

        $namaPemilik = $data ? $data->Nama : 'Pemilik Tidak Diketahui';

        // Ukuran kertas F4: 210mm x 330mm (dalam satuan point: 595.28 x 935.43)
        $pdf = Pdf::loadView('surat-izin.cetak_surat', compact('data', 'namaPemilik'))
            ->setPaper([0, 0, 595.28, 935.43], 'portrait') // F4 portrait
            ->setOption(['isRemoteEnabled' => true]);

        return $pdf->stream('SIP_' . $namaPemilik . '.pdf');
    }
    public function exportPdf(Request $request, SipPdfReport $pdfReport)
    {
        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        [$query, $activeFilters] = $this->buildFilteredQuery($request);
        $binary = $pdfReport->generate($query->select(PengajuanExport::EXPORT_COLUMNS), $activeFilters);
        $filename = 'data-pengajuan-sip-' . date('Ymd-His') . '.pdf';

        return response($binary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
    public function exportPdfHistory()
    {
        $data = RiwayatUpdate::get();
        $pdf = Pdf::loadView('surat-izin.laporan_pdf_sip', compact('data'))
            ->setPaper([0, 0, 935.43, 595.28], 'landscape'); // F4 landscape

        return $pdf->stream('surat-izin.laporan_pdf_sip');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suratIzin = SuratIzin::findOrFail($id);
        $pangkats = Pangkat::active()->get();
        $korpsList = Korps::active()->get();
        $statusList = StatusPenghuni::active()->get();
        $kpadGroups = Kpad::active()->get()->groupBy('wilayah_kodim');

        return view('surat-izin.edit', compact(
            'suratIzin',
            'pangkats',
            'korpsList',
            'statusList',
            'kpadGroups'
        ));
    }
    public function exportExcel(Request $request)
    {
        @set_time_limit(0);
        @ini_set('memory_limit', '512M');

        [$query, $activeFilters] = $this->buildFilteredQuery($request);
        $filename = 'data-pengajuan-sip-' . date('Ymd-His') . '.xlsx';

        return Excel::download(new PengajuanExport($query, $activeFilters), $filename);
    }
    public function exportExcelHistory()
    {
        return Excel::download(new PengajuanExportHistory, 'data-pengajuan.xlsx');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'TanggalDibuat' => 'nullable|date',
            'MasaBerlaku' => 'nullable|integer|min:1|max:5',
        ]);

        $data = $request->all();
        $data['TanggalDibuat'] = $validated['TanggalDibuat'] ?? null;
        $data['MasaBerlaku'] = (int) ($validated['MasaBerlaku'] ?? 1);
        if ($request->Kpad == 'Lainnya') {
            $data['Kpad'] = $request->KpadLainnya;
        } else {
            $data['Kpad'] = $request->Kpad;
        }
        $suratIzin = SuratIzin::findOrFail($id);

        // Simpan data lama ke history sebelum update
        $dataLama = $suratIzin->toArray();
        $dataLama['IdSurat'] = $id;
        RiwayatUpdate::create($dataLama);

        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('foto', $namaFile, 'public');
            $data['Foto'] = $namaFile;
        } else {
            unset($data['Foto']);
        }

        $suratIzin->update($data);

        return redirect()->route('surat-izin.create')->with('success', 'Surat Izin Berhasil Diperbarui');
    }
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);

        $data = Excel::toArray([], $request->file('file'));
        $rows = $data[0] ?? [];

        $headerRowIndex = 0;
        foreach ($rows as $index => $row) {
            $colA = strtolower(trim((string) ($row[0] ?? '')));
            $colB = strtolower(trim((string) ($row[1] ?? '')));
            if ($colA === 'no' && str_contains($colB, 'nomor sip')) {
                $headerRowIndex = $index;
                break;
            }
        }

        foreach ($rows as $index => $row) {
            if ($index <= $headerRowIndex) {
                continue;
            }
            if (empty(array_filter($row, fn ($v) => $v !== null && trim((string) $v) !== ''))) {
                continue;
            }

            SuratIzin::create([
                'NomorSIP' => $row[1] ?? null,
                'Nama' => $row[2] ?? null,
                'Pangkat' => $row[3] ?? null,
                'Korps' => $row[4] ?? null,
                'NRPNIP' => $row[5] ?? null,
                'Jabatan' => $row[6] ?? null,
                'Kesatuan' => $row[7] ?? null,
                'Ktp' => $row[8] ?? null,
                'Ttl' => $row[9] ?? null,
                'Status' => $row[10] ?? null,
                'JumlahTanggungan' => $row[11] ?? null,
                'AnggotaKeluarga' => $row[12] ?? null,
                'UntukMenempati' => $row[13] ?? null,
                'Keterangan' => $row[14] ?? null,
                'DigunakanSebagai' => $row[15] ?? null,
                'Kpad' => $row[16] ?? null,
                'AlamatRumah' => $row[17] ?? null,
                'TypeLuas' => $row[18] ?? null,
                'Tmt' => $row[19] ?? null,
            ]);
        }

        return back()->with('success', 'Data berhasil diimport!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratIzin $suratIzin)
    {

        $suratIzin->delete();

        return redirect()->route('surat-izin.create')->with('success', 'Surat Izin berhasil dihapus.');
    }
}
