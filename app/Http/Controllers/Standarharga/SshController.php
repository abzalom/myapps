<?php

namespace App\Http\Controllers\Standarharga;

use App\Exports\SshExport;
use App\Http\Controllers\Controller;
use App\Imports\SshImport;
use App\Models\B1AkunNeraca;
use App\Models\B6SubrincianNeraca;
use App\Models\C6SubrincianLra;
use App\Models\D1AkunLo;
use App\Models\D6SubrincianLo;
use App\Models\EZonasi;
use App\Models\K1SshTag;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SshController extends Controller
{
    public function ssh()
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
            'komponen' => fn ($q) => $q->where(['tahun' => $this->tahun->tahun, 'kategori_kode' => 1]),
            'komponen.typeproduk',
        ])
            ->whereIn('kode_unik_subrincian', $kodes['subrincian'])
            ->where('kode_kategori_ssh', 1)
            ->get();
        return view('standarharga.ssh.ssh', [
            'title' => 'Standar Harga | SSH',
            'desc' => 'Standar Satuan Harga (SSH)',
            'ssh' => $ssh,
            'zonasis' => EZonasi::all(),
        ]);
    }

    public function sshstore(Request $request)
    {
        // return $request->all();
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

    public function sshupload(Request $request)
    {
        // K3SshKomponen::truncate();
        $file = $request->file('file');
        Excel::import(new SshImport($this->tahun->tahun), $file);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Data komponen ssh berhasil diupload!</div>');
    }

    public function sshupdate(Request $request)
    {
        // return $request->all();
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
        // return $k2sshkategori;
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

    public function sshdelete(Request $request)
    {
        $komponen = K3SshKomponen::find($request->get('idkomponen'));
        $komponen->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Komponen Barang dengan nama <strong>' . $komponen->uraian . '</strong> berhasil dihapus</div>');
    }

    public function sshexport($kel)
    {
        $komponen = K3SshKomponen::with('rekening')
            ->where('kategori_kode', $kel)
            ->orderBy('rekening_subrincian')
            // ->limit(2)
            ->get();
        $data = [];

        $zonasi = EZonasi::all();

        foreach ($komponen as $key => $value) {
            if ($value->zonasi) {
                foreach ($zonasi as $key_zona => $val_zona) {
                    $inflasi = $value->harga / 100 * $value->inflasi;
                    // echo $value->harga * $val_zona->persentasi + $inflasi + $value->harga;
                    // echo "<br>";
                    $nama_zona = $val_zona->id == 1 ? ' (Zona Rendah)' : ($val_zona->id == 2 ? ' (Zona Sedang)' : ' (Zona Tinggi)');
                    // dump($nama_zona);
                    $data[$key_zona][$key]['kode'] = $value->kategori_subrincian;
                    $data[$key_zona][$key]['uraian'] = $value->uraian;
                    $data[$key_zona][$key]['spesifikasi'] = $value->spesifikasi . $nama_zona;
                    $data[$key_zona][$key]['harga'] = $value->harga * $val_zona->persentasi + $inflasi + $value->harga;
                    $data[$key_zona][$key]['satuan'] = $value->satuan;
                    $data[$key_zona][$key]['inflasi'] = $value->inflasi;
                    $data[$key_zona][$key]['rekening'] = $value->rekening_subrincian;
                    $data[$key_zona][$key]['nama_rekening'] = $value->rekening->uraian;
                    $data[$key_zona][$key]['kelompok'] = $value->kategori_kode;
                }

                // $data['zona_sedang'][$key]['kode'] = $value->kategori_subrincian;
                // $data['zona_sedang'][$key]['uraian'] = $value->uraian . ' (Zona Sedang)';
                // $data['zona_sedang'][$key]['spesifikasi'] = $value->spesifikasi;
                // $data['zona_sedang'][$key]['harga'] = $value->harga * $value->zona_dua->persentasi + $value->harga;
                // $data['zona_sedang'][$key]['satuan'] = $value->satuan;
                // $data['zona_sedang'][$key]['inflasi'] = $value->inflasi;
                // $data['zona_sedang'][$key]['rekening'] = $value->rekening_subrincian;
                // $data['zona_sedang'][$key]['nama_rekening'] = $value->rekening->uraian;
                // $data['zona_sedang'][$key]['kelompok'] = $value->kategori_kode;

                // $data['zona_tinggi'][$key]['kode'] = $value->kategori_subrincian;
                // $data['zona_tinggi'][$key]['uraian'] = $value->uraian . ' (Zona Tinggi)';
                // $data['zona_tinggi'][$key]['spesifikasi'] = $value->spesifikasi;
                // $data['zona_tinggi'][$key]['harga'] = $value->harga * $value->zona_dua->persentasi + $value->harga;
                // $data['zona_tinggi'][$key]['satuan'] = $value->satuan;
                // $data['zona_tinggi'][$key]['inflasi'] = $value->inflasi;
                // $data['zona_tinggi'][$key]['rekening'] = $value->rekening_subrincian;
                // $data['zona_tinggi'][$key]['nama_rekening'] = $value->rekening->uraian;
                // $data['zona_tinggi'][$key]['kelompok'] = $value->kategori_kode;
            } else {
                $data['non_zona'][$key]['kode'] = $value->kategori_subrincian;
                $data['non_zona'][$key]['uraian'] = $value->uraian;
                $data['non_zona'][$key]['spesifikasi'] = $value->spesifikasi;
                $data['non_zona'][$key]['harga'] = $value->harga;
                $data['non_zona'][$key]['satuan'] = $value->satuan;
                $data['non_zona'][$key]['inflasi'] = $value->inflasi;
                $data['non_zona'][$key]['rekening'] = $value->rekening_subrincian;
                $data['non_zona'][$key]['nama_rekening'] = $value->rekening->uraian;
                $data['non_zona'][$key]['kelompok'] = $value->kategori_kode;
            }
        }
        $filename = "";
        if ($kel == 1) {
            $filename = 'ssh_2023.xlsx';
        }
        if ($kel == 2) {
            $filename = 'hspk_2023.xlsx';
        }
        if ($kel == 3) {
            $filename = 'asb_2023.xlsx';
        }
        if ($kel == 4) {
            $filename = 'sbu_2023.xlsx';
        }
        // dump($data);
        // return $data;
        return Excel::download(new SshExport($data), $filename);
    }
}
