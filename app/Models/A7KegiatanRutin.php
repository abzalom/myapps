<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A7KegiatanRutin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the subkegiatanrutin for the A7KegiatanRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatanrutin(): HasMany
    {
        return $this->hasMany(A8SubkegiatanRutin::class, 'kode_unik_kegiatan', 'kode_unik_kegiatan');
    }

    /**
     * Get all of the subrincianrutin for the A7KegiatanRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianrutin(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'a7_kegiatan_rutin_id', 'id');
    }

    /**
     * Get the indikatorkegranwal associated with the A7KegiatanRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indikatorkegranwal(): HasOne
    {
        return $this->hasOne(J5IndikatorKegiatanRutinRanwal::class, 'kode_unik_kegiatan', 'kode_unik_kegiatan');
    }
}
