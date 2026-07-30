<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        return view('admin.profil-sekolah.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sejarah' => 'nullable|string',
            'sejarah_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'struktur_organisasi_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'timeline' => 'nullable|array',
            'timeline.*.tahun' => 'nullable|string|max:20',
            'timeline.*.judul' => 'nullable|string|max:255',
            'timeline.*.deskripsi' => 'nullable|string',
            'timeline.*.icon' => 'nullable|string|max:100',
            'nilai' => 'nullable|array',
            'nilai.*.icon' => 'nullable|string|max:100',
            'nilai.*.judul' => 'nullable|string|max:255',
            'nilai.*.deskripsi' => 'nullable|string|max:255',
            'struktur_organisasi' => 'nullable|array',
            'struktur_organisasi.*.jabatan' => 'nullable|string|max:255',
            'struktur_organisasi.*.nama' => 'nullable|string|max:255',
            'struktur_organisasi.*.icon' => 'nullable|string|max:100',
            'struktur_organisasi.*.foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'struktur_organisasi.*.hapus_foto' => 'nullable|boolean',
            'struktur_organisasi.*.is_kepsek' => 'nullable|boolean',
            'struktur_organisasi.*.level' => 'nullable|integer|min:1|max:10',
        ]);

        $profil = ProfilSekolah::first();
        if (!$profil) {
            $profil = new ProfilSekolah();
        }

        $profil->sejarah = $request->sejarah;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->timeline = $request->timeline;
        $profil->nilai = $request->nilai;

        // Proses struktur organisasi dengan upload foto
        $strukturData = $request->struktur_organisasi ?? [];
        if (is_array($strukturData)) {
            foreach ($strukturData as $key => &$item) {
                // Handle upload foto
                if ($request->hasFile("struktur_organisasi.{$key}.foto")) {
                    // Hapus foto lama jika ada
                    if (!empty($item['foto_lama'])) {
                        Storage::disk('public')->delete($item['foto_lama']);
                    }
                    $item['foto'] = $request->file("struktur_organisasi.{$key}.foto")->store('struktur-organisasi', 'public');
                } else {
                    // Jika tidak upload baru, pertahankan foto lama
                    if (!empty($item['foto_lama']) && empty($item['hapus_foto'])) {
                        $item['foto'] = $item['foto_lama'];
                    } elseif (!empty($item['hapus_foto'])) {
                        // Hapus foto
                        if (!empty($item['foto_lama'])) {
                            Storage::disk('public')->delete($item['foto_lama']);
                        }
                        $item['foto'] = null;
                    }
                }
                // Hapus field bantu
                unset($item['foto_lama'], $item['hapus_foto']);
            }
        }
        $profil->struktur_organisasi = $strukturData;

        // Upload sejarah_gambar
        if ($request->hasFile('sejarah_gambar')) {
            if ($profil->sejarah_gambar) {
                Storage::disk('public')->delete($profil->sejarah_gambar);
            }
            $profil->sejarah_gambar = $request->file('sejarah_gambar')->store('profil-sekolah', 'public');
        }

        // Upload struktur_organisasi_gambar
        if ($request->hasFile('struktur_organisasi_gambar')) {
            if ($profil->struktur_organisasi_gambar) {
                Storage::disk('public')->delete($profil->struktur_organisasi_gambar);
            }
            $profil->struktur_organisasi_gambar = $request->file('struktur_organisasi_gambar')->store('profil-sekolah', 'public');
        }

        $profil->save();

        return redirect()->route('admin.profil-sekolah.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function destroyGambar($jenis)
    {
        $profil = ProfilSekolah::first();
        if (!$profil) {
            return back()->with('error', 'Data profil tidak ditemukan.');
        }

        if ($jenis === 'sejarah' && $profil->sejarah_gambar) {
            Storage::disk('public')->delete($profil->sejarah_gambar);
            $profil->sejarah_gambar = null;
            $profil->save();
            return back()->with('success', 'Gambar sejarah berhasil dihapus.');
        }

        if ($jenis === 'struktur' && $profil->struktur_organisasi_gambar) {
            Storage::disk('public')->delete($profil->struktur_organisasi_gambar);
            $profil->struktur_organisasi_gambar = null;
            $profil->save();
            return back()->with('success', 'Gambar struktur organisasi berhasil dihapus.');
        }

        return back()->with('error', 'Gambar tidak ditemukan.');
    }
}
