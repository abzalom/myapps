<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class M6RanwalKomponen extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'anggaran' => 'decimal:2',
    ];

    public function setPajakAttribute($value)
    {
        return $this->attributes['pajak'] = $value ?? false;
    }

    /**
     * Get the rekening that owns the M6RanwalKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rekening(): BelongsTo
    {
        return $this->belongsTo(C6SubrincianLra::class, 'rekening_subrincian', 'kode_unik_subrincian');
    }
}
