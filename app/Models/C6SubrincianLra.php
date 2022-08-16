<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class C6SubrincianLra extends Model
{
    use HasFactory, Searchable;


    public function toSearchableArray()
    {
        return [
            // 'kode_unik_akun' => $this->kode_unik_akun,
            // 'kode_unik_kelompok' => $this->kode_unik_kelompok,
            // 'kode_unik_jenis' => $this->kode_unik_jenis,
            // 'kode_unik_objek' => $this->kode_unik_objek,
            // 'kode_unik_rincian' => $this->kode_unik_rincian,
            // 'kode_unik_subrincian' => $this->kode_unik_subrincian,
            'uraian' => $this->uraian,
        ];
    }

    /**
     * Get all of the rkaranwalrutinkomponen for the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rkaranwalrutinkomponen(): HasMany
    {
        return $this->hasMany(M3RkaRutinRanwal::class, 'rekening_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the rkaranwalkomponen for the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rkaranwalkomponen(): HasMany
    {
        return $this->hasMany(M6RanwalKomponen::class, 'rekening_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the komponen for the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class);
    }

    /**
     * Get the rincianlra associated with the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rincianlra(): HasOne
    {
        return $this->hasOne(C5RincianLra::class, 'id', 'c5_rincian_lra_id');
    }

    /**
     * Get all of the ssh for the C6SubrincianLra
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ssh(): HasOne
    {
        return $this->hasOne(K1SshTag::class, 'c6_subrincian_lra_id', 'id');
    }
}
