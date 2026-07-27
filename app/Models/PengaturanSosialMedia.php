<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSosialMedia extends Model
{
    protected $table = 'pengaturan_sosial_media';

    protected $fillable = [
        'youtube',
        'instagram',
        'facebook',
        'tiktok',
    ];
}
