<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A3Program extends Model
{
    use HasFactory;

    /**
     * Get all of the kegiatan for the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan(): HasMany
    {
        return $this->hasMany(A4Kegiatan::class, 'a3_program_id', 'id');
    }

    /**
     * Get the ranwalindikator associated with the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ranwalindikator(): HasOne
    {
        return $this->hasOne(J1IndikatorProgramRanwal::class, 'a3_program_id', 'id');
    }

    /**
     * Get all of the subrincian for the A3Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincian(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a3_program_id', 'id');
    }
}
