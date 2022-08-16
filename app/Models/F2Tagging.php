<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class F2Tagging extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    /**
     * Get all of the opd for the F2Tagging
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opd(): HasMany
    {
        return $this->hasMany(F1Perangkat::class, 'id', 'f1_perangkat_id');
    }

    /**
     * Get the bidang associated with the F2Tagging
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bidang(): HasOne
    {
        return $this->hasOne(A2Bidang::class, 'id', 'a2_bidang_id');
    }

    /**
     * Get all of the paguopd for the F2Tagging
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguopd(): HasMany
    {
        return $this->hasMany(H1PaguOpd::class, 'a2_bidang_id', 'a2_bidang_id');
    }

    /**
     * Get all of the subrincianbybidang for the F2Tagging
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianbybidang(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a2_bidang_id', 'a2_bidang_id');
    }
}
