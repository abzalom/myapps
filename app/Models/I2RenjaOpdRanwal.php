<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class I2RenjaOpdRanwal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the urusan for the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function urusan(): HasMany
    {
        return $this->hasMany(A1Urusan::class, 'id', 'a1_urusan_id');
    }

    /**
     * Get all of the bidang for the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bidang(): HasMany
    {
        return $this->hasMany(A2Bidang::class, 'id', 'a2_bidang_id');
    }

    /**
     * Get all of the program for the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function program(): HasMany
    {
        return $this->hasMany(A3Program::class, 'id', 'a3_program_id');
    }

    /**
     * Get all of the kegiatan for the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan(): HasMany
    {
        return $this->hasMany(A4Kegiatan::class, 'id', 'a4_kegiatan_id');
    }

    /**
     * Get all of the subkegiatan for the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subkegiatan(): HasMany
    {
        return $this->hasMany(A5Subkegiatan::class, 'id', 'a5_subkegiatan_id');
    }

    /**
     * Get the programrka associated with the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function programrka(): HasOne
    {
        return $this->hasOne(A3Program::class, 'id', 'a3_program_id');
    }

    /**
     * Get the kegiatanrka associated with the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kegiatanrka(): HasOne
    {
        return $this->hasOne(A4Kegiatan::class, 'id', 'a4_kegiatan_id');
    }

    /**
     * Get the subkegiatanrka associated with the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subkegiatanrka(): HasOne
    {
        return $this->hasOne(A5Subkegiatan::class, 'id', 'a5_subkegiatan_id');
    }

    /**
     * Get the subrincianrka associated with the I2RenjaOpdRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subrincianrka(): HasOne
    {
        return $this->hasOne(J3IndikatorSubkegiatanRanwal::class, 'i2_renja_opd_ranwal_id', 'id');
    }
}
