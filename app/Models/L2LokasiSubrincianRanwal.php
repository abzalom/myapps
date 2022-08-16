<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class L2LokasiSubrincianRanwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the lokasi associated with the L2LokasiSubrincianRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lokasi(): HasOne
    {
        return $this->hasOne(ELokasi::class, 'id', 'e_lokasi_id');
    }
}
