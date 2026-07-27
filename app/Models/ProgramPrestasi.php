<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramPrestasi extends Model
{
    protected $table = 'program_prestasi';

    protected $fillable = ['program_keahlian_id', 'tahun', 'judul', 'deskripsi', 'icon', 'gambar', 'urutan'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
