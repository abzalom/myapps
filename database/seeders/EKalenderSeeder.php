<?php

namespace Database\Seeders;

use App\Models\EKalender;
use Database\Seeders\Data\Pendukung\DataKalender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EKalenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EKalender::truncate();
        $data = new DataKalender;
        collect($data->data())->each(function ($query) {
            EKalender::create($query);
        });
    }
}
