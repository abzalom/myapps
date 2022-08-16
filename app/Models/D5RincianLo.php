<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class D5RincianLo extends Model
{
    use HasFactory, Searchable;

    /**
     * Get all of the subrincian for the D5RincianLo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincian(): HasMany
    {
        return $this->hasMany(D6SubrincianLo::class);
    }

    public function toSearchableArray()
    {
        return [
            'kode_unik_akun' => $this->kode_unik_akun,
            'kode_unik_kelompok' => $this->kode_unik_kelompok,
            'kode_unik_jenis' => $this->kode_unik_jenis,
            'kode_unik_objek' => $this->kode_unik_objek,
            'kode_unik_rincian' => $this->kode_unik_rincian,
            'kode_unik_subrincian' => $this->kode_unik_subrincian,
            'uraian' => $this->uraian,
        ];
    }
}
