<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class A8SubkegiatanRutin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the ranwalrutin associated with the A8SubkegiatanRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ranwalrutin(): HasOne
    {
        return $this->hasOne(I5RutinOpdRanwal::class, 'a8_subkegiatan_rutin_id', 'id');
    }

    /**
     * Get all of the subrincianrutin for the A8SubkegiatanRutin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianrutin(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'a8_subkegiatan_rutin_id', 'id');
    }
}
