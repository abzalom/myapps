<?php

namespace Database\Seeders;

use App\Models\EKlasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EKlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/e_klasifikasis.json');
        $data = json_decode($json);
        EKlasifikasi::truncate();
        foreach ($data as $value) {
            EKlasifikasi::create([
                'uraian' => $value->uraian,
            ]);
        }
    }
}
