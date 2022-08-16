<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class J6SubrincianRutinRanwal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Get the subkegiatan associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subkegiatan(): HasOne
    {
        return $this->hasOne(A8SubkegiatanRutin::class, 'id', 'a8_subkegiatan_rutin_id');
    }

    /**
     * Get all of the lokasi for the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lokasi(): HasMany
    {
        return $this->hasMany(L2LokasiSubrincianRanwal::class, 'j6_subrincian_rutin_ranwal_id', 'id');
    }

    /**
     * Get the klasifikasi associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function klasifikasi(): HasOne
    {
        return $this->hasOne(EKlasifikasi::class, 'id', 'e_klasifikasi_id');
    }

    /**
     * Get the penerimamanfaat associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function penerimamanfaat(): HasOne
    {
        return $this->hasOne(EPenerimaManfaat::class, 'id', 'e_penerima_manfaat_id');
    }

    /**
     * Get the sumberdana associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sumberdana(): HasOne
    {
        return $this->hasOne(H1PaguOpdRanwal::class, 'id', 'h1_pagu_opd_ranwal_id');
    }

    /**
     * Get the jenis associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jenis(): HasOne
    {
        return $this->hasOne(EJenisPekerjaan::class, 'id', 'e_jenis_pekerjaan_id');
    }

    /**
     * Get the status associated with the J6SubrincianRutinRanwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(EStatusRenja::class, 'id', 'e_status_renja_id');
    }
}
