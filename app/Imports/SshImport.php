<?php

namespace App\Imports;

use App\Models\K1SshTag;
use Illuminate\Support\Arr;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\C6SubrincianLra;
use App\Models\B6SubrincianNeraca;
use App\Models\D6SubrincianLo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SshImport implements ToModel, WithHeadingRow
{
    public $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }
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

        $k1sshtag = K1SshTag::firstOrCreate(
            [
                'kode_unik_subrincian' => $rekening->kode_unik_subrincian,
                'tahun' => $this->tahun,
            ],
            [
                'kode_unik_akun' => $rekening->kode_unik_akun,
                'kode_unik_kelompok' => $rekening->kode_unik_kelompok,
                'kode_unik_jenis' => $rekening->kode_unik_jenis,
                'kode_unik_objek' => $rekening->kode_unik_objek,
                'kode_unik_rincian' => $rekening->kode_unik_rincian,
            ]
        );
        $k2sshkategori = K2SshKategori::firstOrCreate(
            [
                'kode_unik_subrincian' => $kategori->kode_unik_subrincian,
                'tahun' => $this->tahun,
            ],
            [
                'kode_unik_akun' => $kategori->kode_unik_akun,
                'kode_unik_kelompok' => $kategori->kode_unik_kelompok,
                'kode_unik_jenis' => $kategori->kode_unik_jenis,
                'kode_unik_objek' => $kategori->kode_unik_objek,
                'kode_unik_rincian' => $kategori->kode_unik_rincian,
                'kategori_kode' => $kategori->kode_kategori_ssh,
                'kategori_name' => $kategori->kategori_ssh,
            ]
        );

        if ($k1sshtag->kode_unik_subrincian == $row['rekening'] && $k2sshkategori->kode_unik_subrincian == $row['kode']) {
            $row['rekening_akun'] = $k1sshtag->kode_unik_akun;
            $row['rekening_kelompok'] = $k1sshtag->kode_unik_kelompok;
            $row['rekening_jenis'] = $k1sshtag->kode_unik_jenis;
            $row['rekening_objek'] = $k1sshtag->kode_unik_objek;
            $row['rekening_rincian'] = $k1sshtag->kode_unik_rincian;
            $row['rekening_subrincian'] = $k1sshtag->kode_unik_subrincian;
            $row['kategori_akun'] = $k2sshkategori->kode_unik_akun;
            $row['kategori_kelompok'] = $k2sshkategori->kode_unik_kelompok;
            $row['kategori_jenis'] = $k2sshkategori->kode_unik_jenis;
            $row['kategori_objek'] = $k2sshkategori->kode_unik_objek;
            $row['kategori_rincian'] = $k2sshkategori->kode_unik_rincian;
            $row['kategori_subrincian'] = $k2sshkategori->kode_unik_subrincian;
            $row['kategori_kode'] = $k2sshkategori->kategori_kode;
            $row['kategori_name'] = $k2sshkategori->kategori_name;
            $row['tahun'] = $this->tahun;
        }

        $row['kode_urut_komponen'] = $row['kode'];
        unset($row['kode']);

        $count = K3SshKomponen::where([
            'rekening_subrincian' => $k1sshtag->kode_unik_subrincian,
            'kategori_subrincian' => $k2sshkategori->kode_unik_subrincian,
        ])->first();
        $kode = "";
        if ($count == null) {
            $row['kode_urut_komponen'] = "001";
        }
        if ($count !== null) {
            $row['kode_urut_komponen'] =  strlen((int)$count->kode_urut_komponen) == 1 ? "00" . (int)$count->kode_urut_komponen + 1
                : (strlen((int)$count->kode_urut_komponen) == 2 ? "00" . (int)$count->kode_urut_komponen + 1
                    : (strlen((int)$count->kode_urut_komponen) == 3 ? "0" . (int)$count->kode_urut_komponen + 1
                        : (strlen((int)$count->kode_urut_komponen) == 4 ? (int)$count->kode_urut_komponen + 1
                            : (int)$count->kode_urut_komponen + 1)));
        }

        $row['e_jenis_komponen_id'] = $row['jenis_produk'];

        ltrim($row['uraian']);
        ltrim($row['spesifikasi']);
        ltrim($row['satuan']);

        $row['zonasi'] = strtolower($row['zonasi']) == 'ya' ? true : false;

        $row['jenis'] = $row['jenis_produk'];
        K3SshKomponen::create($row);
    }
}
