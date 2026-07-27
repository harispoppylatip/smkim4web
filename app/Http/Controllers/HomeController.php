<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use App\Models\Berita;
use App\Models\PengaturanHome;
use App\Models\FasilitasUmum;
use App\Models\Unggulan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home/landing page.
     */
    public function index()
    {
        $programKeahlian = ProgramKeahlian::with(['kompetensi' => function ($q) {
            $q->orderBy('urutan')->take(4);
        }])->get();

        $berita = Berita::latest()->take(3)->get();

        $pengaturanHome = PengaturanHome::first();

        $fasilitas = FasilitasUmum::orderBy('urutan')->get();
        $unggulan = Unggulan::orderBy('urutan')->get();

        return view('home', compact('programKeahlian', 'berita', 'pengaturanHome', 'fasilitas', 'unggulan'));
    }
}
