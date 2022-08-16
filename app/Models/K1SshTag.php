<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class K1SshTag extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the rekening_akun for the K1SshTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekening_akun(): HasMany
    {
        return $this->hasMany(C1AkunLra::class, 'kode_unik_akun', 'kode_unik_akun');
    }

    /**
     * Get all of the rekening_kelompok for the K1SshTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekening_kelompok(): HasMany
    {
        return $this->hasMany(C2KelompokLra::class, 'kode_unik_kelompok', 'kode_unik_kelompok');
    }

    /**
     * Get all of the komponen for the K1SshTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(K3SshKomponen::class, 'k1_ssh_tag_id', 'id');
    }

    /**
     * Get all of the subrincianlra for the K1SshTag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subrincianlra(): HasOne
    {
        return $this->hasOne(C6SubrincianLra::class, 'id', 'c6_subrincian_lra_id');
    }
}
