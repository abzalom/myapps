<?php

namespace Database\Seeders;

use App\Models\C2KelompokLra;
use Database\Seeders\Data\Rekening\Lra\DataLraKelompok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C2KelompokLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C2KelompokLra::truncate();
        $data = new DataLraKelompok;

        collect($data->data())->each(function ($query) {
            C2KelompokLra::create($query);
        });
    }
}
