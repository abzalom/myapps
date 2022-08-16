<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class C1AkunLra extends Model
{
    use HasFactory;

    /**
     * Get all of the kelompok for the C1AkunLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompok(): HasMany
    {
        return $this->hasMany(C2KelompokLra::class);
    }

    /**
     * Get all of the komponen for the C1AkunLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get all of the ssh for the C1AkunLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ssh(): HasMany
    {
        return $this->hasMany(K1SshTag::class, 'c1_akun_lra_id', 'id');
    }
}
