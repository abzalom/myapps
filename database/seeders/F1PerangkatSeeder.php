<?php

namespace Database\Seeders;

use App\Models\F1Perangkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class F1PerangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // F1Perangkat::truncate();
        $json = File::get('storage/app/public/backup/F1Perangkat.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            F1Perangkat::create(
                [
                    'kode_urut' => $value->kode_urut,
                    'nama_perangkat' => $value->nama_perangkat,
                    'kode_perangkat' => $value->kode_perangkat,
                    'tahun' => $value->tahun,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                ]
            );
        }
    }
}