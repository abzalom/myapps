<?php

namespace Database\Seeders;

use App\Models\C1AkunLra;
use Database\Seeders\Data\Rekening\Lra\DataLraAkun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class C1AkunLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/c1_akun_lras.json');
        $data = json_decode($json);
        C1AkunLra::truncate();
        foreach ($data as $key => $value) {
            C1AkunLra::create(
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
