<?php

namespace Database\Seeders;

use App\Models\B1AkunNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class B1AkunNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/json/rekening/neraca/with_id/1NeracaAkun.json');
        // $data = json_decode($json);
        $json = File::get('storage/app/public/json/database/myapps/b1_akun_neracas.json');
        $data = json_decode($json);
        B1AkunNeraca::truncate();
        foreach ($data as $key => $value) {
            B1AkunNeraca::create(
                [
                    'kode_akun' => $value->kode_akun,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'uraian' => $value->uraian,
                    'created_at' => now(),
                ]
            );
        }
    }
}
