<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramMataPelajaran extends Model
{
    protected $table = 'program_mata_pelajaran';

    protected $fillable = ['program_keahlian_id', 'nama', 'urutan'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
