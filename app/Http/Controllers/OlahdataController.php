<?php

namespace App\Http\Controllers;

use App\Imports\SshSikd2022Import;
use App\Models\A2Bidang;
use App\Models\B6SubrincianNeraca;
use App\Models\D6SubrincianLo;
use App\Models\EZonasi;
use App\Models\K1SshTag;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\Ssh1Tag2022;
use App\Models\Ssh2Kategori2022;
use App\Models\SshSikd_2021;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

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
        // $kategoris = K2SshKategori::whereIn('kategori_kode', [1])->where('tahun', $this->tahun->tahun)->get('kode_unik_subrincian');
        $kategoris = Ssh2Kategori2022::where('tahun', $this->tahun->tahun)->get('kode_unik_subrincian');
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
            // 'sshsikd2022' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => 1]),
            'sshsikd2022',
            'sshsikd2022.zonasi',
            'sshsikd2022.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['subrincian'])
            ->where('kode_kategori_ssh', 1)
            ->get();
        // dump($ssh->toArray());
        return view('olahdata.standarharga2022', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Standar Harga 2022',
            'sshs' => $ssh,
            'zonasis' => EZonasi::all(),
        ]);
    }

    public function standarharga_2022_cetak()
    {
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

    public function standarharga_2022upload(Request $request)
    {
        return $request->all();
        $file = $request->file('file');
        Excel::import(new SshSikd2022Import, $file);
        return redirect()->back()->with('pesan', '<div class="alert alert-info">File Standar Harga 2022 <strong>' . $file->getClientOriginalName() . '</strong> Berhasil Diupload!</div>');
    }

    public function standarharga_2022cetak()
    {
        $kategoris = Ssh2Kategori2022::get('kode_unik_subrincian');
        $rekenings = Ssh1Tag2022::get('kode_unik_subrincian');
        $kodes = [];
        if (count($kategoris) == 0) {
            $kodes['kategori'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
            $kodes['rekening'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
        } else {
            foreach ($kategoris as $value) {
                $kodes['kategori']['subrincian'][] = $value->kode_unik_subrincian;
            }
            foreach ($rekenings as $value) {
                $kodes['rekening']['subrincian'][] = $value->kode_unik_subrincian;
            }
        }
        $ssh1 = B6SubrincianNeraca::with([
            // 'sshsikd2022' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => 1]),
            'sshsikd2022',
            'sshsikd2022.zonasi',
            'sshsikd2022.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            // ->limit(10)
            ->get();
        $ssh2 = D6SubrincianLo::with([
            // 'sshsikd2022' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => 1]),
            'sshsikd2022',
            'sshsikd2022.zonasi',
            'sshsikd2022.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            // ->limit(10)
            ->get();
        // dump($kodes['rekening']);
        $ssh = $ssh1->merge($ssh2);
        // dump($ssh->toArray());
        // die;
        $kelompok = [
            [
                'kode' => 1,
                'nama' => 'Standar Satuan Harga (SSH)',
            ],
            [
                'kode' => 2,
                'nama' => 'Harga Satuan Pokok Kegiatan (HSPK)',
            ],
            [
                'kode' => 3,
                'nama' => 'Analisa Standar Belenja',
            ],
            [
                'kode' => 4,
                'nama' => 'Standar Biaya Umum (SBU)',
            ],
        ];
        return view('olahdata.standarharga2022cetak', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Standar Harga 2022',
            'sshs' => $ssh,
            'kelompok' => $kelompok,
            'zonasis' => EZonasi::all(),
        ]);
    }
    public function standarharga_2022cetak_versi2()
    {
        $kategoris = Ssh2Kategori2022::get('kode_unik_subrincian');
        $rekenings = Ssh1Tag2022::get('kode_unik_subrincian');
        $kodes = [];
        if (count($kategoris) == 0) {
            $kodes['kategori'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
            $kodes['rekening'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
        } else {
            foreach ($kategoris as $value) {
                $kodes['kategori']['subrincian'][] = $value->kode_unik_subrincian;
            }
            foreach ($rekenings as $value) {
                $kodes['rekening']['subrincian'][] = $value->kode_unik_subrincian;
            }
        }
        $ssh1 = B6SubrincianNeraca::with([
            'sshsikd2022',
            'sshsikd2022.zonasi',
            'sshsikd2022.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            ->limit(10)
            ->get();
        $ssh2 = D6SubrincianLo::with([
            'sshsikd2022',
            'sshsikd2022.zonasi',
            'sshsikd2022.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            ->limit(10)
            ->get();
        $ssh = $ssh1->merge($ssh2);
        $kelompok = [
            [
                'kode' => 1,
                'nama' => 'Standar Satuan Harga (SSH)',
            ],
            [
                'kode' => 2,
                'nama' => 'Harga Satuan Pokok Kegiatan (HSPK)',
            ],
            [
                'kode' => 3,
                'nama' => 'Analisa Standar Belenja',
            ],
            [
                'kode' => 4,
                'nama' => 'Standar Biaya Umum (SBU)',
            ],
        ];
        return view('olahdata.standarharga2022cetak_versi2', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Standar Harga 2022',
            'sshs' => $ssh,
            'kelompok' => $kelompok,
            'zonasis' => EZonasi::all(),
        ]);
    }

    public function standarharga_2023cetak()
    {
        $kategoris = K2SshKategori::get('kode_unik_subrincian');
        $rekenings = K1SshTag::get('kode_unik_subrincian');
        $kodes = [];
        if (count($kategoris) == 0) {
            $kodes['kategori'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
            $kodes['rekening'] = [
                'akun' => [null],
                'kelompok' => [null],
                'jenis' => [null],
                'objek' => [null],
                'rincian' => [null],
                'subrincian' => [null],
            ];
        } else {
            foreach ($kategoris as $value) {
                $kodes['kategori']['subrincian'][] = $value->kode_unik_subrincian;
            }
            foreach ($rekenings as $value) {
                $kodes['rekening']['subrincian'][] = $value->kode_unik_subrincian;
            }
        }

        $ssh1 = B6SubrincianNeraca::with([
            'komponen',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            // ->limit(10)
            ->get();
        $ssh2 = D6SubrincianLo::with([
            'komponen',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['kategori']['subrincian'])
            // ->limit(10)
            ->get();
        $ssh = $ssh1->merge($ssh2);

        return view('olahdata.standarharga2023cetak', [
            'title' => 'Olah Data',
            'desc' => 'Olah Data Standar Harga 2022',
            'sshs' => $ssh,
            'zonasis' => EZonasi::all(),
        ]);
    }
}
