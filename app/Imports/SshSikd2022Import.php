<?php

namespace App\Imports;

use App\Models\K1SshTag;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\D6SubrincianLo;
use App\Models\C6SubrincianLra;
use App\Models\B6SubrincianNeraca;
use App\Models\Ssh1Tag2022;
use App\Models\Ssh2Kategori2022;
use App\Models\SshSikd_2022;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SshSikd2022Import implements ToModel, WithHeadingRow
{
    // public function limit(): int
    // {
    //     return 50;
    // }

    public function model(array $row)
    {
        // return $this->tahun;
        // dump($row);
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
        // if (!$kategori) {
        //     dump($row);
        //     // dump($neraca->toArray());
        // }

        $ssh1tag2022 = Ssh1Tag2022::firstOrCreate(
            [
                'kode_unik_subrincian' => $rekening->kode_unik_subrincian,
                'tahun' => '2024',
            ],
            [
                'kode_unik_akun' => $rekening->kode_unik_akun,
                'kode_unik_kelompok' => $rekening->kode_unik_kelompok,
                'kode_unik_jenis' => $rekening->kode_unik_jenis,
                'kode_unik_objek' => $rekening->kode_unik_objek,
                'kode_unik_rincian' => $rekening->kode_unik_rincian,
            ]
        );
        $ssh2kategori2022 = Ssh2Kategori2022::firstOrCreate(
            [
                'kode_unik_subrincian' => $kategori->kode_unik_subrincian,
                'tahun' => '2022',
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

        $row['rekening_akun'] = $ssh1tag2022->kode_unik_akun;
        $row['rekening_kelompok'] = $ssh1tag2022->kode_unik_kelompok;
        $row['rekening_jenis'] = $ssh1tag2022->kode_unik_jenis;
        $row['rekening_objek'] = $ssh1tag2022->kode_unik_objek;
        $row['rekening_rincian'] = $ssh1tag2022->kode_unik_rincian;
        $row['rekening_subrincian'] = $ssh1tag2022->kode_unik_subrincian;
        $row['kategori_akun'] = $ssh2kategori2022->kode_unik_akun;
        $row['kategori_kelompok'] = $ssh2kategori2022->kode_unik_kelompok;
        $row['kategori_jenis'] = $ssh2kategori2022->kode_unik_jenis;
        $row['kategori_objek'] = $ssh2kategori2022->kode_unik_objek;
        $row['kategori_rincian'] = $ssh2kategori2022->kode_unik_rincian;
        $row['kategori_subrincian'] = $ssh2kategori2022->kode_unik_subrincian;
        $row['kategori_kode'] = $ssh2kategori2022->kategori_kode;
        $row['kategori_name'] = $ssh2kategori2022->kategori_name;
        $row['tahun'] = '2022';

        $row['kode_urut_komponen'] = $row['kode'];
        unset($row['kode']);

        $count = SshSikd_2022::where([
            'rekening_subrincian' => $ssh1tag2022->kode_unik_subrincian,
            'kategori_subrincian' => $ssh2kategori2022->kode_unik_subrincian,
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
        $row['jenis'] = $row['jenis_produk'];
        SshSikd_2022::create($row);

        // $row['zonasi'] = strtolower($row['zonasi']) == 'ya' ? true : false;

        // dump($row);
    }
}
