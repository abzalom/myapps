<?php

namespace Database\Seeders;

use App\Models\C5RincianLra;
use Database\Seeders\Data\Rekening\Lra\DataLraRincianObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C5RincianLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C5RincianLra::truncate();

        $data = new DataLraRincianObjek;

        collect($data->data())->each(function ($query) {
            C5RincianLra::create($query);
        });
    }
}
