<?php

namespace Database\Seeders;

use App\Models\A8SubkegiatanRutin;
use Database\Seeders\Data\Rutin\DataRutinSubkegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A8SubkegiatanRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        A8SubkegiatanRutin::truncate();
        $json = File::get('storage/app/public/backup/A8SubkegiatanRutin.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            A8SubkegiatanRutin::create([
                'a6_program_rutin_id' => $value->a6_program_rutin_id,
                'a7_kegiatan_rutin_id' => $value->a7_kegiatan_rutin_id,
                'kode_program' => $value->kode_program,
                'kode_kegiatan' => $value->kode_kegiatan,
                'kode_subkegiatan' => $value->kode_subkegiatan,
                'kode_unik_program' => $value->kode_unik_program,
                'kode_unik_kegiatan' => $value->kode_unik_kegiatan,
                'kode_unik_subkegiatan' => $value->kode_unik_subkegiatan,
                'uraian' => $value->uraian,
                'kinerja' => $value->kinerja,
                'indikator' => $value->indikator,
                'satuan' => $value->satuan,
                'keterangan' => $value->keterangan,
            ]);
        }
    }
}
