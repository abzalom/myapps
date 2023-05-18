<?php

namespace Database\Seeders;

use App\Models\TagKategoriBelanja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TagKategoriBelanjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('storage/app/public/json/database/myapps/tag_kategori_belanjas.json');
        $data = json_decode($json);
        TagKategoriBelanja::truncate();
        foreach ($data as $key => $value) {
            TagKategoriBelanja::create([
                'kode_kategori' => $value->kode_kategori,
                'kategori_uraian' => $value->kategori_uraian,
                'kode_belanja' => $value->kode_belanja,
                'kategori_ssh' => $value->kategori_ssh,
                'kode_kategori_ssh' => $value->kode_kategori_ssh,
            ]);
        }
    }
}
