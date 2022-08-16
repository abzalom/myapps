<?php

namespace Database\Seeders;

use App\Models\A3Program;
use Database\Seeders\Data\Nomenklatur\ProgramData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class A3ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = new ProgramData;
        // collect($data->data())->each(function ($query) {
        //     A3Program::create($query);
        // });
        A3Program::truncate();
        $json = File::get('storage/app/public/json/nomen050_5889_2021/perbaikan/program.json');
        $data = json_decode($json);
        foreach ($data as $key => $value) {
            A3Program::create([
                'a1_urusan_id' => $value->a1_urusan_id,
                'a2_bidang_id' => $value->a2_bidang_id,
                'kode_urusan' => $value->kode_urusan,
                'kode_bidang' => $value->kode_bidang,
                'kode_program' => $value->kode_program,
                'kode_unik_urusan' => $value->kode_unik_urusan,
                'kode_unik_bidang' => $value->kode_unik_bidang,
                'kode_unik_program' => $value->kode_unik_program,
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
