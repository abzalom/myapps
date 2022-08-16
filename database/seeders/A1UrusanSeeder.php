<?php

namespace Database\Seeders;

use App\Models\A1Urusan;
use Database\Seeders\Data\Nomenklatur\UrusanData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A1UrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = new UrusanData;
        // collect($data->data())->each(function ($query) {
        //     A1Urusan::create($query);
        // });
        A1Urusan::truncate();
        $json = File::get('storage/app/public/json/nomen050_5889_2021/perbaikan/urusan.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            A1Urusan::create([
                'kode_urusan' => $value->kode_urusan,
                'kode_unik_urusan' => $value->kode_unik_urusan,
                'uraian' => $value->uraian,
                'kinerja' => $value->kinerja,
                'indikator' => $value->indikator,
                'satuan' => $value->satuan,
                'keterangan' => $value->keterangan,
                'kewenangan' => $value->kewenangan,
            ]);
        }
    }
}
