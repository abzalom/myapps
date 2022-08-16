<?php

namespace App\Http\Controllers;

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C6SubrincianLra;
use App\Models\G1Pendapatan;
use App\Models\G1PendapatanUraian;
use App\Models\G2PendapatanRanwal;
use App\Models\G2PendapatanUraianRanwal;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pdtn = G1Pendapatan::where('tahun', $this->tahun->tahun)->get();
        $ids = [];
        if (count($pdtn) == 0) {
            $ids['akun'] = [null];
            $ids['kelompok'] = [null];
            $ids['jenis'] = [null];
            $ids['objek'] = [null];
            $ids['rincian'] = [null];
            $ids['subrincian'] = [null];
        } else {
            foreach ($pdtn as $value) {
                $ids['akun'][$value->c1_akun_lra_id] = $value->c1_akun_lra_id;
                $ids['kelompok'][$value->c2_kelompok_lra_id] = $value->c2_kelompok_lra_id;
                $ids['jenis'][$value->c3_jenis_lra_id] = $value->c3_jenis_lra_id;
                $ids['objek'][$value->c4_objek_lra_id] = $value->c4_objek_lra_id;
                $ids['rincian'][$value->c5_rincian_lra_id] = $value->c5_rincian_lra_id;
                $ids['subrincian'][$value->c6_subrincian_lra_id] = $value->c6_subrincian_lra_id;
            }
        }
        $reks = C1AkunLra::with([
            'kelompok' => fn ($q) => $q->whereIn('id', $ids['kelompok'])->withSum(
                [
                    'komponen'
                    => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'kelompok.jenis' => fn ($q) => $q->whereIn('id', $ids['jenis'])->withSum(
                [
                    'komponen'
                    => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'kelompok.jenis.objek'  => fn ($q) => $q->whereIn('id', $ids['objek'])->withSum(
                [
                    'komponen'
                    => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'kelompok.jenis.objek.rincian' => fn ($q) => $q->whereIn('id', $ids['rincian'])->withSum(
                [
                    'komponen'
                    => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'kelompok.jenis.objek.rincian.subrincian' => fn ($q) => $q->whereIn('id', $ids['subrincian'])->withSum(
                [
                    'komponen'
                    => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'kelompok.jenis.objek.rincian.subrincian.komponen' => fn ($q) => $q->where('tahun', $this->tahun->tahun),
        ])->where('id', $ids['akun'])->withSum(
            [
                'komponen'
                => fn ($q) => $q->where('tahun', $this->tahun->tahun)
            ],
            'anggaran'
        )->get();

        return view('pendapatan.pendapatan', [
            'title' => 'Pendapatan',
            'desc' => 'Pengaturan Pendapatan Daerah',
            'kelompoks' => C2KelompokLra::where('kode_unik_akun', 4)->get(),
            'reks' => $reks,
            'tahapan' => $this->tahapan,
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
        // return $request->all();
        $pendapatan = G1Pendapatan::firstOrCreate(
            [
                'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
                'tahun' => $this->tahun->tahun,
            ],
            [
                'c1_akun_lra_id' => $request->get('c1_akun_lra_id'),
                'c2_kelompok_lra_id' => $request->get('c2_kelompok_lra_id'),
                'c3_jenis_lra_id' => $request->get('c3_jenis_lra_id'),
                'c4_objek_lra_id' => $request->get('c4_objek_lra_id'),
                'c5_rincian_lra_id' => $request->get('c5_rincian_lra_id'),
            ]
        );
        $reks = C6SubrincianLra::find($request->get('c6_subrincian_lra_id'));
        return redirect()->back()->with('pesan', ' Rekening ' . $reks->uraian . ' telah ditambahkan');
        if ($pendapatan->exists) {
            return redirect()->back()->with('pesan', ' Rekening ' . $reks->uraian . ' sudah ada silahkan menambahkan uraian komponen');
        } else {
            $pendapatan->create($request->except('_token'));
            return redirect()->back()->with('pesan', ' Rekening ' . $reks->uraian . ' telah ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\G1Pendapatan  $g1Pendapatan
     * @return \Illuminate\Http\Response
     */
    public function show(G1Pendapatan $g1Pendapatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\G1Pendapatan  $g1Pendapatan
     * @return \Illuminate\Http\Response
     */
    public function edit(G1Pendapatan $g1Pendapatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\G1Pendapatan  $g1Pendapatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, G1Pendapatan $g1Pendapatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\G1Pendapatan  $g1Pendapatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(G1Pendapatan $g1Pendapatan)
    {
        //
    }

    public function storeuraian(Request $request)
    {
        $reks = C6SubrincianLra::find($request->get('c6_subrincian_lra_id'));
        $pendapatan = G1Pendapatan::where([
            'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
            'tahun' => $this->tahun->tahun,
        ])->first();
        $komponen = G1PendapatanUraian::where([
            'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
            'tahun' => $this->tahun->tahun,
        ])->first();

        if ($komponen == null) {
            $sql = G1PendapatanUraian::create([
                'c1_akun_lra_id' => $pendapatan->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $pendapatan->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $pendapatan->c3_jenis_lra_id,
                'c4_objek_lra_id' => $pendapatan->c4_objek_lra_id,
                'c5_rincian_lra_id' => $pendapatan->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
                'g1_pendapatan_id' => $pendapatan->id,
                'kode' => 1,
                'kode_unik' => $reks->kode_unik_subrincian . '.001',
                'uraian' => $request->get('uraian'),
                'anggaran' => $request->get('anggaran'),
                'tahun' => $this->tahun->tahun,
            ]);
            return redirect()->back()->with('pesan', 'Komponen ' . $sql->kode_unik . ' - ' . $sql->uraian . ' pada  Rekening ' . $reks->uraian . ' telah ditambahkan');
        } else {
            dump($komponen);
            $kode = (strlen($komponen->kode) == 1) ? '.00' . $komponen->kode + 1
                : (strlen($komponen->kode) == 2 ? '.0' . $komponen + 1 : $komponen->kode + 1);
            echo $kode;
            $sql = G1PendapatanUraian::create([
                'c1_akun_lra_id' => $pendapatan->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $pendapatan->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $pendapatan->c3_jenis_lra_id,
                'c4_objek_lra_id' => $pendapatan->c4_objek_lra_id,
                'c5_rincian_lra_id' => $pendapatan->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
                'g1_pendapatan_id' => $pendapatan->id,
                'kode' => $komponen->kode + 1,
                'kode_unik' => $reks->kode_unik_subrincian . $kode,
                'uraian' => $request->get('uraian'),
                'anggaran' => $request->get('anggaran'),
                'tahun' => $this->tahun->tahun,
            ]);
            return redirect()->back()->with('pesan', 'Komponen ' . $sql->kode_unik . ' - ' . $sql->uraian . ' pada  Rekening ' . $reks->uraian . ' telah ditambahkan');
        }


        // $komponen = G1PendapatanUraian::where([
        //     'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
        //     'tahun' => $this->tahun->tahun,
        // ])->get();
        // return $komponen;
        // $reks = C6SubrincianLra::find($request->get('c6_subrincian_lra_id'));
        // if (count($pendapatan) !== 0) {
        //     if (count($komponen) !== 0) {
        //         $kode = (strlen($komponen->kode + 1) > 1) ? '.0' . $komponen->kode + 1 : '.00' . $komponen->kode + 1;
        //         $sql = $pendapatan->komponen()->create([
        //             'c1_akun_lra_id' => $pendapatan->c1_akun_lra_id,
        //             'c2_kelompok_lra_id' => $pendapatan->c2_kelompok_lra_id,
        //             'c3_jenis_lra_id' => $pendapatan->c3_jenis_lra_id,
        //             'c4_objek_lra_id' => $pendapatan->c4_objek_lra_id,
        //             'c5_rincian_lra_id' => $pendapatan->c5_rincian_lra_id,
        //             'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
        //             'g1_pendapatan_id' => $pendapatan->id,
        //             'kode' => $komponen->kode + 1,
        //             'kode_unik' => $reks->kode_unik_subrincian . $kode,
        //             'uraian' => $request->get('uraian'),
        //             'anggaran' => $request->get('anggaran'),
        //         ]);
        //         return redirect()->back()->with('pesan', 'Komponen ' . $sql->kode_unik . ' - ' . $sql->uraian . ' pada  Rekening ' . $reks->uraian . ' telah ditambahkan');
        //     } else {
        //         $sql = G1PendapatanUraian::create([
        //             'c1_akun_lra_id' => $pendapatan->c1_akun_lra_id,
        //             'c2_kelompok_lra_id' => $pendapatan->c2_kelompok_lra_id,
        //             'c3_jenis_lra_id' => $pendapatan->c3_jenis_lra_id,
        //             'c4_objek_lra_id' => $pendapatan->c4_objek_lra_id,
        //             'c5_rincian_lra_id' => $pendapatan->c5_rincian_lra_id,
        //             'c6_subrincian_lra_id' => $request->get('c6_subrincian_lra_id'),
        //             'g1_pendapatan_id' => $pendapatan->id,
        //             'kode' => 1,
        //             'kode_unik' => $reks->kode_unik_subrincian . '.001',
        //             'uraian' => $request->get('uraian'),
        //             'anggaran' => $request->get('anggaran'),
        //         ]);
        //         return redirect()->back()->with('pesan', 'Komponen ' . $sql->kode_unik . ' - ' . $sql->uraian . ' pada  Rekening ' . $reks->uraian . ' telah ditambahkan');
        //     }
        // } else {
        //     echo 'Renkening belum ditambahkan';
        // }
        // if ($pendapatan->exist) {
        //     $pendapatan->komponen->create($request->except('_token'));
        // }
        // $reks = C6SubrincianLra::find($request->get('c6_subrincian_lra_id'));
        // return redirect()->back()->with('pesan', 'Komponen ' . $pendapatan->komponen->uraian . ' pada  Rekening ' . $reks->uraian . ' telah ditambahkan');
    }

    public function validasiranwal()
    {
        $pdtn = G1Pendapatan::all();
        $komponen = G1PendapatanUraian::all();

        $ranwalPdtn = new G2PendapatanRanwal;
        $ranwalPdtn::truncate();
        foreach ($pdtn as $key => $value) {
            $dataPdtn = [
                'id' => $value->id,
                'c1_akun_lra_id' => $value->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $value->c3_jenis_lra_id,
                'c4_objek_lra_id' => $value->c4_objek_lra_id,
                'c5_rincian_lra_id' => $value->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $value->c6_subrincian_lra_id,
                'tahun' => $value->tahun,
                'deleted_at' => $value->deleted_at,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
            $ranwalPdtn->insert($dataPdtn);
        }
        $ranwalKomponen = new G2PendapatanUraianRanwal;
        $ranwalKomponen::truncate();
        foreach ($komponen as $key => $value) {
            $dataKomponen = [
                'c1_akun_lra_id' => $value->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $value->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $value->c3_jenis_lra_id,
                'c4_objek_lra_id' => $value->c4_objek_lra_id,
                'c5_rincian_lra_id' => $value->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $value->c6_subrincian_lra_id,
                'g2_pendapatan_ranwal_id' => $value->g1_pendapatan_id,
                'kode' => $value->kode,
                'kode_unik' => $value->kode_unik,
                'uraian' => $value->uraian,
                'anggaran' => $value->anggaran,
                'tahun' => $value->tahun,
                'deleted_at' => $value->deleted_at,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];
            $ranwalKomponen->insert($dataKomponen);
        }
        return redirect()->back()->with('pesan', 'Pendapatan Rancangan Awal RKPD berhasil divalidasi');
    }

    public function updateuraian(Request $request)
    {
        $komponen = G1PendapatanUraian::find($request->get('komponen'));
        $komponen->uraian = $request->get('uraian');
        $komponen->anggaran = $request->get('anggaran');
        $komponen->save();
        return redirect()->back()->with('pesan', 'Uraian komponen <strong>' . $komponen->uraian . '</strong> berhasill diupdate');
    }
}
