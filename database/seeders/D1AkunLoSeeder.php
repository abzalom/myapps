<?php

namespace Database\Seeders;

use App\Models\D1AkunLo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class D1AkunLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/json/rekening/lo/1LoAkun.json');
        $json = File::get('storage/app/public/json/database/myapps/d1_akun_los.json');
        $data = json_decode($json);
        D1AkunLo::truncate();
        foreach ($data as $key => $value) {
            D1AkunLo::create(
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
