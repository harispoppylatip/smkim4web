<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramFasilitas extends Model
{
    protected $table = 'program_fasilitas';

    protected $fillable = ['program_keahlian_id', 'nama', 'deskripsi', 'icon', 'urutan', 'gambar'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
