<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use App\Models\Berita;
use App\Models\FasilitasUmum;
use App\Models\Unggulan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index()
    {
        $programKeahlian = ProgramKeahlian::withCount([
            'kompetensi', 'mataPelajaran', 'prestasi', 'sertifikat', 'guru', 'fasilitas', 'peluangKerja'
        ])->get();

        $berita = Berita::latest()->take(5)->get();
        $totalBerita = Berita::count();
        $totalFasilitas = FasilitasUmum::count();
        $totalUnggulan = Unggulan::count();
        $totalGuru = $programKeahlian->sum('guru_count');
        $totalKompetensi = $programKeahlian->sum('kompetensi_count');
        $totalMapel = $programKeahlian->sum('mata_pelajaran_count');
        $totalPrestasi = $programKeahlian->sum('prestasi_count');
        $totalSertifikat = $programKeahlian->sum('sertifikat_count');
        $totalFasilitasProg = $programKeahlian->sum('fasilitas_count');
        $totalPeluangKerja = $programKeahlian->sum('peluang_kerja_count');

        // Warna-warna untuk setiap jurusan (dinamis berdasarkan singkatan)
        $jurusanColors = [
            'TKJT' => ['primary' => '#003366', 'light' => '#d5e3ff', 'bg' => '#e8f0fe', 'border' => '#003366', 'gradient' => 'linear-gradient(135deg, #003366, #1a5276)'],
            'DKV'  => ['primary' => '#705d00', 'light' => '#fff3cd', 'bg' => '#fff8e0', 'border' => '#fcd400', 'gradient' => 'linear-gradient(135deg, #705d00, #9a7d00)'],
            'TAB'  => ['primary' => '#bf5e1a', 'light' => '#ffe0cc', 'bg' => '#fff0e6', 'border' => '#e65100', 'gradient' => 'linear-gradient(135deg, #bf5e1a, #e67e22)'],
            'TSM'  => ['primary' => '#7b4e9e', 'light' => '#edd5ff', 'bg' => '#f3e8ff', 'border' => '#9c27b0', 'gradient' => 'linear-gradient(135deg, #7b4e9e, #ab47bc)'],
            'TKR'  => ['primary' => '#c62828', 'light' => '#ffcdd2', 'bg' => '#ffebee', 'border' => '#d32f2f', 'gradient' => 'linear-gradient(135deg, #c62828, #e53935)'],
            'LKS'  => ['primary' => '#00695c', 'light' => '#b2dfdb', 'bg' => '#e0f2f1', 'border' => '#00897b', 'gradient' => 'linear-gradient(135deg, #00695c, #00897b)'],
            'AKL'  => ['primary' => '#1a7a3a', 'light' => '#d5f5e3', 'bg' => '#e8f5e9', 'border' => '#2e7d32', 'gradient' => 'linear-gradient(135deg, #1a7a3a, #43a047)'],
            'BDP'  => ['primary' => '#bf5e1a', 'light' => '#ffe0cc', 'bg' => '#fff0e6', 'border' => '#e65100', 'gradient' => 'linear-gradient(135deg, #bf5e1a, #ff8f00)'],
            'RPL'  => ['primary' => '#00695c', 'light' => '#b2dfdb', 'bg' => '#e0f2f1', 'border' => '#00897b', 'gradient' => 'linear-gradient(135deg, #00695c, #26a69a)'],
            'MM'   => ['primary' => '#c62828', 'light' => '#ffcdd2', 'bg' => '#ffebee', 'border' => '#d32f2f', 'gradient' => 'linear-gradient(135deg, #c62828, #ef5350)'],
            'PH'   => ['primary' => '#4e342e', 'light' => '#d7ccc8', 'bg' => '#efebe9', 'border' => '#6d4c41', 'gradient' => 'linear-gradient(135deg, #4e342e, #795548)'],
        ];

        // Total keseluruhan items
        $grandTotalItems = $totalKompetensi + $totalMapel + $totalPrestasi + $totalSertifikat + $totalGuru + $totalFasilitasProg + $totalPeluangKerja;

        return view('dashboard.index', compact(
            'programKeahlian', 'berita', 'totalBerita',
            'totalFasilitas', 'totalUnggulan', 'totalGuru', 'totalKompetensi',
            'totalMapel', 'totalPrestasi', 'totalSertifikat',
            'totalFasilitasProg', 'totalPeluangKerja', 'grandTotalItems',
            'jurusanColors'
        ));
    }
}
