<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use App\Models\ProgramKompetensi;
use App\Models\ProgramMataPelajaran;
use App\Models\ProgramPrestasi;
use App\Models\ProgramSertifikat;
use App\Models\ProgramPeluangKerja;
use App\Models\ProgramGuru;
use App\Models\ProgramFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramResourceController extends Controller
{
    private function getProgram($id)
    {
        return ProgramKeahlian::findOrFail($id);
    }

    // ==================== GAMBAR PROGRAM ====================

    public function uploadGambar(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }

            $path = $request->file('gambar')->store('program-keahlian', 'public');
            $program->update(['gambar' => $path]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Gambar program berhasil diupload.');
    }

    public function deleteGambar($id)
    {
        $program = $this->getProgram($id);

        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
            $program->update(['gambar' => null]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Gambar program berhasil dihapus.');
    }

    // ==================== LOGO PROGRAM ====================

    public function uploadLogo(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('logo')) {
            if ($program->logo) {
                Storage::disk('public')->delete($program->logo);
            }

            $path = $request->file('logo')->store('program-keahlian/logo', 'public');
            $program->update(['logo' => $path]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Logo program berhasil diupload.');
    }

    public function deleteLogo($id)
    {
        $program = $this->getProgram($id);

        if ($program->logo) {
            Storage::disk('public')->delete($program->logo);
            $program->update(['logo' => null]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Logo program berhasil dihapus.');
    }

    // ==================== HERO BACKGROUND ====================

    public function uploadHeroBackground(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'hero_background_foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('hero_background_foto')) {
            if ($program->hero_background_foto) {
                Storage::disk('public')->delete($program->hero_background_foto);
            }

            $path = $request->file('hero_background_foto')->store('program-keahlian/hero', 'public');
            $program->update(['hero_background_foto' => $path]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Background hero berhasil diupload.');
    }

    public function deleteHeroBackground($id)
    {
        $program = $this->getProgram($id);

        if ($program->hero_background_foto) {
            Storage::disk('public')->delete($program->hero_background_foto);
            $program->update(['hero_background_foto' => null]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Background hero berhasil dihapus.');
    }

    // ==================== GAMBAR PELUANG KERJA (ILUSTRASI) ====================

    public function uploadGambarPeluangKerja(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'gambar_peluang_kerja' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('gambar_peluang_kerja')) {
            if ($program->gambar_peluang_kerja) {
                Storage::disk('public')->delete($program->gambar_peluang_kerja);
            }

            $path = $request->file('gambar_peluang_kerja')->store('program-keahlian/peluang-kerja', 'public');
            $program->update(['gambar_peluang_kerja' => $path]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Gambar peluang karir berhasil diupload.');
    }

    public function deleteGambarPeluangKerja($id)
    {
        $program = $this->getProgram($id);

        if ($program->gambar_peluang_kerja) {
            Storage::disk('public')->delete($program->gambar_peluang_kerja);
            $program->update(['gambar_peluang_kerja' => null]);
        }

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Gambar peluang karir berhasil dihapus.');
    }

    // ==================== KOMPETENSI ====================

    public function storeKompetensi(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        ProgramKompetensi::create([
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Kompetensi berhasil ditambahkan.');
    }

    public function updateKompetensi(Request $request, $id, $kompetensiId)
    {
        $kompetensi = ProgramKompetensi::findOrFail($kompetensiId);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        $kompetensi->update($request->only(['nama', 'urutan']));

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Kompetensi berhasil diperbarui.');
    }

    public function destroyKompetensi($id, $kompetensiId)
    {
        ProgramKompetensi::findOrFail($kompetensiId)->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Kompetensi berhasil dihapus.');
    }

    // ==================== MATA PELAJARAN ====================

    public function storeMataPelajaran(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        ProgramMataPelajaran::create([
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function updateMataPelajaran(Request $request, $id, $mapelId)
    {
        $mapel = ProgramMataPelajaran::findOrFail($mapelId);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        $mapel->update($request->only(['nama', 'urutan']));

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroyMataPelajaran($id, $mapelId)
    {
        ProgramMataPelajaran::findOrFail($mapelId)->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    // ==================== PRESTASI ====================

    public function storePrestasi(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'judul' => 'required|max:255',
            'tahun' => 'required|max:10',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = [
            'program_keahlian_id' => $program->id,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon ?? 'emoji_events',
            'urutan' => $request->urutan ?? 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        ProgramPrestasi::create($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function updatePrestasi(Request $request, $id, $prestasiId)
    {
        $prestasi = ProgramPrestasi::findOrFail($prestasiId);

        $request->validate([
            'judul' => 'required|max:255',
            'tahun' => 'required|max:10',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->only(['judul', 'tahun', 'deskripsi', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar) {
                Storage::disk('public')->delete($prestasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroyPrestasi($id, $prestasiId)
    {
        $prestasi = ProgramPrestasi::findOrFail($prestasiId);

        if ($prestasi->gambar) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    // ==================== SERTIFIKAT ====================

    public function storeSertifikat(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
            'penyelenggara' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = [
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'penyelenggara' => $request->penyelenggara,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon ?? 'verified',
            'urutan' => $request->urutan ?? 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sertifikat', 'public');
        }

        ProgramSertifikat::create($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function updateSertifikat(Request $request, $id, $sertifikatId)
    {
        $sertifikat = ProgramSertifikat::findOrFail($sertifikatId);

        $request->validate([
            'nama' => 'required|max:255',
            'penyelenggara' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->only(['nama', 'penyelenggara', 'deskripsi', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            if ($sertifikat->gambar) {
                Storage::disk('public')->delete($sertifikat->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sertifikat', 'public');
        }

        $sertifikat->update($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroySertifikat($id, $sertifikatId)
    {
        $sertifikat = ProgramSertifikat::findOrFail($sertifikatId);

        if ($sertifikat->gambar) {
            Storage::disk('public')->delete($sertifikat->gambar);
        }

        $sertifikat->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Sertifikat berhasil dihapus.');
    }

    // ==================== GURU (TIM PENGAJAR) ====================

    public function storeGuru(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
            'bidang' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = [
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'urutan' => $request->urutan ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        ProgramGuru::create($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Guru berhasil ditambahkan.');
    }

    public function updateGuru(Request $request, $id, $guruId)
    {
        $guru = ProgramGuru::findOrFail($guruId);

        $request->validate([
            'nama' => 'required|max:255',
            'bidang' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->only(['nama', 'bidang', 'urutan']);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroyGuru($id, $guruId)
    {
        $guru = ProgramGuru::findOrFail($guruId);

        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Guru berhasil dihapus.');
    }

    // ==================== FASILITAS ====================

    public function storeFasilitas(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = [
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon ?? 'business',
            'urutan' => $request->urutan ?? 0,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        ProgramFasilitas::create($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function updateFasilitas(Request $request, $id, $fasilitasId)
    {
        $fasilitas = ProgramFasilitas::findOrFail($fasilitasId);

        $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'icon', 'urutan']);

        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar) {
                Storage::disk('public')->delete($fasilitas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilitas->update($data);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroyFasilitas($id, $fasilitasId)
    {
        $fasilitas = ProgramFasilitas::findOrFail($fasilitasId);

        if ($fasilitas->gambar) {
            Storage::disk('public')->delete($fasilitas->gambar);
        }

        $fasilitas->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Fasilitas berhasil dihapus.');
    }

    // ==================== PELUANG KERJA ====================

    public function storePeluangKerja(Request $request, $id)
    {
        $program = $this->getProgram($id);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        ProgramPeluangKerja::create([
            'program_keahlian_id' => $program->id,
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Peluang kerja berhasil ditambahkan.');
    }

    public function updatePeluangKerja(Request $request, $id, $peluangId)
    {
        $peluang = ProgramPeluangKerja::findOrFail($peluangId);

        $request->validate([
            'nama' => 'required|max:255',
        ]);

        $peluang->update($request->only(['nama', 'urutan']));

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Peluang kerja berhasil diperbarui.');
    }

    public function destroyPeluangKerja($id, $peluangId)
    {
        ProgramPeluangKerja::findOrFail($peluangId)->delete();

        return redirect()->route('admin.program-keahlian.edit', $id)
            ->with('success', 'Peluang kerja berhasil dihapus.');
    }
}
