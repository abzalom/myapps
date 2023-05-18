<?php

namespace Database\Seeders;

use App\Models\A5Subkegiatan;
use Database\Seeders\Data\Nomenklatur\SubkegiatanData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A5SubkegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = new SubkegiatanData;
        // collect($data->data())->each(function ($query) {
        //     A5Subkegiatan::create($query);
        // });
        // $json = File::get('storage/app/public/backup/A5Subkegiatan.json');
        // $data = json_decode($json);
        $json = File::get('storage/app/public/json/database/myapps/a5_subkegiatans.json');
        $data = json_decode($json);
        A5Subkegiatan::truncate();
        foreach ($data as $key => $value) {
            A5Subkegiatan::create([
                'a1_urusan_id' => $value->a1_urusan_id,
                'a2_bidang_id' => $value->a2_bidang_id,
                'a3_program_id' => $value->a3_program_id,
                'a4_kegiatan_id' => $value->a4_kegiatan_id,
                'kode_urusan' => $value->kode_urusan,
                'kode_bidang' => $value->kode_bidang,
                'kode_program' => $value->kode_program,
                'kode_kegiatan' => $value->kode_kegiatan,
                'kode_subkegiatan' => $value->kode_subkegiatan,
                'kode_unik_urusan' => $value->kode_unik_urusan,
                'kode_unik_bidang' => $value->kode_unik_bidang,
                'kode_unik_program' => $value->kode_unik_program,
                'kode_unik_kegiatan' => $value->kode_unik_kegiatan,
                'kode_unik_subkegiatan' => $value->kode_unik_subkegiatan,
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
