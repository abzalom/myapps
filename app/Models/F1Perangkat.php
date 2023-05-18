<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class F1Perangkat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the ranwalrutinrka associated with the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ranwalrutinrka(): HasOne
    {
        return $this->hasOne(I5RutinOpdRanwal::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get the rkaranwal associated with the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rkaranwal(): HasOne
    {
        return $this->hasOne(I2RenjaOpdRanwal::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get all of the paguopd for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguopd(): HasMany
    {
        return $this->hasMany(H1PaguOpd::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get all of the paguopdranwal for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguopdranwal(): HasMany
    {
        return $this->hasMany(H1PaguOpdRanwal::class, 'f1_perangkat_id', 'id');
    }


    /**
     * Get all of the tags for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(F2Tagging::class);
    }

    /**
     * Get all of the ranwalopd for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranwalopd(): HasMany
    {
        return $this->hasMany(I2RenjaOpdRanwal::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get all of the subrincianranwal for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianranwal(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get all of the subrincianrutinranwal for the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianrutinranwal(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get the kepalaopd associated with the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kepalaopd(): HasOne
    {
        return $this->hasOne(F4KepalaOpd::class, 'f1_perangkat_id', 'id');
    }

    /**
     * Get the kel_bidang associated with the F1Perangkat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kel_bidang(): HasOne
    {
        return $this->hasOne(EKelompokBidang::class, 'id', 'kelompok_bidang');
    }
}
