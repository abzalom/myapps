<?php

namespace Database\Seeders;

use App\Models\C2KelompokLra;
use Database\Seeders\Data\Rekening\Lra\DataLraKelompok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class C2KelompokLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/c2_kelompok_lras.json');
        $data = json_decode($json);
        C2KelompokLra::truncate();
        foreach ($data as $key => $value) {
            C2KelompokLra::create(
                [
                    'c1_akun_lra_id' => $value->c1_akun_lra_id,
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
