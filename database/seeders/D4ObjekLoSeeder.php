<?php

namespace Database\Seeders;

use App\Models\D4ObjekLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D4ObjekLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/d4_objek_los.json');
        $data = json_decode($json);
        D4ObjekLo::truncate();
        foreach ($data as $key => $value) {
            D4ObjekLo::create(
                [
                    'd1_akun_lo_id' => $value->d1_akun_lo_id,
                    'd2_kelompok_lo_id' => $value->d2_kelompok_lo_id,
                    'd3_jenis_lo_id' => $value->d3_jenis_lo_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_jenis' => $value->kode_jenis,
                    'kode_objek' => $value->kode_objek,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'kode_unik_jenis' => $value->kode_unik_jenis,
                    'kode_unik_objek' => $value->kode_unik_objek,
                    'uraian' => $value->uraian,
                    'created_at' => now(),
                ]
            );
        }
    }
}
