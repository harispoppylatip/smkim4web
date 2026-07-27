<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $fillable = [
        'sejarah',
        'sejarah_gambar',
        'visi',
        'misi',
        'struktur_organisasi_gambar',
        'timeline',
        'nilai',
        'struktur_organisasi',
    ];

    protected function casts(): array
    {
        return [
            'timeline' => 'array',
            'nilai' => 'array',
            'struktur_organisasi' => 'array',
        ];
    }
}
