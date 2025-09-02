<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
use App\Exports\PengajuanExportHistory;
use App\Models\RiwayatUpdate;
use App\Models\SuratIzin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SuratIzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratIzin::orrderBy('id', 'DESC')->get();
        return view('surat-izin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = SuratIzin::latest()->get();
        return view('surat-izin.create', compact('data'));
    }
    public function Datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = SuratIzin::orderBy('id', 'DESC');

            if ($request->filled('status')) {
                $query->where('Status', $request->status);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('surat-izin.edit', $row->id);
                    $deleteUrl = route('surat-izin.destroy', $row->id);
                    $printUrl = route('surat-izin.show', $row->id);

                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary mr-1">Edit</a>';
                    $btn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-sm btn-danger mr-1">Delete</button>';
                    $btn .= '</form>';
                    $btn .= '<a href="' . $printUrl . '" class="btn btn-sm btn-success" target="_blank">Print</a>';
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

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('surat-izin-history.edit', $row->id);
                    $deleteUrl = route('surat-izin-history.destroy', $row->id);
                    $printUrl = route('surat-izin-history.show', $row->id);

                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary mr-1">Edit</a>';
                    $btn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-sm btn-danger mr-1">Delete</button>';
                    $btn .= '</form>';
                    $btn .= '<a href="' . $printUrl . '" class="btn btn-sm btn-success" target="_blank">Print</a>';
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
        // Cek apakah No KTP sudah terdaftar
        $cekKtp = SuratIzin::where('Ktp', $request->Ktp)->first();
        if ($cekKtp) {
            return redirect()->back()->withInput()->with('error', 'Nomor KTP sudah terdaftar pada data Surat Izin lain.');
        }
        $data = $request->all();
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
    public function exportPdf()
    {
        $data = SuratIzin::get();
        $pdf = Pdf::loadView('surat-izin.laporan_pdf_sip', compact('data'))
            ->setPaper([0, 0, 935.43, 595.28], 'landscape'); // F4 landscape

        return $pdf->stream('surat-izin.laporan_pdf_sip');
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
        $suratIzin = SuratIzin::find($id);
        return view('surat-izin.edit', compact('suratIzin'));
    }
    public function exportExcel()
    {
        return Excel::download(new PengajuanExport, 'data-pengajuan.xlsx');
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
        $data = $request->all();
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

        foreach ($data[0] as $index => $row) {
            if ($index == 0) {
                continue;
            }

            SuratIzin::create([
                'NomorSIP' => $row[1],
                'Nama' => $row[2],
                'Pangkat' => $row[3],
                'Korps' => $row[4],
                'NRPNIP' => $row[5],
                'Jabatan' => $row[6],
                'Kesatuan' => $row[7],
                'Ktp' => $row[8],
                'Ttl' => $row[9],
                'Status' => $row[10],
                'JumlahTanggungan' => $row[11],
                'AnggotaKeluarga' => $row[12],
                'UntukMenempati' => $row[13],
                'Keterangan' => $row[14],
                'DigunakanSebagai' => $row[15],
                'Kpad' => $row[16],
                'AlamatRumah' => $row[17],
                'TypeLuas' => $row[18],
                'Tmt' => $row[19],
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
