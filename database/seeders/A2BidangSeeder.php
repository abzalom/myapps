<?php

namespace Database\Seeders;

use App\Models\A2Bidang;
use Database\Seeders\Data\Nomenklatur\BidangData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A2BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = new BidangData;
        // collect($data->data())->each(function ($query) {
        //     A2Bidang::create($query);
        // });
        // $json = File::get('storage/app/public/json/nomen050_5889_2021/perbaikan/bidang.json');
        // $data = json_decode($json);
        // A2Bidang::truncate();
        // foreach ($data as $key => $value) {
        //     A2Bidang::create([
        //         'a1_urusan_id' => $value->a1_urusan_id,
        //         'kode_urusan' => $value->kode_urusan,
        //         'kode_bidang' => $value->kode_bidang,
        //         'kode_unik_urusan' => $value->kode_unik_urusan,
        //         'kode_unik_bidang' => $value->kode_unik_bidang,
        //         'uraian' => $value->uraian,
        //         'kinerja' => $value->kinerja,
        //         'indikator' => $value->indikator,
        //         'satuan' => $value->satuan,
        //         'keterangan' => $value->keterangan,
        //         'kewenangan' => $value->kewenangan,
        //     ]);
        // }



        /**
         * 
         * Praktek
         * 
         */

        $json = File::get('storage/app/public/json/database/myapps/a2_bidangs.json');
        $data = json_decode($json);
        A2Bidang::truncate();
        foreach ($data as $key => $value) {
            A2Bidang::create([
                'a1_urusan_id' => $value->a1_urusan_id,
                'kode_urusan' => $value->kode_urusan,
                'kode_bidang' => $value->kode_bidang,
                'kode_unik_urusan' => $value->kode_unik_urusan,
                'kode_unik_bidang' => $value->kode_unik_bidang,
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
