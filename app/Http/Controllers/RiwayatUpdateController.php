<?php

namespace App\Http\Controllers;

use App\Models\RiwayatUpdate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RiwayatUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = RiwayatUpdate::find($id);

        $namaPemilik = $data ? $data->Nama : 'Pemilik Tidak Diketahui';

        // Ukuran kertas F4: 210mm x 330mm (dalam satuan point: 595.28 x 935.43)
        $pdf = Pdf::loadView('surat-izin.cetak_surat', compact('data', 'namaPemilik'))
            ->setPaper([0, 0, 595.28, 935.43], 'portrait') // F4 portrait
            ->setOption(['isRemoteEnabled' => true]);

        return $pdf->stream('SIP_' . $namaPemilik . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suratIzin = RiwayatUpdate::find($id);
        return view('surat-izin.edit-history', compact('suratIzin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $riwayat = RiwayatUpdate::findOrFail($id);
        $data = $request->all();
        // dd($data);
        // Penyesuaian field Kpad jika 'Lainnya'
        if ($request->Kpad == 'Lainnya') {
            $data['Kpad'] = $request->KpadLainnya;
        } else {
            $data['Kpad'] = $request->Kpad;
        }

        // Penanganan upload foto jika ada
        if ($request->hasFile('Foto')) {
            $file = $request->file('Foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('foto', $namaFile, 'public');
            $data['Foto'] = $namaFile;
        } else {
            unset($data['Foto']);
        }

        $riwayat->update($data);

        return redirect()->route('surat-izin-history.edit', $id)->with('success', 'Data riwayat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $RiwayatUpdate = RiwayatUpdate::find($id);
        // dd($RiwayatUpdate);
        $RiwayatUpdate->delete();
        return redirect()->route('surat-izin.create')->with('success', 'History berhasil dihapus.');
    }
}
