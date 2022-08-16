<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class H1PaguOpdHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'f1_perangkat_id',
        'sumber',
        'subrekening',
        'c6_subrincian_lra_id',
        'pagu',
        'tahun',
        'e_status_history_pagu_id',
        'keterangan',
        'peruntukan',
    ];

    /**
     * Get the opd associated with the H1PaguOpdHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function opd(): HasOne
    {
        return $this->hasOne(F1Perangkat::class, 'id', 'f1_perangkat_id');
    }

    /**
     * Get the status associated with the H1PaguOpdHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(EStatusHistoryPagu::class, 'id', 'e_status_history_pagu_id');
    }
}
