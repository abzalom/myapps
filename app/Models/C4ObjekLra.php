<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class C4ObjekLra extends Model
{
    use HasFactory;

    /**
     * Get all of the rincian for the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rincian(): HasMany
    {
        return $this->hasMany(C5RincianLra::class);
    }

    /**
     * Get all of the komponen for the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get the jenislra associated with the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jenislra(): HasOne
    {
        return $this->hasOne(C3JenisLra::class, 'id', 'c3_jenis_lra_id');
    }

    /**
     * Get all of the ssh for the C4ObjekLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssh(): HasMany
    {
        return $this->hasMany(K1SshTag::class, 'c4_objek_lra_id', 'id');
    }
}
