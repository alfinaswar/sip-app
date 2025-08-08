<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
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
        $data = SuratIzin::latest()->get();
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
            $query = SuratIzin::query();

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
            $query = RiwayatUpdate::query();

            if ($request->filled('status')) {
                $query->where('Status', $request->status);
            }

            return DataTables::of($query)
                ->addIndexColumn()
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
        $data = $request->all();

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
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = SuratIzin::find($id);

        $namaPemilik = $data ? $data->Nama : 'Pemilik Tidak Diketahui';

        // Ukuran kertas F4: 210mm x 330mm
        $pdf = Pdf::loadView('surat-izin.cetak_surat', compact('data', 'namaPemilik'))
            ->setPaper([0, 0, 595.28, 935.43], 'portrait') // ukuran F4 dalam satuan point
            ->setOption(['isRemoteEnabled' => true]); // remote enabled ditambahkan

        return $pdf->stream('SIP_' . $namaPemilik . '.pdf');
    }
    public function exportPdf()
    {
        $data = SuratIzin::get();
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $suratIzin = SuratIzin::findOrFail($id);

        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('foto', $namaFile, 'public');
            $data['Foto'] = $namaFile;
        } else {
            unset($data['Foto']);
        }

        $suratIzin->update($data);
        $data['IdSurat'] = $id;
        RiwayatUpdate::create($data);
        return redirect()->back()->with('success', 'Surat Izin Berhasil Diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratIzin $suratIzin)
    {
        //
    }
}
