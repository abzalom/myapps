<?php

namespace Database\Seeders;

use App\Models\D6SubrincianLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D6SubrincianLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/d6_subrincian.json');
        $data = json_decode($json);
        D6SubrincianLo::truncate();
        foreach ($data as $key => $value) {
            D6SubrincianLo::create(
                [
                    'd1_akun_lo_id' => $value->d1_akun_lo_id,
                    'd2_kelompok_lo_id' => $value->d2_kelompok_lo_id,
                    'd3_jenis_lo_id' => $value->d3_jenis_lo_id,
                    'd4_objek_lo_id' => $value->d4_objek_lo_id,
                    'd5_rincian_lo_id' => $value->d5_rincian_lo_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_jenis' => $value->kode_jenis,
                    'kode_objek' => $value->kode_objek,
                    'kode_rincian' => $value->kode_rincian,
                    'kode_subrincian' => $value->kode_subrincian,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'kode_unik_jenis' => $value->kode_unik_jenis,
                    'kode_unik_objek' => $value->kode_unik_objek,
                    'kode_unik_rincian' => $value->kode_unik_rincian,
                    'kode_unik_subrincian' => $value->kode_unik_subrincian,
                    'uraian' => $value->uraian,
                    'kategori_ssh' => $value->kategori_ssh,
                    'kode_kategori_ssh' => $value->kode_kategori_ssh,
                    'keterangan' => $value->keterangan,
                    // 'created_at' => now(),
                ]
            );
        }
    }
}
