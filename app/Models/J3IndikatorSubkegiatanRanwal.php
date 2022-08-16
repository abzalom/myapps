<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class J3IndikatorSubkegiatanRanwal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the urusan associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function urusan(): HasOne
    {
        return $this->hasOne(A1Urusan::class, 'id', 'a1_urusan_id');
    }

    /**
     * Get the bidang associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bidang(): HasOne
    {
        return $this->hasOne(A2Bidang::class, 'id', 'a2_bidang_id');
    }

    /**
     * Get the program associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function program(): HasOne
    {
        return $this->hasOne(A3Program::class, 'id', 'a3_program_id');
    }

    /**
     * Get the kegiatan associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kegiatan(): HasOne
    {
        return $this->hasOne(A4Kegiatan::class, 'id', 'a4_kegiatan_id');
    }

    /**
     * Get the subkegiatan associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subkegiatan(): HasOne
    {
        return $this->hasOne(A5Subkegiatan::class, 'id', 'a5_subkegiatan_id');
    }

    /**
     * Get all of the lokasiranwal for the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lokasiranwal(): HasMany
    {
        return $this->hasMany(L1LokasitagindikatorsubRanwal::class, 'j3_indikator_subkegiatan_ranwal_id', 'id')->with('lokasi');
    }

    /**
     * Get the klasifikasiranwal associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function klasifikasiranwal(): HasOne
    {
        return $this->hasOne(EKlasifikasi::class, 'id', 'e_klasifikasi_id');
    }

    /**
     * Get the sumberdanaranwal associated with the J3IndikatorSubkegiatanRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sumberdanaranwal(): HasOne
    {
        return $this->hasOne(H1PaguOpdRanwal::class, 'id', 'h1_pagu_opd_ranwal_id')->with('uraianpendapatanranwal');
    }
}
