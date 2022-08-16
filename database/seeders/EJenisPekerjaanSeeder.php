<?php

namespace Database\Seeders;

use App\Models\EJenisPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EJenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EJenisPekerjaan::truncate();
        EJenisPekerjaan::insert([
            [
                'uraian' => 'Fisik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uraian' => 'Non Fisik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
