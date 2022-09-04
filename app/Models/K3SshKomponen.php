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
    protected $casts = [
        'zonasi' => 'boolean',
    ];

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
    public function zona_satu(): HasOne
    {
        return $this->hasOne(EZonasi::class, 'id', 'zona_1');
    }

    /**
     * Get the zonasi associated with the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona_dua(): HasOne
    {
        return $this->hasOne(EZonasi::class, 'id', 'zona_2');
    }

    /**
     * Get the zonasi associated with the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zona_tiga(): HasOne
    {
        return $this->hasOne(EZonasi::class, 'id', 'zona_3');
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

    /**
     * Get the rekening that owns the K3SshKomponen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rekening(): BelongsTo
    {
        return $this->belongsTo(C6SubrincianLra::class, 'rekening_subrincian', 'kode_unik_subrincian');
    }
}
