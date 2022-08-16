<?php

namespace Database\Seeders;

use App\Models\B4ObjekNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class B4ObjekNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        B4ObjekNeraca::truncate();
        $json = File::get('storage/app/public/json/rekening/neraca/with_id/4NeracaObjek.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            B4ObjekNeraca::create(
                [
                    'b1_akun_neraca_id' => $value->b1_akun_neraca_id,
                    'b2_kelompok_neraca_id' => $value->b2_kelompok_neraca_id,
                    'b3_jenis_neraca_id' => $value->b3_jenis_neraca_id,
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
