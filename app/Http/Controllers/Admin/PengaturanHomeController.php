<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanHomeController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanHome::first();
        return view('admin.pengaturan-home.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kepala_sekolah_nama' => 'nullable|string|max:255',
            'kepala_sekolah_jabatan' => 'nullable|string|max:255',
            'kepala_sekolah_sambutan' => 'nullable|string',
            'hero_background_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'kepala_sekolah_foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'kepala_sekolah_pengalaman_angka' => 'nullable|string|max:50',
            'kepala_sekolah_pengalaman_label' => 'nullable|string|max:255',
        ]);

        $pengaturan = PengaturanHome::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanHome();
        }

        $pengaturan->kepala_sekolah_nama = $request->kepala_sekolah_nama;
        $pengaturan->kepala_sekolah_jabatan = $request->kepala_sekolah_jabatan;
        $pengaturan->kepala_sekolah_sambutan = $request->kepala_sekolah_sambutan;
        $pengaturan->kepala_sekolah_pengalaman_angka = $request->kepala_sekolah_pengalaman_angka;
        $pengaturan->kepala_sekolah_pengalaman_label = $request->kepala_sekolah_pengalaman_label;

        if ($request->hasFile('hero_background_foto')) {
            if ($pengaturan->hero_background_foto) {
                Storage::disk('public')->delete($pengaturan->hero_background_foto);
            }
            $heroPath = $request->file('hero_background_foto')->store('pengaturan-home/hero', 'public');
            $pengaturan->hero_background_foto = $heroPath;
        }

        if ($request->hasFile('kepala_sekolah_foto')) {
            // Hapus foto lama
            if ($pengaturan->kepala_sekolah_foto) {
                Storage::disk('public')->delete($pengaturan->kepala_sekolah_foto);
            }
            $path = $request->file('kepala_sekolah_foto')->store('pengaturan-home', 'public');
            $pengaturan->kepala_sekolah_foto = $path;
        }

        $pengaturan->save();

        return redirect()->route('admin.pengaturan-home.index')
            ->with('success', 'Pengaturan halaman utama berhasil diperbarui.');
    }

    public function destroyFoto()
    {
        $pengaturan = PengaturanHome::first();
        if ($pengaturan && $pengaturan->kepala_sekolah_foto) {
            Storage::disk('public')->delete($pengaturan->kepala_sekolah_foto);
            $pengaturan->kepala_sekolah_foto = null;
            $pengaturan->save();
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
