<?php

namespace Database\Seeders;

use App\Models\A4Kegiatan;
use Database\Seeders\Data\Nomenklatur\KegiatanData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A4KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = new KegiatanData;
        // collect($data->data())->each(function ($query) {
        //     A4Kegiatan::create($query);
        // });
        // $json = File::get('storage/app/public/json/nomen050_5889_2021/perbaikan/kegiatan.json');
        // $data = json_decode($json);
        // A4Kegiatan::truncate();
        // foreach ($data as $key => $value) {
        //     A4Kegiatan::create([
        //         'a1_urusan_id' => $value->a1_urusan_id,
        //         'a2_bidang_id' => $value->a2_bidang_id,
        //         'a3_program_id' => $value->a3_program_id,
        //         'kode_urusan' => $value->kode_urusan,
        //         'kode_bidang' => $value->kode_bidang,
        //         'kode_program' => $value->kode_program,
        //         'kode_kegiatan' => $value->kode_kegiatan,
        //         'kode_unik_urusan' => $value->kode_unik_urusan,
        //         'kode_unik_bidang' => $value->kode_unik_bidang,
        //         'kode_unik_program' => $value->kode_unik_program,
        //         'kode_unik_kegiatan' => $value->kode_unik_kegiatan,
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

        $json = File::get('storage/app/public/json/database/myapps/a4_kegiatans.json');
        $data = json_decode($json);
        A4Kegiatan::truncate();
        foreach ($data as $key => $value) {
            A4Kegiatan::create([
                'a1_urusan_id' => $value->a1_urusan_id,
                'a2_bidang_id' => $value->a2_bidang_id,
                'a3_program_id' => $value->a3_program_id,
                'kode_urusan' => $value->kode_urusan,
                'kode_bidang' => $value->kode_bidang,
                'kode_program' => $value->kode_program,
                'kode_kegiatan' => $value->kode_kegiatan,
                'kode_unik_urusan' => $value->kode_unik_urusan,
                'kode_unik_bidang' => $value->kode_unik_bidang,
                'kode_unik_program' => $value->kode_unik_program,
                'kode_unik_kegiatan' => $value->kode_unik_kegiatan,
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
