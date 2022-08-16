<?php

namespace Database\Seeders;

use App\Models\C1AkunLra;
use Database\Seeders\Data\Rekening\Lra\DataLraAkun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class C1AkunLraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        C1AkunLra::truncate();
        $data = new DataLraAkun;

        collect($data->data())->each(function ($query) {
            C1AkunLra::create($query);
        });
    }
}
