<?php

namespace App\Models;

use App\Models\G1PendapatanUraian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class H1PaguOpd extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'a1_urusan_id',
        'a2_bidang_id',
        'f1_perangkat_id',
        'g1_pendapatan_uraian_id',
        'c6_subrincian_lra_id',
        'pagu',
        'tahun',
    ];

    /**
     * Get the pendapatan associated with the H1PaguOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function pendapatan(): BelongsTo
    {
        return $this->belongsTo(G1PendapatanUraian::class, 'g1_pendapatan_uraian_id', 'id');
    }

    /**
     * Get all of the opd for the H1PaguOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opd(): HasMany
    {
        return $this->hasMany(F1Perangkat::class, 'id', 'f1_perangkat_id');
    }

    /**
     * Get all of the anggaran for the H1PaguOpd
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function anggaran(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'h1_pagu_opd_id', 'local_key');
    }
}
