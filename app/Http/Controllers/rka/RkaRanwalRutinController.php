<?php

namespace App\Http\Controllers\rka;

use App\Models\F1Perangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\C4ObjekLra;
use App\Models\J6SubrincianRutinRanwal;
use App\Models\K1SshTag;
use App\Models\K2SshKategori;
use App\Models\K3SshKomponen;
use App\Models\M1RkaRutinTagRanwal;
use App\Models\M2RkaRutinKategoriRanwal;
use App\Models\M3RkaRutinRanwal;

class RkaRanwalRutinController extends Controller
{
    public function rkarutin(int $idopd, $idranwal, $idrincian)
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $idranwal = decrypt($idranwal);
        $idrincian = decrypt($idrincian);
        $komponen = M3RkaRutinRanwal::where([
            'tahun' => $this->tahun->tahun,
            'f1_perangkat_id' => $idopd,
            'i5_rutin_opd_ranwal_id' => $idranwal,
            'j6_subrincian_rutin_ranwal_id' => $idrincian,
        ])->get(['pajak', 'harga', 'volume']);

        $totalRka = 0;
        foreach ($komponen as $key => $value) {
            if ($value->pajak == true) {
                $jumlahRka = $value->harga * $value->volume;
                $pajakRka = $jumlahRka * 0.1;
                $totalRka += $jumlahRka + $pajakRka;
            } else {
                $totalRka += $value->harga * $value->volume;
            }
        }

