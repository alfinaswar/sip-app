<?php

namespace App\Http\Controllers;

use App\Models\Korps;
use App\Models\Kpad;
use App\Models\Pangkat;
use App\Models\StatusPenghuni;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MasterDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:master-data.view|master-data.manage')->only(['index']);
        $this->middleware('permission:master-data.manage')->only(['store', 'update', 'destroy']);
    }

    private function resolveModel(string $tab): string
    {
        return match ($tab) {
            'kpad' => Kpad::class,
            'pangkat' => Pangkat::class,
            'korps' => Korps::class,
            'status' => StatusPenghuni::class,
            default => abort(404),
        };
    }

    public function index(Request $request, string $tab = 'kpad')
    {
        $modelClass = $this->resolveModel($tab);

        $items = $modelClass::orderBy('urutan')->orderBy('id')->get();
        $editItem = $request->filled('edit') ? $modelClass::find($request->edit) : null;

        $counts = [
            'kpad' => Kpad::count(),
            'pangkat' => Pangkat::count(),
            'korps' => Korps::count(),
            'status' => StatusPenghuni::count(),
        ];

        $wilayahList = $tab === 'kpad'
            ? Kpad::select('wilayah_kodim')->distinct()->orderBy('wilayah_kodim')->pluck('wilayah_kodim')
            : collect();

        return view('master-data.index', [
            'activeTab' => $tab,
            'items' => $items,
            'editItem' => $editItem,
            'counts' => $counts,
            'wilayahList' => $wilayahList,
        ]);
    }

    public function store(Request $request, string $tab)
    {
        $modelClass = $this->resolveModel($tab);
        $validated = $this->validateTab($request, $tab);
        $validated['urutan'] = $validated['urutan'] ?? ((int) $modelClass::max('urutan') + 1);
        $validated['is_active'] = $request->boolean('is_active');

        $modelClass::create($validated);

        return redirect()->route('master-data.index', $tab)
            ->with('success', 'Data master berhasil ditambahkan.');
    }

    public function update(Request $request, string $tab, int $id)
    {
        $modelClass = $this->resolveModel($tab);
        $item = $modelClass::findOrFail($id);

        $validated = $this->validateTab($request, $tab, $id);
        $validated['urutan'] = $validated['urutan'] ?? $item->urutan;
        $validated['is_active'] = $request->boolean('is_active');

        $item->update($validated);

        return redirect()->route('master-data.index', $tab)
            ->with('success', 'Data master berhasil diperbarui.');
    }

    public function destroy(string $tab, int $id)
    {
        $modelClass = $this->resolveModel($tab);
        $item = $modelClass::findOrFail($id);
        $item->delete();

        return redirect()->route('master-data.index', $tab)
            ->with('success', 'Data master berhasil dihapus.');
    }

    private function validateTab(Request $request, string $tab, ?int $ignoreId = null): array
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar.',
            'max' => ':attribute maksimal :max karakter.',
            'integer' => ':attribute harus berupa angka.',
            'min' => ':attribute minimal :min.',
        ];

        return match ($tab) {
            'kpad' => $request->validate([
                'wilayah_kodim' => ['required', 'string', 'max:100'],
                'nama_kpad' => ['required', 'string', 'max:150', Rule::unique('kpads', 'nama_kpad')->ignore($ignoreId)],
                'urutan' => ['nullable', 'integer', 'min:0'],
            ], $messages, [
                'wilayah_kodim' => 'Wilayah Kodim',
                'nama_kpad' => 'Nama KPAD',
                'urutan' => 'Urutan',
            ]),
            'pangkat' => $request->validate([
                'nama' => ['required', 'string', 'max:100', Rule::unique('pangkats', 'nama')->ignore($ignoreId)],
                'kategori' => ['required', Rule::in(['Militer', 'PNS', 'Lainnya'])],
                'urutan' => ['nullable', 'integer', 'min:0'],
            ], $messages, [
                'nama' => 'Nama Pangkat',
                'kategori' => 'Kategori',
                'urutan' => 'Urutan',
            ]),
            'korps' => $request->validate([
                'kode' => ['required', 'string', 'max:30', Rule::unique('korps', 'kode')->ignore($ignoreId)],
                'nama' => ['nullable', 'string', 'max:100'],
                'urutan' => ['nullable', 'integer', 'min:0'],
            ], $messages, [
                'kode' => 'Kode Korps',
                'nama' => 'Keterangan Korps',
                'urutan' => 'Urutan',
            ]),
            'status' => $request->validate([
                'nama' => ['required', 'string', 'max:100', Rule::unique('status_penghunis', 'nama')->ignore($ignoreId)],
                'urutan' => ['nullable', 'integer', 'min:0'],
            ], $messages, [
                'nama' => 'Nama Status',
                'urutan' => 'Urutan',
            ]),
        };
    }
}
