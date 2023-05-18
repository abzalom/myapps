<?php

namespace Database\Seeders;

use App\Models\B6SubrincianNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class B6SubrincianNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $json = File::get('storage/app/public/json/rekening/neraca/with_id/6NeracaSubrincian.json');
        $json = File::get('storage/app/public/json/database/myapps/b6_subrincian_neracas.json');
        $data = json_decode($json);
        B6SubrincianNeraca::truncate();
        foreach ($data as $key => $value) {
            B6SubrincianNeraca::create(
                [
                    'b1_akun_neraca_id' => $value->b1_akun_neraca_id,
                    'b2_kelompok_neraca_id' => $value->b2_kelompok_neraca_id,
                    'b3_jenis_neraca_id' => $value->b3_jenis_neraca_id,
                    'b4_objek_neraca_id' => $value->b4_objek_neraca_id,
                    'b5_rincian_neraca_id' => $value->b5_rincian_neraca_id,
                    'kode_akun' => $value->kode_akun,
                    'kode_kelompok' => $value->kode_kelompok,
                    'kode_jenis' => $value->kode_jenis,
                    'kode_objek' => $value->kode_objek,
                    'kode_rincian' => $value->kode_rincian,
                    'kode_subrincian' => $value->kode_subrincian,
                    'kode_unik_akun' => $value->kode_unik_akun,
                    'kode_unik_kelompok' => $value->kode_unik_kelompok,
                    'kode_unik_jenis' => $value->kode_unik_jenis,
                    'kode_unik_objek' => $value->kode_unik_objek,
                    'kode_unik_rincian' => $value->kode_unik_rincian,
                    'kode_unik_subrincian' => $value->kode_unik_subrincian,
                    'uraian' => $value->uraian,
                    'kategori_ssh' => $value->kategori_ssh,
                    'kode_kategori_ssh' => $value->kode_kategori_ssh,
                    'keterangan' => $value->keterangan,
                    // 'created_at' => now(),
                ]
            );
        }
    }
}
