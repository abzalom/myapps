<?php

namespace Database\Seeders;

use App\Models\EJenisKomponen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EJenisKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EJenisKomponen::truncate();
        EJenisKomponen::insert([
            [
                'uraian' => 'Produk Dalam Negeri',
            ],
            [
                'uraian' => 'Produk Luar Negeri',
            ]
        ]);
    }
}
