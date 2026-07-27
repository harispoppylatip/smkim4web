<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramPeluangKerja extends Model
{
    protected $table = 'program_peluang_kerja';

    protected $fillable = ['program_keahlian_id', 'nama', 'urutan'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
