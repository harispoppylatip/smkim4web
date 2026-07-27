<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramSertifikat extends Model
{
    protected $table = 'program_sertifikat';

    protected $fillable = ['program_keahlian_id', 'nama', 'penyelenggara', 'deskripsi', 'icon', 'gambar', 'urutan'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
