<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class B6SubrincianNeraca extends Model
{
    use HasFactory, Searchable;

    public function searchableAs()
    {
        return 'posts_index';
    }

    public function toSearchableArray()
    {
        return [
            // 'kode_unik_akun' => $this->kode_unik_akun,
            // 'kode_unik_kelompok' => $this->kode_unik_kelompok,
            // 'kode_unik_jenis' => $this->kode_unik_jenis,
            // 'kode_unik_objek' => $this->kode_unik_objek,
            // 'kode_unik_rincian' => $this->kode_unik_rincian,
            'kode_unik_subrincian' => $this->kode_unik_subrincian,
            'uraian' => $this->uraian,
        ];
    }

    /**
     * Get the kategori associated with the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kategori(): HasOne
    {
        return $this->hasOne(K2SshKategori::class, 'kode_unik_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the komponen for the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(K3SshKomponen::class, 'kategori_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the sshsikd for the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sshsikd(): HasMany
    {
        return $this->hasMany(SshSikd_2021::class, 'kategori_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the sshsikd for the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sshsikd2022(): HasMany
    {
        return $this->hasMany(SshSikd_2022::class, 'kategori_subrincian', 'kode_unik_subrincian');
    }


    /**
     * Get the kategori associated with the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kategori2022(): HasOne
    {
        return $this->hasOne(SshKategori2022::class, 'kode_unik_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get all of the komponen for the B6SubrincianNeraca
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen2022(): HasMany
    {
        return $this->hasMany(SshTag2022::class, 'kategori_subrincian', 'kode_unik_subrincian');
    }
}
