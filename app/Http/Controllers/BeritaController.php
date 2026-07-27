<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::latest();

        // Filter by kategori if selected
        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        $berita = $query->paginate(9)->withQueryString();

        // Get all unique categories from berita, plus program keahlian
        $kategoriBerita = Berita::select('kategori')->distinct()->pluck('kategori');
        $programKeahlian = ProgramKeahlian::select('singkatan', 'nama', 'warna', 'warna_bg')
            ->orderBy('singkatan')
            ->get();

        return view('berita', compact('berita', 'kategoriBerita', 'programKeahlian'));
    }

    public function show($slug)
    {
        $item = Berita::where('slug', $slug)->firstOrFail();
        $related = Berita::where('slug', '!=', $slug)->latest()->take(3)->get();

        return view('berita-detail', compact('item', 'related'));
    }
}
