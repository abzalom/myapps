<?php

namespace Database\Seeders;

use App\Models\EKelompokBidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EKelompokBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'uraian' => 'sosbud',
                'keterangan' => 'sosial dan kebudayaan',
            ],
            [
                'uraian' => 'ekonomi',
                'keterangan' => 'ekonomi',
            ],
            [
                'uraian' => 'fispra',
                'keterangan' => 'fisik dan prasarana',
            ],
        ];

        foreach ($data as $value) {
            EKelompokBidang::create($value);
        }
    }
}
