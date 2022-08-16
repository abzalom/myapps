<?php

namespace Database\Seeders;

use App\Models\D3JenisLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D3JenisLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        D3JenisLo::truncate();
        $json = File::get('storage/app/public/json/rekening/lo/3LoJenis.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            D3JenisLo::create(
                [
                    'd1_akun_lo_id' => $value->d1_akun_lo_id,
                    'd2_kelompok_lo_id' => $value->d2_kelompok_lo_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_jenis' => $value->kode_jenis,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'kode_unik_jenis' => $value->kode_unik_jenis,
                    'uraian' => $value->uraian,
                    'created_at' => now(),
                ]
            );
        }
    }
}
