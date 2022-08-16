<?php

namespace Database\Seeders;

use App\Models\EStatusRenja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EStatusRenjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EStatusRenja::truncate();
        EStatusRenja::insert([
            ['status' => 'usulan',],
            ['status' => 'disetujui',],
            ['status' => 'perbaikan',],
            ['status' => 'ditolak',],
        ]);
    }
}
