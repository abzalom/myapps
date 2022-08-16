<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A4Kegiatan extends Model
{
    use HasFactory;

    /**
     * Get all of the subkegiatan for the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatan(): HasMany
    {
        return $this->hasMany(A5Subkegiatan::class, 'a4_kegiatan_id', 'id');
    }

    /**
     * Get the ranwalindikator associated with the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ranwalindikator(): HasOne
    {
        return $this->hasOne(J2IndikatorKegiatanRanwal::class, 'a4_kegiatan_id', 'id');
    }

    /**
     * Get all of the subrincian for the A4Kegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincian(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a4_kegiatan_id', 'id');
    }
}
