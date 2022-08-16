<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class K2SshKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the komponen for the K2SshKategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komponen(): HasMany
    {
        return $this->hasMany(K3SshKomponen::class, 'kategori_subrincian', 'kode_unik_subrincian');
    }
}
