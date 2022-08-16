<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class G3PendapatanUraianRancangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'c1_akun_lra_id',
        'c2_kelompok_lra_id',
        'c3_jenis_lra_id',
        'c4_objek_lra_id',
        'c5_rincian_lra_id',
        'c6_subrincian_lra_id',
        'g1_pendapatan_id',
        'kode',
        'kode_unik',
        'uraian',
        'anggaran',
    ];
}
