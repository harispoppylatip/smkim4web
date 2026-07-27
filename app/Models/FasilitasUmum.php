<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    protected $fillable = [
        'nama',
        'icon',
        'gambar',
        'urutan',
    ];
}
