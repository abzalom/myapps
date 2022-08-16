<?php

namespace Database\Seeders;

use App\Models\B2KelompokNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class B2KelompokNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        B2KelompokNeraca::truncate();
        $json = File::get('storage/app/public/json/rekening/neraca/with_id/2NeracaKelompok.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            B2KelompokNeraca::create(
                [
                    'b1_akun_neraca_id' => $value->b1_akun_neraca_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'uraian' => $value->uraian,
                    'created_at' => now(),
                ]
            );
        }
    }
}
