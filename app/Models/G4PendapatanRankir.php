<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class G4PendapatanRankir extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'c1_akun_lra_id',
        'c2_kelompok_lra_id',
        'c3_jenis_lra_id',
        'c4_objek_lra_id',
        'c5_rincian_lra_id',
        'c6_subrincian_lra_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
