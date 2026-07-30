<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramKeahlian extends Model
{
    protected $table = 'program_keahlian';

    protected $fillable = [
        'slug',
        'singkatan',
        'nama',
        'deskripsi_singkat',
        'deskripsi',
        'icon',
        'icon_besar',
        'warna',
        'warna_bg',
        'warna_icon',
        'warna_container',
        'warna_container_bg',
        'gambar',
        'gambar_peluang_kerja',
        'logo',
        'hero_background_foto',
    ];

    public function kompetensi(): HasMany
    {
        return $this->hasMany(ProgramKompetensi::class)->orderBy('urutan');
    }

    public function mataPelajaran(): HasMany
    {
        return $this->hasMany(ProgramMataPelajaran::class)->orderBy('urutan');
    }

    public function prestasi(): HasMany
    {
        return $this->hasMany(ProgramPrestasi::class)->orderBy('urutan');
    }

    public function sertifikat(): HasMany
    {
        return $this->hasMany(ProgramSertifikat::class)->orderBy('urutan');
    }

    public function peluangKerja(): HasMany
    {
        return $this->hasMany(ProgramPeluangKerja::class)->orderBy('urutan');
    }

    public function guru(): HasMany
    {
        return $this->hasMany(ProgramGuru::class)->orderBy('urutan');
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(ProgramFasilitas::class)->orderBy('urutan');
    }
}
