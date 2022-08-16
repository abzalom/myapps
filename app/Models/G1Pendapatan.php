<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class G1Pendapatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    /**
     * Get all of the komponen for the G1Pendapatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(G1PendapatanUraian::class, 'id', 'g1_pendapatan_id');
    }
}
