<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramGuru extends Model
{
    protected $table = 'program_guru';

    protected $fillable = ['program_keahlian_id', 'nama', 'bidang', 'foto', 'urutan'];

    public function programKeahlian(): BelongsTo
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
