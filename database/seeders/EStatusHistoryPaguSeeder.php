<?php

namespace Database\Seeders;

use App\Models\EStatusHistoryPagu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EStatusHistoryPaguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EStatusHistoryPagu::truncate();
        EStatusHistoryPagu::insert([
            [
                'uraian' => 'baru',
            ],
            [
                'uraian' => 'bertambah',
            ],
            [
                'uraian' => 'berkurang',
            ],
            [
                'uraian' => 'dihapus',
            ],
            [
                'uraian' => 'dipindahkan',
            ],
        ]);
    }
}
