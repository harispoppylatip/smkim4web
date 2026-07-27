<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $programs = ProgramKeahlian::with(['kompetensi', 'prestasi', 'sertifikat'])->get();
        return view('admin.program-keahlian.index', compact('programs'));
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
}
