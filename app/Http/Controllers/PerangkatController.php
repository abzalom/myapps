<?php

namespace App\Http\Controllers;

use App\Models\A2Bidang;
use App\Models\EKelompokBidang;
use App\Models\F1Perangkat;
use App\Models\F2Tagging;
use App\Models\F4KepalaOpd;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $opds = F1Perangkat::with('kel_bidang')->where('tahun', $this->tahun->tahun)->get();
        // return $opds;
        return view('master.perangkat.opd', [
            'title' => 'OPD',
            'desc' => 'Kelolah OPD',
            'bidangs' => A2Bidang::all(),
            'opds' => $opds,
            'tahun' => $this->tahun->tahun,
            'kelbidangs' => EKelompokBidang::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bid1 = A2Bidang::find($request->get('bidang1'));
        $bid2 = A2Bidang::find($request->get('bidang2'));
        $bid3 = A2Bidang::find($request->get('bidang3'));
        $opd = [];


        $kode1 = $bid1->kode_unik_bidang . '.';
        $kode2 = ($bid2 !== null) ? $bid2->kode_unik_bidang . '.' : '0.00.';
        $kode3 = ($bid3 !== null) ? $bid3->kode_unik_bidang . '.' : '0.00.';
        $kode = $kode1 . $kode2 . $kode3 . $request->get('kode');
        $opd['kode_urut'] = $request->get('kode');
        $opd['nama_perangkat'] = $request->get('opd');
        $opd['kelompok_bidang'] = $request->get('kelompok_bidang');
        $opd['kode_perangkat'] = $kode;
        $opd['tahun'] = $this->tahun->tahun;

        $perangkat = F1Perangkat::create($opd);

        $tags[] = [
            'f1_perangkat_id' => $perangkat->id,
            'a1_urusan_id' => $bid1->a1_urusan_id,
            'a2_bidang_id' => $bid1->id,
            'kode_urut' => $request->get('kode'),
            'kode_perangkat' => $kode,
            'tahun' => $this->tahun->tahun,
        ];

        if ($bid2 !== null) {
            $tags[] = [
                'f1_perangkat_id' => $perangkat->id,
                'a1_urusan_id' => $bid2->a1_urusan_id,
                'a2_bidang_id' => $bid2->id,
                'kode_urut' => $request->get('kode'),
                'kode_perangkat' => $kode,
                'tahun' => $this->tahun->tahun,
            ];
        }

        if ($bid3 !== null) {
            $tags[] = [
                'f1_perangkat_id' => $perangkat->id,
                'a1_urusan_id' => $bid3->a1_urusan_id,
                'a2_bidang_id' => $bid3->id,
                'kode_urut' => $request->get('kode'),
                'kode_perangkat' => $kode,
                'tahun' => $this->tahun->tahun,
            ];
        }

        F2Tagging::insert($tags);
        return redirect()->back()->with('pesan', $perangkat->nama_perangkat . ' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\F1Perangkat  $f1Perangkat
     * @return \Illuminate\Http\Response
     */
    public function show(F1Perangkat $f1Perangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\F1Perangkat  $f1Perangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(F1Perangkat $f1Perangkat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\F1Perangkat  $f1Perangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, F1Perangkat $f1Perangkat)
    {
        // return $request->all();
        $bid1 = A2Bidang::find($request->get('bidang1'));
        $bid2 = A2Bidang::find($request->get('bidang2'));
        $bid3 = A2Bidang::find($request->get('bidang3'));

        $kode1 = $bid1->kode_unik_bidang . '.';
        $kode2 = ($bid2 !== null) ? $bid2->kode_unik_bidang . '.' : '0.00.';
        $kode3 = ($bid3 !== null) ? $bid3->kode_unik_bidang . '.' : '0.00.';
        $kode = $kode1 . $kode2 . $kode3 . $request->get('kode');

        $perangkat = F1Perangkat::find($request->get('idopd'));
        // return $perangkat;
        $perangkat->kode_urut = $request->get('kode');
        $perangkat->nama_perangkat = $request->get('opd');
        $perangkat->kelompok_bidang = $request->get('kelompok_bidang');
        $perangkat->kode_perangkat = $kode;
        $perangkat->save();

        $tags[] = [
            'f1_perangkat_id' => $perangkat->id,
            'a1_urusan_id' => $bid1->a1_urusan_id,
            'a2_bidang_id' => $bid1->id,
            'kode_urut' => $request->get('kode'),
            'kode_perangkat' => $kode,
            'tahun' => $this->tahun->tahun,
        ];

        if ($bid2 !== null) {
            $tags[] = [
                'f1_perangkat_id' => $perangkat->id,
                'a1_urusan_id' => $bid2->a1_urusan_id,
                'a2_bidang_id' => $bid2->id,
                'kode_urut' => $request->get('kode'),
                'kode_perangkat' => $kode,
                'tahun' => $this->tahun->tahun,
            ];
        }

        if ($bid3 !== null) {
            $tags[] = [
                'f1_perangkat_id' => $perangkat->id,
                'a1_urusan_id' => $bid3->a1_urusan_id,
                'a2_bidang_id' => $bid3->id,
                'kode_urut' => $request->get('kode'),
                'kode_perangkat' => $kode,
                'tahun' => $this->tahun->tahun,
            ];
        }
        $tagging = F2Tagging::where('f1_perangkat_id', $perangkat->id);
        $tagging->forceDelete();
        $tagging->insert($tags);
        return redirect()->back()->with('pesan', $perangkat->nama_perangkat . ' telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\F1Perangkat  $f1Perangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(F1Perangkat $f1Perangkat)
    {
        //
    }

    public function apiedit($id)
    {
        $opd = F1Perangkat::where('tahun', $this->tahun->tahun)->find($id);
        $tags = F2Tagging::where(['f1_perangkat_id' => $id, 'tahun' => $this->tahun->tahun])->get();
        $bidangs = A2Bidang::all();
        $data = [
            'opd' => $opd,
            'tags' => $tags,
            'bidangs' => $bidangs,
        ];
        return $data;
    }

    public function storekepalaopd(Request $request)
    {
        $kepalaopd = F4KepalaOpd::create($request->except('_token'));
        $opd = F1Perangkat::find($request->f1_perangkat_id);
        return redirect()->back()->with('pesan', $kepalaopd->nama . ' telah ditambahkan sebagai ' . $kepalaopd->jabatan . ' pada ' . $opd->nama_perangkat);
    }

    public function updatekelompokbidang(Request $request)
    {
        $opds = F1Perangkat::whereIn('id', $request->idopd)->update([
            'kelompok_bidang' => $request->kelompok_bidang,
        ]);
        return redirect()->back()->with('pesan', 'Data Perangkat telah diupdate');
    }
}
