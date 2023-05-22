<?php

namespace App\Http\Controllers;

use App\Models\B6SubrincianNeraca;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
use App\Models\D6SubrincianLo;
use App\Models\TagKategoriBelanja;
use Illuminate\Http\Request;

class TagKategoriBelanjaController extends Controller
{

    public function tagrekeningbelanja(Request $request)
    {
        $rekenings = C6SubrincianLra::with(
            [
                'kategori' => fn ($q) => $q->select(['id', 'kode_kategori', 'kategori_uraian', 'kode_belanja', 'kategori_ssh', 'kode_kategori_ssh'])
            ]
        )->where(['kode_unik_akun' => '5'])
            ->select(['id', 'kode_unik_subrincian', 'uraian'])
            ->get();
        if ($request->has('subrincian')) {
            $rekenings = C6SubrincianLra::with(
                [
                    'kategori' => fn ($q) => $q->select(['id', 'kode_kategori', 'kategori_uraian', 'kode_belanja', 'kategori_ssh', 'kode_kategori_ssh'])
                ]
            )->where(['kode_unik_akun' => '5', 'kode_unik_rincian' => $request->subrincian])
                ->select(['id', 'kode_unik_subrincian', 'uraian'])
                ->get();
        }
        // return $rekenings;
        return view('rekening.belanja', [
            'title' => 'Rekening Belanja LRA',
            'kode' => $request->subrincian,
            'desc' => 'Rekening Laporan Realisasi Anggaran (LRA)',
            'rincians' => C5RincianLra::where('kode_unik_akun', '5')->get(['kode_unik_rincian', 'uraian']),
            'rekenings' => $rekenings,
        ]);
    }

    public function storetagrekeningbelanja(Request $request)
    {
        $destory = TagKategoriBelanja::where(
            [
                'kode_belanja' => $request->kode_belanja,
            ]
        )->delete();
        foreach ($request->kode_kategori as $kode_kategori) {
            $akun = (int) $kode_kategori[0];
            if (in_array($akun, [1, 2, 3])) {
                $kategory = B6SubrincianNeraca::where('kode_unik_subrincian', $kode_kategori)->first();
                // dump($kategory->toArray());
                TagKategoriBelanja::create([
                    'kode_kategori' => $kategory->kode_unik_subrincian,
                    'kode_belanja' => $request->kode_belanja,
                    'kategori_uraian' => $kategory->uraian,
                    'kategori_ssh' => $kategory->kategori_ssh,
                    'kode_kategori_ssh' => $kategory->kode_kategori_ssh,
                ]);
            }
            if (in_array($akun, [7, 8])) {
                $kategory = D6SubrincianLo::where('kode_unik_subrincian', $kode_kategori)->first();
                // dump($kategory->toArray());
                TagKategoriBelanja::create([
                    'kode_kategori' => $kategory->kode_unik_subrincian,
                    'kode_belanja' => $request->kode_belanja,
                    'kategori_uraian' => $kategory->uraian,
                    'kategori_ssh' => $kategory->kategori_ssh,
                    'kode_kategori_ssh' => $kategory->kode_kategori_ssh,
                ]);
            }
        }

        return back()->with('pesan', 'Rekening Belanja berhasil di tagging!');
    }

    public function autotagrekeningbelanja(Request $request)
    {
        $request->validate([
            'rekening' => 'required',
            'kode_kategori' => 'required',
        ]);
        $kategoris = '';
        $belanjas = C6SubrincianLra::where('kode_unik_rincian', $request->kode_belanja)->get(['kode_unik_subrincian', 'uraian']);
        if ($request->rekening == 'neraca') {
            $kategoris = B6SubrincianNeraca::where('kode_unik_rincian', $request->kode_kategori)->get(['kode_unik_subrincian', 'uraian', 'kategori_ssh', 'kode_kategori_ssh']);
        }
        if ($request->rekening == 'lo') {
            $kategoris = D6SubrincianLo::where('kode_unik_rincian', $request->kode_kategori)->get(['kode_unik_subrincian', 'uraian', 'kategori_ssh', 'kode_kategori_ssh']);
        }

        foreach ($belanjas as $destroy) {
            $delete = TagKategoriBelanja::where('kode_belanja', $destroy->kode_unik_subrincian)->delete();
        }

        $data = [];

        foreach ($kategoris as $katKey => $kategori) {
            $expKat = explode('.', $kategori->kode_unik_subrincian);
            $katLastNumber = end($expKat);
            foreach ($belanjas as $belanja) {
                $expBelanja = explode('.', $belanja->kode_unik_subrincian);
                $belanjaLastNumber = end($expBelanja);
                if ($katLastNumber == $belanjaLastNumber) {
                    array_push($data, [
                        'kode_kategori' => $kategori->kode_unik_subrincian,
                        'kode_belanja' => $belanja->kode_unik_subrincian,
                        'kategori_uraian' => $kategori->uraian,
                        'kategori_ssh' => $kategori->kategori_ssh,
                        'kode_kategori_ssh' => $kategori->kode_kategori_ssh,
                    ]);
                }
            }
        }

        if (count($data) !== 0) {
            foreach ($data as $value) {
                $insert = TagKategoriBelanja::create($value);
            }
            return back()->with('pesan', 'Rekening Belanja berhasil di tagging!');
        } else {
            return back()->with('pesan', 'Tagging gagal, rekening tidak ditemukan!');
        }
    }
}
