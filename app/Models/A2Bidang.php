<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class A2Bidang extends Model
{
    use HasFactory;

    /**
     * Get all of the program for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function program(): HasMany
    {
        return $this->hasMany(A3Program::class, 'a2_bidang_id', 'id');
    }

    /**
     * Get all of the tags for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(F2Tagging::class, 'a2_bidang_id', 'id');
    }

    /**
     * Get all of the paguopd for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguopd(): HasMany
    {
        return $this->hasMany(H1PaguOpd::class, 'a2_bidang_id', 'id');
    }

    /**
     * Get all of the paguranwal for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paguranwal(): HasMany
    {
        return $this->hasMany(H1PaguOpdRanwal::class, 'a2_bidang_id', 'id');
    }

    /**
     * Get all of the subrincianranwal for the A2Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subrincianranwal(): HasMany
    {
        return $this->hasMany(J3IndikatorSubkegiatanRanwal::class, 'a2_bidang_id', 'id');
    }
}
