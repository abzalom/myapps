<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class K3SshKomponen extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the sshtag for the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sshtag(): BelongsTo
    {
        return $this->belongsTo(K1SshTag::class, 'kode_unik_subrincian', 'kode_unik_subrincian');
    }

    /**
     * Get the zonasi associated with the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zonasi(): HasOne
    {
        return $this->hasOne(EZonasi::class, 'id', 'e_zonasi_id');
    }

    /**
     * Get the typeproduk associated with the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function typeproduk(): HasOne
    {
        return $this->hasOne(EJenisKomponen::class, 'id', 'e_jenis_komponen_id');
    }
}
