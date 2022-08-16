<?php

namespace Database\Seeders;

use App\Models\D2KelompokLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D2KelompokLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        D2KelompokLo::truncate();
        $json = File::get('storage/app/public/json/rekening/lo/2LoKelompok.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            D2KelompokLo::create(
                [
                    'd1_akun_lo_id' => $value->d1_akun_lo_id,
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
