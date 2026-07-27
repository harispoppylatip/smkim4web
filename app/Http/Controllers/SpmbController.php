<?php

namespace App\Http\Controllers;

use App\Models\PengaturanHome;
use App\Models\PengaturanSpmb;
use App\Models\ProgramKeahlian;
use App\Models\FasilitasUmum;
use App\Models\Unggulan;
use Illuminate\Http\Request;

class SpmbController extends Controller
{
    public function index()
    {
        $spmb = PengaturanSpmb::first();
        $programKeahlian = ProgramKeahlian::orderBy('id')->get();
        $fasilitas = FasilitasUmum::orderBy('urutan')->get();
        $unggulan = Unggulan::orderBy('urutan')->get();
        $pengaturanHome = PengaturanHome::first();

        return view('spmb', compact('spmb', 'programKeahlian', 'fasilitas', 'unggulan', 'pengaturanHome'));
    }
}
