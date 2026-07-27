<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanHome extends Model
{
    protected $table = 'pengaturan_home';

    protected $fillable = [
        'kepala_sekolah_nama',
        'kepala_sekolah_jabatan',
        'kepala_sekolah_sambutan',
        'hero_background_foto',
        'kepala_sekolah_foto',
        'kepala_sekolah_pengalaman_angka',
        'kepala_sekolah_pengalaman_label',
    ];
}
