<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class C3JenisLra extends Model
{
    use HasFactory;

    /**
     * Get all of the objek for the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objek(): HasMany
    {
        return $this->hasMany(C4ObjekLra::class);
    }

    /**
     * Get all of the komponen for the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get the kelompoklra associated with the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kelompoklra(): HasOne
    {
        return $this->hasOne(C2KelompokLra::class, 'id', 'c2_kelompok_lra_id');
    }

    /**
     * Get all of the ssh for the C3JenisLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssh(): HasMany
    {
        return $this->hasMany(K1SshTag::class, 'c3_jenis_lra_id', 'id');
    }
}
