<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSpmb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanSpmbController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanSpmb::first();
        return view('admin.spmb.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|string|max:20',
            'persyaratan' => 'nullable|array',
            'persyaratan.*' => 'nullable|string|max:500',
            'brosur' => 'nullable|file|mimes:pdf|max:5120',
            'whatsapp' => 'nullable|string|max:60',
        ]);

        $pengaturan = PengaturanSpmb::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanSpmb();
        }

        $pengaturan->tahun = $request->tahun;
        $pengaturan->persyaratan = $request->persyaratan;
        $pengaturan->whatsapp = $request->whatsapp;

        if ($request->hasFile('brosur')) {
            if ($pengaturan->brosur) {
                Storage::disk('public')->delete($pengaturan->brosur);
            }
            $path = $request->file('brosur')->store('spmb', 'public');
            $pengaturan->brosur = $path;
        }

        $pengaturan->save();

        return redirect()->route('admin.spmb.index')
            ->with('success', 'Pengaturan SPMB berhasil diperbarui.');
    }

    public function destroyBrosur()
    {
        $pengaturan = PengaturanSpmb::first();
        if ($pengaturan && $pengaturan->brosur) {
            Storage::disk('public')->delete($pengaturan->brosur);
            $pengaturan->brosur = null;
            $pengaturan->save();
        }

        return back()->with('success', 'Brosur berhasil dihapus.');
    }
}
