<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class H1PaguOpdRanwal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'a1_urusan_id',
        'a2_bidang_id',
        'f1_perangkat_id',
        'g2_pendapatan_uraian_ranwal_id',
        'c6_subrincian_lra_id',
        'pagu',
        'tahun',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the bidang for the H1PaguOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidang(): HasMany
    {
        return $this->hasMany(A2Bidang::class, 'id', 'a2_bidang_id');
    }

    /**
     * Get the uraianpendapatanranwal associated with the H1PaguOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function uraianpendapatanranwal(): HasOne
    {
        return $this->hasOne(G2PendapatanUraianRanwal::class, 'id', 'g2_pendapatan_uraian_ranwal_id');
    }

    /**
     * Get all of the subrincianranwal for the H1PaguOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianranwal(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'h1_pagu_opd_ranwal_id', 'id');
    }

    /**
     * Get all of the subrinrianrutinranwal for the H1PaguOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrinrianrutinranwal(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'h1_pagu_opd_ranwal_id', 'id');
    }
}
