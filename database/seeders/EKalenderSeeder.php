<?php

namespace Database\Seeders;

use App\Models\EKalender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EKalenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/e_kalenders.json');
        $data = json_decode($json);
        EKalender::truncate();
        foreach ($data as $value) {
            EKalender::create([
                'bulan' => $value->bulan,
            ]);
        }
    }
}
