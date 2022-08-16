<?php

namespace Database\Seeders;

use App\Models\EPenerimaManfaat;
use Database\Seeders\Data\Pendukung\DataPenerimaManfaat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EPenerimaManfaatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EPenerimaManfaat::truncate();
        $data = new DataPenerimaManfaat;
        collect($data->data())->each(function ($query) {
            EPenerimaManfaat::create($query);
        });
    }
}
