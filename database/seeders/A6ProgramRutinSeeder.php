<?php

namespace Database\Seeders;

use App\Models\A6ProgramRutin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class A6ProgramRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        A6ProgramRutin::truncate();
        A6ProgramRutin::create([
            'kode_program' => '01',
            'kode_unik_program' => '01',
            'uraian' => 'PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA',
        ]);
    }
}
