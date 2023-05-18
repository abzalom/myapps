<?php

namespace Database\Seeders;

use App\Models\G4PendapatanUraianRankir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class G4PendapatanUraianRankirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/g4_pendapatan_uraian_rankirs.json');
        $data = json_decode($json);
        G4PendapatanUraianRankir::truncate();
        foreach ($data as $key => $value) {
            G4PendapatanUraianRankir::create([
                'c1_akun_lra_id' => $value->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $value->c3_jenis_lra_id,
                'c4_objek_lra_id' => $value->c4_objek_lra_id,
                'c5_rincian_lra_id' => $value->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $value->c6_subrincian_lra_id,
                'g1_pendapatan_id' => $value->g1_pendapatan_id,
                'kode' => $value->kode,
                'kode_unik' => $value->kode_unik,
                'uraian' => $value->uraian,
                'anggaran' => $value->anggaran,
                'tahun' => $value->tahun,
            ]);
        }
    }
}
