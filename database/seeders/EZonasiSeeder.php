<?php

namespace Database\Seeders;

use App\Models\EZonasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EZonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EZonasi::truncate();
        EZonasi::insert([
            [
                'uraian' => 'Zona 1',
                'persentasi' => 10.00,
            ],
            [
                'uraian' => 'Zona 2',
                'persentasi' => 15.00,
            ],
            [
                'uraian' => 'Zona 3',
                'persentasi' => 20.00,
            ],
        ]);
    }
}
