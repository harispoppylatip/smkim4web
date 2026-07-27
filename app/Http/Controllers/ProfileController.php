<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Models\PengaturanHome;

class ProfileController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $pengaturanHome = PengaturanHome::first();

        return view('profile', compact('profil', 'pengaturanHome'));
    }
}
