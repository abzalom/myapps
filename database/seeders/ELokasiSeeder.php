<?php

namespace Database\Seeders;

use App\Models\ELokasi;
use Database\Seeders\Data\Pendukung\DataLokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ELokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ELokasi::truncate();
        $data = new DataLokasi;
        collect($data->data())->each(function ($query) {
            ELokasi::create($query);
        });
    }
}
