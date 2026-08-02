<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakSpmb;
use Illuminate\Http\Request;

class KontakSpmbController extends Controller
{
    public function create()
    {
        return view('admin.kontak-spmb.form', [
            'editMode' => false,
            'jenisOptions' => KontakSpmb::jenisOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        KontakSpmb::create($data);

        return redirect()->route('admin.spmb.index')
            ->with('success', 'Kontak SPMB berhasil ditambahkan.');
    }

    public function edit(KontakSpmb $kontak_spmb)
    {
        return view('admin.kontak-spmb.form', [
            'editMode' => true,
            'kontak' => $kontak_spmb,
            'jenisOptions' => KontakSpmb::jenisOptions(),
        ]);
    }

    public function update(Request $request, KontakSpmb $kontak_spmb)
    {
        $data = $this->validated($request);

        $kontak_spmb->update($data);

        return redirect()->route('admin.spmb.index')
            ->with('success', 'Kontak SPMB berhasil diperbarui.');
    }

    public function destroy(KontakSpmb $kontak_spmb)
    {
        $kontak_spmb->delete();

        return redirect()->route('admin.spmb.index')
            ->with('success', 'Kontak SPMB berhasil dihapus.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:' . implode(',', array_keys(KontakSpmb::jenisOptions())),
            'nilai' => 'required|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'aktif' => 'nullable|boolean',
        ]) + ['aktif' => $request->boolean('aktif')];
    }
}
