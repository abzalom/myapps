<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A6ProgramRutin extends Model
{
    use HasFactory;

    /**
     * Get all of the kegiatanrutin for the A6ProgramRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatanrutin(): HasMany
    {
        return $this->hasMany(A7KegiatanRutin::class, 'kode_unik_program', 'kode_unik_program');
    }

    /**
     * Get all of the subrincianrutin for the A6ProgramRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianrutin(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'a6_program_rutin_id', 'id');
    }

    /**
     * Get all of the indikatorprogranwal for the A6ProgramRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indikatorprogranwal(): HasOne
    {
        return $this->hasOne(J4IndikatorProgramRutinRanwal::class, 'kode_unik_program', 'kode_unik_program');
    }
}
