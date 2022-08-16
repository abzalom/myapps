<?php

namespace Database\Seeders;

use App\Models\ETahunAnggaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ETahunAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ETahunAnggaran::truncate();
        ETahunAnggaran::insert([
            [
                'tahun' => '2022',
                'is_active' => true,
            ],
            [
                'tahun' => '2023',
                'is_active' => false,
            ],
        ]);
    }
}
