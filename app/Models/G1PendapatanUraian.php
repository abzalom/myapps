<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class G1PendapatanUraian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the subrincian associated with the G1PendapatanUraian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subrincian(): HasOne
    {
        return $this->hasOne(C6SubrincianLra::class, 'id', 'c6_subrincian_lra_id');
    }

    /**
     * Get all of the paguopd for the G1PendapatanUraian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguopd(): HasMany
    {
        return $this->hasMany(H1PaguOpd::class, 'g1_pendapatan_uraian_id', 'id');
    }
}
