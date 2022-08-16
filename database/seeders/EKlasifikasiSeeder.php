<?php

namespace Database\Seeders;

use App\Models\EKlasifikasi;
use Database\Seeders\Data\Pendukung\DataKlasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EKlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EKlasifikasi::truncate();
        $data = new DataKlasifikasi;
        collect($data->data())->each(function ($query) {
            EKlasifikasi::create($query);
        });
    }
}
