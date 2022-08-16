<?php

namespace Database\Seeders;

use App\Models\F2Tagging;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class F2TaggingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        F2Tagging::truncate();
        $json = File::get('storage/app/public/backup/F2Tagging.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            F2Tagging::create(
                [
                    'f1_perangkat_id' => $value->f1_perangkat_id,
                    'a1_urusan_id' => $value->a1_urusan_id,
                    'a2_bidang_id' => $value->a2_bidang_id,
                    'kode_perangkat' => $value->kode_perangkat,
                    'tahun' => $value->tahun,
                    'kode_urut' => $value->kode_urut,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                ]
            );
        }
    }
}
