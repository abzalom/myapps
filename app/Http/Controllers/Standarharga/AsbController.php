<?php

namespace App\Http\Controllers\Standarharga;

use App\Models\EZonasi;
use App\Models\K1SshTag;
use Illuminate\Http\Request;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\C6SubrincianLra;
use App\Models\B6SubrincianNeraca;
use App\Http\Controllers\Controller;
use App\Models\D6SubrincianLo;

class AsbController extends Controller
{
    public function asb()
    {
        $kategoris = K2SshKategori::whereIn('kategori_kode', [3])->where('tahun', $this->tahun->tahun)->get('kode_unik_subrincian');
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
            'komponen' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => [3]]),
            'komponen.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['subrincian'])
            ->where('kode_kategori_ssh', 3)
            ->get();
        return view('standarharga.asb.asb', [
            'title' => 'Standar Harga | ASB',
            'desc' => 'Analisis Standar Belanja (ASB)',
            'ssh' => $ssh,
            'zonasis' => EZonasi::all(),
        ]);
    }

    public function asbstore(Request $request)
    {
        if ($request->get('kategori') == 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Ketegori barang belum dipilih!</div>');
        }
        if ($request->get('rekening') == 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Rekening belum dipilih!</div>');
        }

        $kategori = B6SubrincianNeraca::where('kode_unik_subrincian', $request->get('kategori'))->first();
        $rekening = C6SubrincianLra::where('kode_unik_subrincian', $request->get('rekening'))->first();
        $count = K3SshKomponen::where([
            'rekening_subrincian' => $rekening->kode_unik_subrincian,
            'kategori_subrincian' => $kategori->kode_unik_subrincian,
            'tahun' => $this->tahun->tahun,
        ])->orderBy('id')->get();
        $kode = "";
        if (count($count) == 0) {
            $kode = "00001";
        }
        if (count($count) == 1) {
            $kode = '0000' . count($count) + 1;
        }
        if (count($count) > 1) {
            $kode = strlen((int)$count[$count->keys()->last()]->kode_urut_komponen) == 1 ? '0000' . (int)$count[$count->keys()->last()]->kode_urut_komponen + 1
                : (strlen((int)$count[$count->keys()->last()]->kode_urut_komponen) == 2 ? '000' . (int)$count[$count->keys()->last()]->kode_urut_komponen + 1
                    : (strlen((int)$count[$count->keys()->last()]->kode_urut_komponen) == 3 ? '00' . (int)$count[$count->keys()->last()]->kode_urut_komponen + 1
                        : (strlen((int)$count[$count->keys()->last()]->kode_urut_komponen) == 4 ? '00' . (int)$count[$count->keys()->last()]->kode_urut_komponen + 1
                            : strlen((int)$count[$count->keys()->last()]->kode_urut_komponen))));
        }
        $k1sshtag = K1SshTag::firstOrCreate(
            [
                'kode_unik_subrincian' => $rekening->kode_unik_subrincian,
                'tahun' => $this->tahun->tahun,
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
                'tahun' => $this->tahun->tahun,
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

        $data = [
            'rekening_akun' => $rekening->kode_unik_akun,
            'rekening_kelompok' => $rekening->kode_unik_kelompok,
            'rekening_jenis' => $rekening->kode_unik_jenis,
            'rekening_objek' => $rekening->kode_unik_objek,
            'rekening_rincian' => $rekening->kode_unik_rincian,
            'rekening_subrincian' => $rekening->kode_unik_subrincian,
            'kategori_akun' => $kategori->kode_unik_akun,
            'kategori_kelompok' => $kategori->kode_unik_kelompok,
            'kategori_jenis' => $kategori->kode_unik_jenis,
            'kategori_objek' => $kategori->kode_unik_objek,
            'kategori_rincian' => $kategori->kode_unik_rincian,
            'kategori_subrincian' => $kategori->kode_unik_subrincian,
            'kategori_kode' => $kategori->kode_kategori_ssh,
            'kategori_name' => $kategori->kategori_ssh,
            'kode_urut_komponen' => $kode,
            'uraian' => $request->get('uraian'),
            'spesifikasi' => $request->get('spesifikasi'),
            'harga' => $request->get('harga'),
            'satuan' => $request->get('satuan'),
            'inflasi' => $request->get('inflasi'),
            'zonasi' => $request->zonasi == 1 ? true : false,
            'jenis' => $request->get('jenis'),
            'tahun' => $this->tahun->tahun,
        ];
        $createkomponen = K3SshKomponen::create($data);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Komponen Barang dengan nama <strong>' . $createkomponen->uraian . '</strong> berhasil ditambahkan</div>');
    }

    public function asbupdate(Request $request)
    {
        if ($request->get('kategori') == 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Ketegori barang belum dipilih!</div>');
        }
        if ($request->get('rekening') == 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Rekening belum dipilih!</div>');
        }
        $kategori = B6SubrincianNeraca::where('kode_unik_subrincian', $request->get('kategori'))->first();
        $rekening = C6SubrincianLra::where('kode_unik_subrincian', $request->get('rekening'))->first();
        $komponen = K3SshKomponen::find($request->get('idkomponen'));
        $k1sshtag = K1SshTag::firstOrCreate(
            [
                'kode_unik_subrincian' => $rekening->kode_unik_subrincian,
                'tahun' => $komponen->tahun,
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
                'tahun' => $komponen->tahun,
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

        $komponen->rekening_akun = $rekening->kode_unik_akun;
        $komponen->rekening_kelompok = $rekening->kode_unik_kelompok;
        $komponen->rekening_jenis = $rekening->kode_unik_jenis;
        $komponen->rekening_objek = $rekening->kode_unik_objek;
        $komponen->rekening_rincian = $rekening->kode_unik_rincian;
        $komponen->rekening_subrincian = $rekening->kode_unik_subrincian;
        $komponen->kategori_akun = $kategori->kode_unik_akun;
        $komponen->kategori_kelompok = $kategori->kode_unik_kelompok;
        $komponen->kategori_jenis = $kategori->kode_unik_jenis;
        $komponen->kategori_objek = $kategori->kode_unik_objek;
        $komponen->kategori_rincian = $kategori->kode_unik_rincian;
        $komponen->kategori_subrincian = $kategori->kode_unik_subrincian;
        $komponen->kategori_kode = $kategori->kode_kategori_ssh;
        $komponen->kategori_name = $kategori->kategori_ssh;

        $komponen->uraian = $request->get('uraian');
        $komponen->spesifikasi = $request->get('spesifikasi');
        $komponen->harga = $request->get('harga');
        $komponen->satuan = $request->get('satuan');
        $komponen->jenis = $request->get('jenis');
        $komponen->zonasi = $request->zonasi == 1 ? true : false;
        $komponen->inflasi = $request->get('inflasi');

        $komponen->save();
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Komponen Barang dengan nama <strong>' . $komponen->uraian . '</strong> berhasil diupdate</div>');
    }

    public function asbdelete(Request $request)
    {
        $komponen = K3SshKomponen::find($request->get('idkomponen'));
        $komponen->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Komponen Barang dengan nama <strong>' . $komponen->uraian . '</strong> berhasil dihapus</div>');
    }
}
