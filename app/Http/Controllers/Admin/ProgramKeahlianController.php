<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $programs = ProgramKeahlian::with(['kompetensi', 'prestasi', 'sertifikat'])->get();
        return view('admin.program-keahlian.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program-keahlian.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'singkatan' => 'required|max:20|unique:program_keahlian,singkatan',
            'deskripsi_singkat' => 'required',
            'deskripsi' => 'required',
        ]);

        // Slug mengikuti pola seeder: singkatan huruf kecil, unik.
        $singkatan = Str::upper(trim($validated['singkatan']));
        $baseSlug = Str::slug($singkatan);
        $slug = $baseSlug;
        $counter = 1;
        while (ProgramKeahlian::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $program = ProgramKeahlian::create([
            'slug' => $slug,
            'singkatan' => $singkatan,
            'nama' => $validated['nama'],
            'deskripsi_singkat' => $validated['deskripsi_singkat'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('admin.program-keahlian.edit', $program->id)
            ->with('success', 'Program keahlian "' . $program->nama . '" berhasil ditambahkan. Silakan lengkapi gambar, logo, dan detail lainnya.');
    }

    public function edit($id)
    {
        $program = ProgramKeahlian::with([
            'kompetensi',
            'mataPelajaran',
            'prestasi',
            'sertifikat',
            'peluangKerja',
            'guru',
            'fasilitas',
        ])->findOrFail($id);

        return view('admin.program-keahlian.form', [
            'program' => $program,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi_singkat' => 'required',
            'deskripsi' => 'required',
        ]);

        $program = ProgramKeahlian::findOrFail($id);
        $program->update($validated);

        return redirect()->route('admin.program-keahlian.index')
            ->with('success', 'Program keahlian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $program = ProgramKeahlian::with(['prestasi', 'sertifikat', 'guru', 'fasilitas'])
            ->findOrFail($id);

        // Hapus file gambar/foto milik data anak (row-nya ikut terhapus oleh cascadeOnDelete di DB).
        foreach ($program->prestasi as $item) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
        }
        foreach ($program->sertifikat as $item) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
        }
        foreach ($program->guru as $item) {
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto);
            }
        }
        foreach ($program->fasilitas as $item) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
        }

        // Hapus file gambar milik program itu sendiri.
        foreach (['gambar', 'logo', 'hero_background_foto', 'gambar_peluang_kerja'] as $kolom) {
            if ($program->{$kolom}) {
                Storage::disk('public')->delete($program->{$kolom});
            }
        }

        $program->delete();

        return redirect()->route('admin.program-keahlian.index')
            ->with('success', 'Program keahlian "' . $program->nama . '" beserta seluruh datanya berhasil dihapus.');
    }
}
