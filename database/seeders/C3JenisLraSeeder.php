<?php

namespace Database\Seeders;

use App\Models\C3JenisLra;
use Database\Seeders\Data\Rekening\Lra\DataLraJenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C3JenisLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C3JenisLra::truncate();

        $data = new DataLraJenis;

        collect($data->data())->each(function ($query) {
            C3JenisLra::create($query);
        });
    }
}
