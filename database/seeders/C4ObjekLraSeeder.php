<?php

namespace Database\Seeders;

use App\Models\C4ObjekLra;
use Database\Seeders\Data\Rekening\Lra\DataLraObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C4ObjekLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C4ObjekLra::truncate();

        $data = new DataLraObjek;

        collect($data->data())->each(function ($query) {
            C4ObjekLra::create($query);
        });
    }
}
