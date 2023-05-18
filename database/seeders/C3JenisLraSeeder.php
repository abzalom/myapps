<?php

namespace Database\Seeders;

use App\Models\C3JenisLra;
use Database\Seeders\Data\Rekening\Lra\DataLraJenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class C3JenisLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/c3_jenis_lras.json');
        $data = json_decode($json);
        C3JenisLra::truncate();
        foreach ($data as $key => $value) {
            C3JenisLra::create(
                [
                    'c1_akun_lra_id' => $value->c1_akun_lra_id,
                    'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
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
