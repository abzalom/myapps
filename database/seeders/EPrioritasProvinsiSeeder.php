<?php

namespace Database\Seeders;

use App\Models\EPrioritasProvinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EPrioritasProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EPrioritasProvinsi::truncate();
    }
}
