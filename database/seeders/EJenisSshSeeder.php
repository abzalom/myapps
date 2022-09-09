<?php

namespace Database\Seeders;

use App\Models\EJenisSsh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EJenisSshSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'jenis_ssh' => 'satuan biaya honorarium',
            ],
            [
                'jenis_ssh' => 'satuan biaya perjalanan dinas',
            ],
            [
                'jenis_ssh' => 'satuan biaya paket kegiatan rapat atau pertemuan di luar kantor',
            ],
            [
                'jenis_ssh' => 'satuan biaya pengadaan kendaraan dinas',
            ],
            [
                'jenis_ssh' => 'satuan belanja barang dan jasa',
            ],
        ];
        foreach ($data as $value) {
            // dump($value);
            EJenisSsh::create($value);
        }
    }
}
