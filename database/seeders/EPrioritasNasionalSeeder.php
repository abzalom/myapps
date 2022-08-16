<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EPrioritasNasional;
use Database\Seeders\Data\Pendukung\DataPrionas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EPrioritasNasionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EPrioritasNasional::truncate();
        $data = new DataPrionas;
        collect($data->data())->each(function ($query) {
            EPrioritasNasional::create($query);
        });
    }
}
