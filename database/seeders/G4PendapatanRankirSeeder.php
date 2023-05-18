<?php

namespace Database\Seeders;

use App\Models\G4PendapatanRankir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class G4PendapatanRankirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/g4_pendapatan_rankirs.json');
        $data = json_decode($json);
        G4PendapatanRankir::truncate();
        foreach ($data as $key => $value) {
            G4PendapatanRankir::create([
                'c1_akun_lra_id' => $value->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $value->c3_jenis_lra_id,
                'c4_objek_lra_id' => $value->c4_objek_lra_id,
                'c5_rincian_lra_id' => $value->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $value->c6_subrincian_lra_id,
                'tahun' => $value->tahun,
            ]);
        }
    }
}
