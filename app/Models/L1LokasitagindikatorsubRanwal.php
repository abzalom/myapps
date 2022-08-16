<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class L1LokasitagindikatorsubRanwal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get all of the lokasi for the L1LokasitagindikatorsubRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lokasi(): HasOne
    {
        return $this->hasOne(ELokasi::class, 'id', 'e_lokasi_id');
    }
}
