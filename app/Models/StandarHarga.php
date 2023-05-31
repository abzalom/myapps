<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StandarHarga extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the rekening that owns the StandarHarga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rekening(): BelongsTo
    {
        return $this->belongsTo(C6SubrincianLra::class, 'rekening_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get the kategori that owns the StandarHarga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori()
    {
        return $this->uraian;
    }
}
