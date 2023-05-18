<?php

namespace Database\Seeders;

use App\Models\C5RincianLra;
use Database\Seeders\Data\Rekening\Lra\DataLraRincianObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class C5RincianLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/c5_rincian_lras.json');
        $data = json_decode($json);
        C5RincianLra::truncate();
        foreach ($data as $key => $value) {
            C5RincianLra::create(
                [
                    'c1_akun_lra_id' => $value->c1_akun_lra_id,
                    'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
                    'c3_jenis_lra_id' => $value->c3_jenis_lra_id,
                    'c4_objek_lra_id' => $value->c4_objek_lra_id,
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
