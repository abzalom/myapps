<?php

namespace Database\Seeders;

use App\Models\C6SubrincianLra;
use Database\Seeders\Data\Rekening\Lra\DataLraSubRincian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C6SubrincianLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C6SubrincianLra::truncate();
        $data = new DataLraSubRincian;

        collect($data->data())->each(function ($query) {
            C6SubrincianLra::create($query);
        });
    }
}
