<?php

namespace App\Imports;

use App\Models\B6SubrincianNeraca;
use App\Models\C6SubrincianLra;
use App\Models\D6SubrincianLo;
use App\Models\StandarHarga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StandarHargaImport implements ToModel, WithHeadingRow
{

    public $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $neraca = B6SubrincianNeraca::where('kode_unik_subrincian', $row['kode'])->select([
            'kode_unik_akun',
            'kode_unik_kelompok',
            'kode_unik_jenis',
            'kode_unik_objek',
            'kode_unik_rincian',
            'kode_unik_subrincian',
            'kategori_ssh',
            'kode_kategori_ssh',
        ])->first();
        $lo = D6SubrincianLo::where('kode_unik_subrincian', $row['kode'])->select([
            'kode_unik_akun',
            'kode_unik_kelompok',
            'kode_unik_jenis',
            'kode_unik_objek',
            'kode_unik_rincian',
            'kode_unik_subrincian',
            'kategori_ssh',
            'kode_kategori_ssh',
        ])->first();
        $rekening = C6SubrincianLra::where('kode_unik_subrincian', $row['rekening'])->select([
            'kode_unik_akun',
            'kode_unik_kelompok',
            'kode_unik_jenis',
            'kode_unik_objek',
            'kode_unik_rincian',
            'kode_unik_subrincian',
        ])->first();
        $kategori = $neraca ? $neraca : $lo;

        $data = [
            'rekening_akun' => $rekening ? $rekening->kode_unik_akun : null,
            'rekening_kelompok' => $rekening ? $rekening->kode_unik_kelompok : null,
            'rekening_jenis' => $rekening ? $rekening->kode_unik_jenis : null,
            'rekening_objek' => $rekening ? $rekening->kode_unik_objek : null,
            'rekening_rincian' => $rekening ? $rekening->kode_unik_rincian : null,
            'rekening_subrincian' => $rekening ? $rekening->kode_unik_subrincian : null,

            'kategori_akun' => $kategori ? $kategori->kode_unik_akun : null,
            'kategori_kelompok' => $kategori ? $kategori->kode_unik_kelompok : null,
            'kategori_jenis' => $kategori ? $kategori->kode_unik_jenis : null,
            'kategori_objek' => $kategori ? $kategori->kode_unik_objek : null,
            'kategori_rincian' => $kategori ? $kategori->kode_unik_rincian : null,
            'kategori_subrincian' => $kategori ? $kategori->kode_unik_subrincian : null,

            'uraian' => $row['uraian'],
            'spesifikasi' => $row['spesifikasi'],
            'satuan' => $row['satuan'],
            'harga_zona_1' => $row['harga_zona_1'],
            'harga_zona_2' => $row['harga_zona_2'],
            'harga_zona_3' => $row['harga_zona_3'],
            'kode_kelompok' => $kategori ? $kategori->kode_kategori_ssh : null,
            'nama_kelompok' => $kategori ? $kategori->kategori_ssh : null,
            'tahun' => $this->tahun,
        ];

        StandarHarga::create($data);
    }
}
