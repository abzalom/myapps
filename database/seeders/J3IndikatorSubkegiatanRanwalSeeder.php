<?php

namespace Database\Seeders;

use App\Models\J3IndikatorSubkegiatanRanwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class J3IndikatorSubkegiatanRanwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/json/ranwalopd/subrincianrawal.json');
        // $data = json_decode($json);
        // J3IndikatorSubkegiatanRanwal::truncate();
        // foreach ($data as $key => $value) {
        //     J3IndikatorSubkegiatanRanwal::create([
        //         'a1_urusan_id' => $value->a1_urusan_id,
        //         'a2_bidang_id' => $value->a2_bidang_id,
        //         'a3_program_id' => $value->a3_program_id,
        //         'a4_kegiatan_id' => $value->a4_kegiatan_id,
        //         'a5_subkegiatan_id' => $value->a5_subkegiatan_id,
        //         'f1_perangkat_id' => $value->f1_perangkat_id,
        //         'i2_renja_opd_ranwal_id' => $value->i2_renja_opd_ranwal_id,
        //         'h1_pagu_opd_ranwal_id' => $value->h1_pagu_opd_ranwal_id,
        //         'e_klasifikasi_id' => $value->e_klasifikasi_id,
        //         'e_penerima_manfaat_id' => $value->e_penerima_manfaat_id,
        //         'rincian' => $value->rincian,
        //         'indikator' => $value->indikator,
        //         'target' => $value->target,
        //         'satuan' => $value->satuan,
        //         'anggaran' => $value->anggaran,
        //         'e_jenis_pekerjaan_id' => 1,
        //         'mulai' => $value->mulai,
        //         'selesai' => $value->selesai,
        //         'e_status_renja_id' => $value->e_status_renja_id,
        //         'keterangan' => $value->keterangan,
        //     ]);
        // }
    }
}
