<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSpmb extends Model
{
    protected $table = 'pengaturan_spmb';

    protected $fillable = [
        'tahun',
        'persyaratan',
        'brosur',
        'whatsapp',
        'ekstrakurikuler',
    ];

    protected function casts(): array
    {
        return [
            'persyaratan' => 'array',
            'ekstrakurikuler' => 'array',
        ];
    }
}
