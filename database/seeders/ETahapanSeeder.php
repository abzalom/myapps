<?php

namespace Database\Seeders;

use App\Models\ETahapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ETahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ETahapan::truncate();
        $data = [
            [
                'uraian' => 'Rancangan Awal',
                'singkat' => 'ranwal',
                'is_active' => true,
            ],
            [
                'uraian' => 'Rancangan',
                'singkat' => 'Rancangan',
                'is_active' => false,
            ],
            [
                'uraian' => 'Rancangan Akhir',
                'singkat' => 'rankir',
                'is_active' => false,
            ],
        ];

        ETahapan::insert($data);
    }
}
