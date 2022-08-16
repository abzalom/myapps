<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class A1Urusan extends Model
{
    use HasFactory;

    /**
     * Get all of the bidang for the A1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidang(): HasMany
    {
        return $this->hasMany(A2Bidang::class, 'a1_urusan_id', 'id');
    }

    /**
     * Get all of the subrincian for the A1Urusan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincian(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a1_urusan_id', 'id');
    }
}
