<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class C2KelompokLra extends Model
{
    use HasFactory;

    /**
     * Get all of the jenis for the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jenis(): HasMany
    {
        return $this->hasMany(C3JenisLra::class);
    }

    /**
     * Get all of the komponen for the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get the akunlra associated with the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function akunlra(): HasOne
    {
        return $this->hasOne(C1AkunLra::class, 'id', 'c1_akun_lra_id');
    }

    /**
     * Get all of the ssh for the C2KelompokLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssh(): HasMany
    {
        return $this->hasMany(K1SshTag::class, 'c2_kelompok_lra_id', 'id');
    }
}
