<?php

namespace Database\Seeders;

use App\Models\B3JenisNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class B3JenisNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/json/rekening/neraca/with_id/3NeracaJenis.json');
        // $data = json_decode($json);
        $json = File::get('storage/app/public/json/database/myapps/b3_jenis_neracas.json');
        $data = json_decode($json);
        B3JenisNeraca::truncate();
        foreach ($data as $key => $value) {
            B3JenisNeraca::create(
                [
                    'b1_akun_neraca_id' => $value->b1_akun_neraca_id,
                    'b2_kelompok_neraca_id' => $value->b2_kelompok_neraca_id,
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
