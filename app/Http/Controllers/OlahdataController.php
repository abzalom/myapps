<?php

namespace App\Http\Controllers;

use App\Models\A2Bidang;
use App\Models\B6SubrincianNeraca;
use App\Models\EZonasi;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\SshSikd_2021;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OlahdataController extends Controller
{

    public function nomenklatur()
    {
        return view('olahdata.nomenklatur', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Nomeklatur',
            'bidangs' => A2Bidang::all(),
        ]);
    }

    public function standarharga_2022()
    {
        $kategoris = K2SshKategori::whereIn('kategori_kode', [1])->where('tahun', $this->tahun->tahun)->get('kode_unik_subrincian');
        $kodes = [];
        if (count($kategoris) == 0) {
            $kodes = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
        } else {
            foreach ($kategoris as $value) {
                $kodes['subrincian'][] = $value->kode_unik_subrincian;
            }
        }
        $ssh = B6SubrincianNeraca::with([
            'sshsikd' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => 1]),
            'sshsikd.zonasi',
            'sshsikd.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['subrincian'])
            ->where('kode_kategori_ssh', 1)
            ->get();
        return view('olahdata.standarharga2022', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Standar Harga 2022',
            'sshs' => $ssh,
            'zonasis' => EZonasi::all(),
        ]);
    }

    public function standarharga_2022salin()
    {
        // $data = K3SshKomponen::withTrashed()->get();
        // SshSikd_2021::truncate();
        // foreach ($data as $value) {
        //     SshSikd_2021::create(
        //         [
        //             'id' => $value->id,
        //             'rekening_akun' => $value->rekening_akun,
        //             'rekening_kelompok' => $value->rekening_kelompok,
        //             'rekening_jenis' => $value->rekening_jenis,
        //             'rekening_objek' => $value->rekening_objek,
        //             'rekening_rincian' => $value->rekening_rincian,
        //             'rekening_subrincian' => $value->rekening_subrincian,
        //             'kategori_akun' => $value->kategori_akun,
        //             'kategori_kelompok' => $value->kategori_kelompok,
        //             'kategori_jenis' => $value->kategori_jenis,
        //             'kategori_objek' => $value->kategori_objek,
        //             'kategori_rincian' => $value->kategori_rincian,
        //             'kategori_subrincian' => $value->kategori_subrincian,
        //             'kategori_kode' => $value->kategori_kode,
        //             'kategori_name' => $value->kategori_name,
        //             'kode_urut_komponen' => $value->kode_urut_komponen,
        //             'uraian' => $value->uraian,
        //             'spesifikasi' => $value->spesifikasi,
        //             'harga' => $value->harga,
        //             'satuan' => $value->satuan,
        //             'inflasi' => $value->inflasi,
        //             'e_jenis_komponen_id' => $value->e_jenis_komponen_id,
        //             'tahun' => $value->tahun,
        //             'deleted_at' => $value->deleted_at,
        //             'created_at' => $value->created_at,
        //             'updated_at' => $value->updated_at,
        //         ]
        //     );
        // }
        // return Redirect::route('olahdata.standarharga_2022');
    }
}
