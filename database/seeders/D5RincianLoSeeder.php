<?php

namespace Database\Seeders;

use App\Models\D5RincianLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D5RincianLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        D5RincianLo::truncate();
        $json = File::get('storage/app/public/json/rekening/lo/5LoRincian.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            D5RincianLo::create(
                [
                    'd1_akun_lo_id' => $value->d1_akun_lo_id,
                    'd2_kelompok_lo_id' => $value->d2_kelompok_lo_id,
                    'd3_jenis_lo_id' => $value->d3_jenis_lo_id,
                    'd4_objek_lo_id' => $value->d4_objek_lo_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_jenis' => $value->kode_jenis,
                    'kode_objek' => $value->kode_objek,
                    'kode_rincian' => $value->kode_rincian,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'kode_unik_jenis' => $value->kode_unik_jenis,
                    'kode_unik_objek' => $value->kode_unik_objek,
                    'kode_unik_rincian' => $value->kode_unik_rincian,
                    'uraian' => $value->uraian,
                    'created_at' => now(),
                ]
            );
        }
    }
}
