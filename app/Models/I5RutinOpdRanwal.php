<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class I5RutinOpdRanwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the subrincianrutin for the I5RutinOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianrutin(): HasMany
    {
        return $this->hasMany(J6SubrincianRutinRanwal::class, 'i5_rutin_opd_ranwal_id', 'id');
    }

    /**
     * Get the subrincianrka associated with the I5RutinOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subrincianrka(): HasOne
    {
        return $this->hasOne(J6SubrincianRutinRanwal::class, 'i5_rutin_opd_ranwal_id', 'id');
    }

    /**
     * Get the programrka associated with the I5RutinOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programrka(): HasOne
    {
        return $this->hasOne(A6ProgramRutin::class, 'id', 'a6_program_rutin_id');
    }

    /**
     * Get the kegiatanrka associated with the I5RutinOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kegiatanrka(): HasOne
    {
        return $this->hasOne(A7KegiatanRutin::class, 'id', 'a7_kegiatan_rutin_id');
    }

    /**
     * Get the subkegiatanrka associated with the I5RutinOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subkegiatanrka(): HasOne
    {
        return $this->hasOne(A8SubkegiatanRutin::class, 'id', 'a8_subkegiatan_rutin_id');
    }
}