        $tags = M1RkaRutinTagRanwal::where([
            'f1_perangkat_id' => $idopd,
            'i5_rutin_opd_ranwal_id' => $idranwal,
            'j6_subrincian_rutin_ranwal_id' => $idrincian,
            'tahun' => $this->tahun->tahun,
        ])->get();
        $kodereks = [];
        if (count($tags) == 0) {
            $kodereks = [
                'akun' => [0 => null],
                'kelompok' => [1 => null],
                'jenis' => [2 => null],
                'objek' => [3 => null],
                'rincian' => [4 => null],
                'subrincian' => [5 => null],
            ];
        } else {
            foreach ($tags as $key => $value) {
                $kodereks['akun'][$value->kode_unik_akun] = $value->kode_unik_akun;
                $kodereks['kelompok'][$value->kode_unik_kelompok] = $value->kode_unik_kelompok;
                $kodereks['jenis'][$value->kode_unik_jenis] = $value->kode_unik_jenis;
                $kodereks['objek'][$value->kode_unik_objek] = $value->kode_unik_objek;
                $kodereks['rincian'][$value->kode_unik_rincian] = $value->kode_unik_rincian;
                $kodereks['subrincian'][$value->kode_unik_subrincian] = $value->kode_unik_subrincian;
            }
        }
        $rkas = C4ObjekLra::with([
            'rincian' => fn ($q) => $q->whereIn('kode_unik_rincian', $kodereks['rincian']),
            'rincian.subrincian' => fn ($q) => $q->whereIn('kode_unik_subrincian', $kodereks['subrincian']),
            'rincian.subrincian.rkaranwalrutinkomponen' => fn ($q) => $q->where([
                'tahun' => $this->tahun->tahun,
                'f1_perangkat_id' => $idopd,
                'i5_rutin_opd_ranwal_id' => $idranwal,
                'j6_subrincian_rutin_ranwal_id' => $idrincian,
            ]),
        ])->whereIn('kode_unik_objek', $kodereks['objek'])->get();
        $opd = F1Perangkat::with([
            'ranwalrutinrka' => fn ($q) => $q->find($idranwal),
            'ranwalrutinrka.programrka',
            'ranwalrutinrka.kegiatanrka',
            'ranwalrutinrka.subkegiatanrka',
            'ranwalrutinrka.subrincianrka',
        ])->where([
            'tahun' => $this->tahun->tahun,
        ])->find($idopd);
        if ($opd == null) {
            return redirect()->route('ranwal.ranwal');
        }
        return view('rkaopdranwal.rkarutinranwalopd', [
            'title' => 'RKA OPD',
            'desc' => 'RKA ' . ucwords($opd->nama_perangkat),
            'opd' => $opd,
            'rkas' => $rkas,
            'totalrka' => $totalRka,
            'arsip' => M3RkaRutinRanwal::with('rekening')->where([
                'tahun' => $this->tahun->tahun,
                'f1_perangkat_id' => $idopd,
                'i5_rutin_opd_ranwal_id' => $idranwal,
                'j6_subrincian_rutin_ranwal_id' => $idrincian,
            ])->onlyTrashed()->get(),
        ]);
    }

    public function rkarutinstore(Request $request)
    {
        $komponen = K3SshKomponen::find($request->get('komponen'));
        $tags = K1SshTag::where('kode_unik_subrincian', $komponen->rekening_subrincian)->first();
        $kategori = K2SshKategori::where('kode_unik_subrincian', $komponen->kategori_subrincian)->first();

        $m3check = M3RkaRutinRanwal::where([
            // 'rekening_subrincian' => $komponen->rekening_subrincian,
            // 'kategori_subrincian' => $komponen->kategori_subrincian,
            'tahun' => $this->tahun->tahun,
            // 'kategori_subrincian' => $komponen->kategori_subrincian,
            'f1_perangkat_id' => $request->opd,
            'i5_rutin_opd_ranwal_id' => $request->ranwal,
            'a8_subkegiatan_rutin_id' => $request->subkegiatan,
            'j6_subrincian_rutin_ranwal_id' => $request->subrincian,
        ])->get();

        $i5ranwalrutin = J6SubrincianRutinRanwal::find($request->subrincian);

        $totalCheck = 0;

        foreach ($m3check as $key => $value) {
            if ($value->pajak == true) {
                $jumlahCheck = $value->volume * $value->harga;
                $pajakCheck = $jumlahCheck * 0.1;
                $totalCheck += $jumlahCheck + $pajakCheck;
            }
            if ($value->pajak == false) {
                $jumlahCheck = $value->volume * $value->harga;
                $totalCheck += $jumlahCheck;
            }
        }

        $checkInputan = 0;
        if ($request->pajak == true) {
            $inputanJumlah = $request->volume * $komponen->harga;
            $inputanPajak = $inputanJumlah * 0.1;
            $checkInputan = $inputanJumlah + $inputanPajak;
        } else {
            $checkInputan = $request->volume * $komponen->harga;
        }
        $jumlah_setelah_dicheck = (float)$totalCheck + $checkInputan;
        $selisih_renja_dan_rka = $i5ranwalrutin->anggaran - $jumlah_setelah_dicheck;

        if ($selisih_renja_dan_rka < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-danger"><strong>Jumlah anggaran RKA melebihi anggaran RENJA</strong></div>');
        }
        $rekening = M1RkaRutinTagRanwal::firstOrCreate(
            [
                'f1_perangkat_id' => $request->get('opd'),
                'i5_rutin_opd_ranwal_id' => $request->get('ranwal'),
                'a8_subkegiatan_rutin_id' => $request->get('subkegiatan'),
                'j6_subrincian_rutin_ranwal_id' => $request->get('subrincian'),
                'kode_unik_subrincian' => $tags->kode_unik_subrincian,
            ],
            [
                'kode_unik_akun' => $tags->kode_unik_akun,
                'kode_unik_kelompok' => $tags->kode_unik_kelompok,
                'kode_unik_jenis' => $tags->kode_unik_jenis,
                'kode_unik_objek' => $tags->kode_unik_objek,
                'kode_unik_rincian' => $tags->kode_unik_rincian,
                'tahun' => $tags->tahun,
            ],
        );

        $kategori = M2RkaRutinKategoriRanwal::firstOrCreate(
            [
                'f1_perangkat_id' => $request->get('opd'),
                'i5_rutin_opd_ranwal_id' => $request->get('ranwal'),
                'a8_subkegiatan_rutin_id' => $request->get('subkegiatan'),
                'j6_subrincian_rutin_ranwal_id' => $request->get('subrincian'),
                'kode_unik_subrincian' => $kategori->kode_unik_subrincian,
                'kategori_kode' => $kategori->kategori_kode,
                'kategori_name' => $kategori->kategori_name,
            ],
            [
                'kode_unik_akun' => $kategori->kode_unik_akun,
                'kode_unik_kelompok' => $kategori->kode_unik_kelompok,
                'kode_unik_jenis' => $kategori->kode_unik_jenis,
                'kode_unik_objek' => $kategori->kode_unik_objek,
                'kode_unik_rincian' => $kategori->kode_unik_rincian,
                'tahun' => $kategori->tahun,
            ],
        );

        $rka = [
            'f1_perangkat_id' => $request->get('opd'),
            'i5_rutin_opd_ranwal_id' => $request->get('ranwal'),
            'a8_subkegiatan_rutin_id' => $request->get('subkegiatan'),
            'j6_subrincian_rutin_ranwal_id' => $request->get('subrincian'),
            // Rekening
            'rekening_akun' => $komponen->rekening_akun,
            'rekening_kelompok' => $komponen->rekening_kelompok,
            'rekening_jenis' => $komponen->rekening_jenis,
            'rekening_objek' => $komponen->rekening_objek,
            'rekening_rincian' => $komponen->rekening_rincian,
            'rekening_subrincian' => $komponen->rekening_subrincian,
            // Kategori
            'kategori_akun' => $komponen->kategori_akun,
            'kategori_kelompok' => $komponen->kategori_kelompok,
            'kategori_jenis' => $komponen->kategori_jenis,
            'kategori_objek' => $komponen->kategori_objek,
            'kategori_rincian' => $komponen->kategori_rincian,
            'kategori_subrincian' => $komponen->kategori_subrincian,
            'kategori_kode' => $komponen->kategori_kode,
            'kategori_name' => $komponen->kategori_name,
            // komponen
            'kode_urut_komponen' => $komponen->kode_urut_komponen,
            'uraian' => $komponen->uraian,
            'spesifikasi' => $komponen->spesifikasi,
            'harga' => $komponen->harga,
            'satuan' => $komponen->satuan,
            'inflasi' => $komponen->inflasi,
            'volume' => $request->get('volume'),
            'pajak' => $request->get('pajak') ? true : false,
            'e_jenis_komponen_id' => $komponen->e_jenis_komponen_id,
            'tahun' => $komponen->tahun,
            'e_zonasi_id' => 1,
        ];

        $createrka = M3RkaRutinRanwal::create($rka);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Komponen <strong>' . $createrka->uraian . '</strong> berhasil ditambahkan</div>');
    }

    public function rkarutinupdate(Request $request)
    {
        $idkomponen = decrypt($request->idkomponen);
        $komponen = M3RkaRutinRanwal::find($idkomponen);
        $komponen->volume = $request->volume;
        $komponen->pajak = $request->pajak ? true : false;
        $komponen->save();
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Komponen <strong>' . $komponen->uraian . '</strong> berhasil diupdate</div>');
    }

    public function rkarutindelete($idkomponen)
    {
        $idkomponen = decrypt($idkomponen);
        $komponen = M3RkaRutinRanwal::find($idkomponen);
        $rekening = M1RkaRutinTagRanwal::where([
            'f1_perangkat_id' => $komponen->f1_perangkat_id,
            'i5_rutin_opd_ranwal_id' => $komponen->i5_rutin_opd_ranwal_id,
            'a8_subkegiatan_rutin_id' => $komponen->a8_subkegiatan_rutin_id,
            'j6_subrincian_rutin_ranwal_id' => $komponen->j6_subrincian_rutin_ranwal_id,
            'kode_unik_subrincian' => $komponen->rekening_subrincian,
            'tahun' => $this->tahun->tahun,
        ])->firstOrFail();
        $kategori = M2RkaRutinKategoriRanwal::where([
            'f1_perangkat_id' => $komponen->f1_perangkat_id,
            'i5_rutin_opd_ranwal_id' => $komponen->i5_rutin_opd_ranwal_id,
            'a8_subkegiatan_rutin_id' => $komponen->a8_subkegiatan_rutin_id,
            'j6_subrincian_rutin_ranwal_id' => $komponen->j6_subrincian_rutin_ranwal_id,
            'kode_unik_subrincian' => $komponen->kategori_subrincian,
            'tahun' => $this->tahun->tahun,
        ])->firstOrFail();

        $checkKomponen = M3RkaRutinRanwal::where([
            'rekening_subrincian' => $rekening->kode_unik_subrincian,
            'kategori_subrincian' => $kategori->kode_unik_subrincian,
            'f1_perangkat_id' => $komponen->f1_perangkat_id,
            'i5_rutin_opd_ranwal_id' => $komponen->i5_rutin_opd_ranwal_id,
            'a8_subkegiatan_rutin_id' => $komponen->a8_subkegiatan_rutin_id,
            'j6_subrincian_rutin_ranwal_id' => $komponen->j6_subrincian_rutin_ranwal_id,
        ])->whereNot('id', $idkomponen)->get();

        // dump($komponen->toArray());
        // dump($rekening->toArray());
        // dump($kategori->toArray());
        // dump($checkKomponen->toArray());

        if (count($checkKomponen) == 0) {
            $rekening->delete();
            $kategori->delete();
        }
        $komponen->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Komponen <strong>' . $komponen->uraian . '</strong> berhasil dihapus!</div>');
    }

    public function rkarutinrestore($idkomponen)
    {
        $idkomponen = decrypt($idkomponen);
        $komponen = M3RkaRutinRanwal::withTrashed()->find($idkomponen);
        $rekening = M1RkaRutinTagRanwal::withTrashed()->where([
            'tahun' => $this->tahun->tahun,
            'f1_perangkat_id' => $komponen->f1_perangkat_id,
            'i5_rutin_opd_ranwal_id' => $komponen->i5_rutin_opd_ranwal_id,
            'a8_subkegiatan_rutin_id' => $komponen->a8_subkegiatan_rutin_id,
            'j6_subrincian_rutin_ranwal_id' => $komponen->j6_subrincian_rutin_ranwal_id,
            'kode_unik_subrincian' => $komponen->rekening_subrincian,
        ])->firstOrFail();
        $kategori = M2RkaRutinKategoriRanwal::withTrashed()->where([
            'tahun' => $this->tahun->tahun,
            'f1_perangkat_id' => $komponen->f1_perangkat_id,
            'i5_rutin_opd_ranwal_id' => $komponen->i5_rutin_opd_ranwal_id,
            'a8_subkegiatan_rutin_id' => $komponen->a8_subkegiatan_rutin_id,
            'j6_subrincian_rutin_ranwal_id' => $komponen->j6_subrincian_rutin_ranwal_id,
            'kode_unik_subrincian' => $komponen->kategori_subrincian,
        ])->firstOrFail();
        $komponen->restore();
        $rekening->restore();
        $kategori->restore();
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Komponen <strong>' . $komponen->uraian . '</strong> berhasil dikembalikan</div>');
    }

    public function getkomponenbyid($idkomponen)
    {
        $idkomponen = decrypt($idkomponen);
        return M3RkaRutinRanwal::with('rekening')->find($idkomponen);
    }
}
