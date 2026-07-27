<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unggulan extends Model
{
    protected $fillable = [
        'nama',
        'icon',
        'gambar',
        'urutan',
    ];
}
