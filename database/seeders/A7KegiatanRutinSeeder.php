<?php

namespace Database\Seeders;

use App\Models\A7KegiatanRutin;
use Database\Seeders\Data\Rutin\DataRutinKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A7KegiatanRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/backup/A7KegiatanRutin.json');
        // $data = json_decode($json);
        $json = File::get('storage/app/public/json/database/myapps/a7_kegiatan_rutins.json');
        $data = json_decode($json);
        A7KegiatanRutin::truncate();
        foreach ($data as $key => $value) {
            A7KegiatanRutin::create([
                'a6_program_rutin_id' => $value->a6_program_rutin_id,
                'kode_program' => $value->kode_program,
                'kode_kegiatan' => $value->kode_kegiatan,
                'kode_unik_program' => $value->kode_unik_program,
                'kode_unik_kegiatan' => $value->kode_unik_kegiatan,
                'uraian' => $value->uraian,
                'kinerja' => $value->kinerja,
                'indikator' => $value->indikator,
                'satuan' => $value->satuan,
                'keterangan' => $value->keterangan,
            ]);
        }
    }
}
