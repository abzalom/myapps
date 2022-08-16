<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A5Subkegiatan extends Model
{
    use HasFactory;

    /**
     * Get the ranwal associated with the A5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ranwal(): HasOne
    {
        return $this->hasOne(I2RenjaOpdRanwal::class, 'a5_subkegiatan_id', 'id');
    }

    /**
     * Get the ranwalindikator associated with the A5Subkegiatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranwalindikator(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a5_subkegiatan_id', 'id');
    }
}
