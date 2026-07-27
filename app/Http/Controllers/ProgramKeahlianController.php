<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use App\Models\PengaturanHome;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $programs = ProgramKeahlian::with(['kompetensi', 'prestasi', 'sertifikat'])->get();
        $pengaturanHome = PengaturanHome::first();

        return view('program-keahlian', compact('programs', 'pengaturanHome'));
    }

    public function show($slug)
    {
        $program = ProgramKeahlian::with([
            'kompetensi',
            'mataPelajaran',
            'prestasi',
            'sertifikat',
            'peluangKerja',
            'guru',
            'fasilitas',
        ])->where('slug', $slug)->firstOrFail();

        return view('program-keahlian-detail', compact('program'));
    }
}
