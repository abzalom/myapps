<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class C5RincianLra extends Model
{
    use HasFactory;

    /**
     * Get all of the subrincian for the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincian(): HasMany
    {
        return $this->hasMany(C6SubrincianLra::class);
    }

    /**
     * Get all of the komponen for the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get the objeklra associated with the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objeklra(): HasOne
    {
        return $this->hasOne(C4ObjekLra::class, 'id', 'c4_objek_lra_id');
    }

    /**
     * Get all of the ssh for the C5RincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssh(): HasMany
    {
        return $this->hasMany(K1SshTag::class, 'c5_rincian_lra_id', 'id');
    }
}
