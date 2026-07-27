<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'slug',
        'judul',
        'kategori',
        'tanggal',
        'deskripsi',
        'konten',
        'icon',
        'gambar',
        'warna',
        'warna_bg',
        'warna_icon',
    ];
}
