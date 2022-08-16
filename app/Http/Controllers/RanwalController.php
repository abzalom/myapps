<?php

namespace App\Http\Controllers;

use App\Models\A1Urusan;
use App\Models\A5Subkegiatan;
use App\Models\A6ProgramRutin;
use App\Models\F1Perangkat;
use App\Models\H1PaguOpdRanwal;
use App\Models\I2RenjaOpdRanwal;
use App\Models\I5RutinOpdRanwal;
use App\Models\J1IndikatorProgramRanwal;
use App\Models\J2IndikatorKegiatanRanwal;
use App\Models\J3IndikatorSubkegiatanRanwal;
use App\Models\L1LokasitagindikatorsubRanwal;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class RanwalController extends Controller
{
    /**
     * Menampilkan Data Status Renja Semua OPD
     */
    public function ranwal()
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $ranwal = I2RenjaOpdRanwal::where('tahun', $this->tahun->tahun)->get();
        $dataranwal = [];
        foreach ($ranwal as $value) {
            $dataranwal[$value->f1_perangkat_id]['bidang'][$value->a2_bidang_id] = $value->a2_bidang_id;
            $dataranwal[$value->f1_perangkat_id]['program'][$value->a3_program_id] = $value->a3_program_id;
            $dataranwal[$value->f1_perangkat_id]['kegiatan'][$value->a4_kegiatan_id] = $value->a4_kegiatan_id;
            $dataranwal[$value->f1_perangkat_id]['subkegiatan'][$value->a5_subkegiatan_id] = $value->a5_subkegiatan_id;
        }
        $ranwalrutin = I5RutinOpdRanwal::where('tahun', $this->tahun->tahun)->get();
        $dataranwalrutin = [];
        foreach ($ranwalrutin as $value) {
            // $dataranwal[$value->f1_perangkat_id]['bidang'][$value->a2_bidang_id] = $value->a2_bidang_id;
            $dataranwalrutin[$value->f1_perangkat_id]['program'][$value->a6_program_rutin_id] = $value->a6_program_rutin_id;
            $dataranwalrutin[$value->f1_perangkat_id]['kegiatan'][$value->a7_kegiatan_rutin_id] = $value->a7_kegiatan_rutin_id;
            $dataranwalrutin[$value->f1_perangkat_id]['subkegiatan'][$value->a8_subkegiatan_rutin_id] = $value->a8_subkegiatan_rutin_id;
        }
        $opds = F1Perangkat::withSum([
            'paguopdranwal' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
        ], 'pagu')
            ->withSum([
                'subrincianranwal' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
            ], 'anggaran')
            ->withSum([
                'subrincianrutinranwal' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
            ], 'anggaran')
            ->where('tahun', $this->tahun->tahun)
            ->get();
        return view('ranwal.ranwal', [
            'title' => 'Renja OPD',
            'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . $this->tahun->tahun,
            'opds' => $opds,
            'ranwals' => $dataranwal,
            'ranwalrutins' => $dataranwalrutin,
        ]);
    }


    // --------------------------------------------------------------------------------------------------

    /**
     * Menampilkan Data Renja Per OPD
     *
     */
    public function ranwalopd($idopd)
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $ranwal = I2RenjaOpdRanwal::where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun])->get();
        $idNomens = [
            'urusan' => [null],
            'bidang' => [null],
            'program' => [null],
            'kegiatan' => [null],
            'subkegiatan' => [null],
            'opd' => [null],
        ];
        if (count($ranwal) !== 0) {
            foreach ($ranwal as $key => $value) {
                $idNomens['urusan'][$value->a1_urusan_id] = $value->a1_urusan_id;
                $idNomens['bidang'][$value->a2_bidang_id] = $value->a2_bidang_id;
                $idNomens['program'][$value->a3_program_id] = $value->a3_program_id;
                $idNomens['kegiatan'][$value->a4_kegiatan_id] = $value->a4_kegiatan_id;
                $idNomens['subkegiatan'][$value->a5_subkegiatan_id] = $value->a5_subkegiatan_id;
                $idNomens['opd'][$value->f1_perangkat_id] = $value->f1_perangkat_id;
            }
        }
        $nomens = A1Urusan::with([
            'bidang' => fn ($q) => $q->whereIn('id', $idNomens['bidang']),
            'bidang.program' => fn ($q) => $q->whereIn('id', $idNomens['program']),
            'bidang.program.ranwalindikator' => fn ($q) => $q->where('f1_perangkat_id', $idopd),
            'bidang.program.kegiatan' => fn ($q) => $q->whereIn('id', $idNomens['kegiatan']),
            'bidang.program.kegiatan.ranwalindikator' => fn ($q) => $q->where('f1_perangkat_id', $idopd),
            'bidang.program.kegiatan.subkegiatan' => fn ($q) => $q->whereIn('id', $idNomens['subkegiatan'])->withSum('ranwalindikator', 'anggaran'),
            'bidang.program.kegiatan.subkegiatan.ranwal' => fn ($q) => $q->where('f1_perangkat_id', $idopd),
            'bidang.program.kegiatan.subkegiatan.ranwalindikator' => fn ($q) => $q->where('f1_perangkat_id', $idopd),
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.lokasiranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.klasifikasiranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.sumberdanaranwal',
        ])->whereIn('id', $idNomens['urusan'])->get();

        $getopd = F1Perangkat::with([
            'tags',
            'tags.bidang',
            'tags.bidang.paguranwal' => function ($q) use ($idopd) {
                $q->withSum('subrincianranwal', 'anggaran')->where('f1_perangkat_id', $idopd);
                $q->withSum('subrinrianrutinranwal', 'anggaran')->where('f1_perangkat_id', $idopd);
            },
            'tags.bidang.paguranwal.uraianpendapatanranwal',
        ])->withSum('paguopdranwal', 'pagu')
            ->withSum('subrincianranwal', 'anggaran')
            ->withSum('subrincianrutinranwal', 'anggaran')
            ->where('tahun', $this->tahun->tahun)
            ->find($idopd);

        if ($getopd == null) {
            return redirect()->route('ranwal.ranwal');
        }
        $ranwalrutin = I5RutinOpdRanwal::where([
            'f1_perangkat_id' => $idopd,
        ])->get();
        $nomenRutin = [
            'opd' => [0],
            'kegiatan' => [0],
            'subkegiatan' => [0],
        ];
        if (count($nomenRutin) !== 0) {
            foreach ($ranwalrutin as $key => $value) {
                $nomenRutin['opd'] = $value->f1_perangkat_id;
                $nomenRutin['kegiatan'][$value->a7_kegiatan_rutin_id] = $value->a7_kegiatan_rutin_id;
                $nomenRutin['subkegiatan'][$value->a8_subkegiatan_rutin_id] = $value->a8_subkegiatan_rutin_id;
            }
        }
        $rutins = A6ProgramRutin::with([
            'indikatorprogranwal' => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin' => fn ($q) => $q->whereIn('id', $nomenRutin['kegiatan'])
                ->withSum(
                    ['subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)],
                    'anggaran'
                ),
            'kegiatanrutin.indikatorkegranwal' => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin' => fn ($q) => $q->whereIn('id', $nomenRutin['subkegiatan'])
                ->withSum(
                    [
                        'subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                    ],
                    'anggaran'
                )->withSum('subrincianrutin', 'target'),
            'kegiatanrutin.subkegiatanrutin.ranwalrutin'
            => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin.subrincianrutin'
            => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.lokasi',
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.klasifikasi',
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.sumberdana',
        ])

            ->withSum(
                ['subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)],
                'anggaran'
            )->get();

        // return $rutins;
        return view('ranwal.ranwalopd', [
            'title' => 'Renja OPD',
            'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . $this->tahun->tahun,
            'opd' => $getopd,
            'rutins' => $rutins,
            'nomens' => $nomens,
        ]);
    }


    // --------------------------------------------------------------------------------------------------


    /**
     * Store Inputan Renja OPD
     *
     * @param Request $request
     * @param I2RenjaOpdRanwal $ranwal
     * @return void
     */
    public function store(Request $request, I2RenjaOpdRanwal $ranwal)
    {
        $subkeg = A5Subkegiatan::find((int) $request->get('subkegiatan'));
        $kode = $subkeg->a1_urusan_id . '.' . $subkeg->a2_bidang_id . '.' . $subkeg->a3_program_id . '.' . $subkeg->a4_kegiatan_id . '.' . $subkeg->id . '.' . (int) $request->get('idopd');
        $data = [
            'a1_urusan_id' => $subkeg->a1_urusan_id,
            'a2_bidang_id' => $request->get('bidang'),
            'a3_program_id' => $request->get('program'),
            'a4_kegiatan_id' => $request->get('kegiatan'),
            'a5_subkegiatan_id' => $subkeg->id,
            'f1_perangkat_id' => $request->get('idopd'),
            'e_prioritas_nasional_id' => $request->get('prionas'),
            'e_prioritas_provinsi_id' => $request->get('prioprov'),
            'e_prioritas_daerah_id' => $request->get('prioda'),
            'e_tahapan_id' => $this->tahapan->id,
            'e_tahun_anggaran_id' => $this->tahun->id,
            'status' => 1,
            'tahun' => $this->tahun->tahun,
            'kode_unik_renja' => $kode,
        ];
        $ranwal::create($data);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Sub Kegiatan <strong>' . $subkeg->kode_unik_subkegiatan . ' - ' . $subkeg->uraian . '</strong> berhasil ditambahkan</div>');
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Store dan Update Inputan Indikator Progam Renja Non Rutin
     *
     * @param Request $request
     * @return void
     */
    public function indikatorprogramstore(Request $request)
    {
        if ($request->get('idindikator') == null) {
            $data = [
                'f1_perangkat_id' => $request->f1_perangkat_id,
                'a3_program_id' => $request->a3_program_id,
                'kode_unik_program' => $request->kode_unik_program,
                'sasaran' => $request->sasaran,
                'capaian' => $request->capaian,
                'target' => $request->target,
                'satuan' => $request->satuan,
                'tahun' => $this->tahun->tahun,
            ];
            // return $data;
            J1IndikatorProgramRanwal::create($data);
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Sasaran Program berhasil ditambahkan</div>');
        } else {
            $indikator = J1IndikatorProgramRanwal::find($request->idindikator);
            $indikator->a3_program_id = $request->get('a3_program_id');
            $indikator->f1_perangkat_id = $request->get('f1_perangkat_id');
            $indikator->kode_unik_program = $request->get('kode_unik_program');
            $indikator->sasaran = $request->get('sasaran');
            $indikator->capaian = $request->get('capaian');
            $indikator->target = $request->get('target');
            $indikator->satuan = $request->get('satuan');
            $indikator->save();
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Sasaran Program berhasil diupdate</div>');
        }
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Store dan Update Inputan Indikator Kegiatan Renja OPD Non Rutin
     *
     * @param Request $request
     * @return void
     */
    public function indikatorkegiatanstore(Request $request)
    {
        if ($request->idindikator == null) {
            J2IndikatorKegiatanRanwal::create($request->except('_token', 'idindikator'));
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator Kegiatan berhasil ditambahkan</div>');
        } else {
            $indikator = J2IndikatorKegiatanRanwal::find($request->get('idindikator'));
            $indikator->a4_kegiatan_id = $request->get('a4_kegiatan_id');
            $indikator->f1_perangkat_id = $request->get('f1_perangkat_id');
            $indikator->kode_unik_kegiatan = $request->get('kode_unik_kegiatan');
            $indikator->capaian = $request->get('capaian');
            $indikator->target_capaian = $request->get('target_capaian');
            $indikator->satuan_capaian = $request->get('satuan_capaian');
            $indikator->keluaran = $request->get('keluaran');
            $indikator->target_keluaran = $request->get('target_keluaran');
            $indikator->satuan_keluaran = $request->get('satuan_keluaran');
            $indikator->hasil = $request->get('hasil');
            $indikator->target_hasil = $request->get('target_hasil');
            $indikator->satuan_hasil = $request->get('satuan_hasil');
            $indikator->save();
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator Kegiatan berhasil diupdate</div>');
        }
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Store Rincian Kegiatan Masing-masing Sub Kegiatan OPD
     *
     * @param Request $request
     * @param J3IndikatorSubkegiatanRanwal $indikator
     * @return void
     */
    public function indikatorsubkegiatanstore(Request $request, J3IndikatorSubkegiatanRanwal $indikator)
    {
        // return $request->all();
        $anggaran = $indikator::where([
            'f1_perangkat_id' => $request->get('f1_perangkat_id'),
            'a2_bidang_id' => $request->get('a2_bidang_id'),
            'h1_pagu_opd_ranwal_id' => $request->get('h1_pagu_opd_ranwal_id'),
        ])->sum('anggaran');
        $total = $anggaran + $request->get('anggaran');
        $pagu = H1PaguOpdRanwal::find($request->get('h1_pagu_opd_ranwal_id'));
        $limit = $pagu->pagu - $total;

        if ($limit < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Jumlah pagu yang dimasukan melebih batasan pagu!</div>');
        } else {
            $getid = $indikator::create($request->except('_token', 'lokasi'));
            $dataLokasi = [];
            foreach ($request->get('lokasi') as $key => $value) {
                $data = [
                    'e_lokasi_id' => $value,
                    'j3_indikator_subkegiatan_ranwal_id' => $getid->id,
                    'tahun' => $this->tahun->tahun,
                ];
                L1LokasitagindikatorsubRanwal::create($data);
            }
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator Sub Kegiatan berhasil ditambahkan</div>');
        }
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Update Data Rincian Kegiatan Masing-masing Sub Kegiatan OPD
     *
     * @param Request $request
     * @param J3IndikatorSubkegiatanRanwal $indikator
     * @return void
     */
    public function indikatorsubkegiatanupdate(Request $request, J3IndikatorSubkegiatanRanwal $indikator)
    {
        $anggaran = $indikator::where([
            'f1_perangkat_id' => $request->get('f1_perangkat_id'),
            'a2_bidang_id' => $request->get('a2_bidang_id'),
            'h1_pagu_opd_ranwal_id' => $request->get('h1_pagu_opd_ranwal_id'),
        ])->sum('anggaran');
        $total = $anggaran + $request->get('anggaran');
        $pagu = H1PaguOpdRanwal::find($request->get('h1_pagu_opd_ranwal_id'));
        $limit = $pagu->pagu - $total;

        if ($limit < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Jumlah pagu yang dimasukan melebih batasan pagu!</div>');
        } else {
            $update = $indikator::find($request->get('idindikator'));
            $update->rincian = $request->get('rincian');
            $update->indikator = $request->get('indikator');
            $update->target = $request->get('target');
            $update->satuan = $request->get('satuan');
            $update->anggaran = $request->get('anggaran');
            $update->e_jenis_pekerjaan_id = $request->get('e_jenis_pekerjaan_id');
            $update->h1_pagu_opd_ranwal_id = $request->get('h1_pagu_opd_ranwal_id');
            $update->e_klasifikasi_id = $request->get('e_klasifikasi_id');
            $update->e_penerima_manfaat_id = $request->get('e_penerima_manfaat_id');
            $update->mulai = $request->get('mulai');
            $update->selesai = $request->get('selesai');
            $update->keterangan = $request->get('keterangan');
            $update->save();

            $lokasiupdate = L1LokasitagindikatorsubRanwal::where('j3_indikator_subkegiatan_ranwal_id', $request->get('idindikator'));
            $lokasiupdate->delete();
            foreach ($request->get('lokasi') as $value) {
                $data = [
                    'e_lokasi_id' => $value,
                    'j3_indikator_subkegiatan_ranwal_id' => $request->get('idindikator'),
                    'tahun' => $this->tahun->tahun,
                ];
                L1LokasitagindikatorsubRanwal::create($data);
            }
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator Sub Kegiatan dengan rincian : <strong>' . ucwords($update->rincian) . '</strong> berhasil diupdate</div>');
        }
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Delete Data Rincian Kegiatan Masing-masing Sub Kegiatan OPD
     *
     * @param Request $request
     * @param J3IndikatorSubkegiatanRanwal $indikator
     * @return void
     */
    public function indikatorsubkegiatandelete(Request $request, J3IndikatorSubkegiatanRanwal $indikator)
    {
        $delete = $indikator::find($request->get('idindikator'));
        $rincian = $delete->rincian;
        $delete->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Indikator Sub Kegiatan dengan rincian : <strong>' . ucwords($rincian) . '</strong> berhasil dihapus</div>');
    }

    public function destroy(Request $request)
    {
        $indikator = J3IndikatorSubkegiatanRanwal::where('i2_renja_opd_ranwal_id', $request->get('idranwal'));
        $indikator->delete();
        $ranwal = I2RenjaOpdRanwal::find($request->get('idranwal'));
        $ranwal->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Sub Kegiatan berhasil dihapus</div>');
    }



    // --------------------------------------------------------------------------------------------------

    /**
     * Cetak Dokumen Renja Masing-masing OPD
     *
     * @param [type] $idopd
     * @return void
     */
    public function cetakrenja($idopd)
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $ranwal = I2RenjaOpdRanwal::where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun])->get();
        $idNomens = [
            'urusan' => [null],
            'bidang' => [null],
            'program' => [null],
            'kegiatan' => [null],
            'subkegiatan' => [null],
            'opd' => [null],
        ];
        if (count($ranwal) !== 0) {
            foreach ($ranwal as $key => $value) {
                $idNomens['urusan'][$value->a1_urusan_id] = $value->a1_urusan_id;
                $idNomens['bidang'][$value->a2_bidang_id] = $value->a2_bidang_id;
                $idNomens['program'][$value->a3_program_id] = $value->a3_program_id;
                $idNomens['kegiatan'][$value->a4_kegiatan_id] = $value->a4_kegiatan_id;
                $idNomens['subkegiatan'][$value->a5_subkegiatan_id] = $value->a5_subkegiatan_id;
                $idNomens['opd'][$value->f1_perangkat_id] = $value->f1_perangkat_id;
            }
        }
        $nomens = A1Urusan::with([
            'bidang' => fn ($q) => $q->whereIn('id', $idNomens['bidang'])->withSum(
                [
                    'subrincianranwal' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'bidang.program' => fn ($q) => $q->whereIn('id', $idNomens['program'])->withSum(
                [
                    'subrincian' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'bidang.program.ranwalindikator' => fn ($q) => $q->where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun]),
            'bidang.program.kegiatan' => fn ($q) => $q->whereIn('id', $idNomens['kegiatan'])->withSum(
                [
                    'subrincian' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            ),
            'bidang.program.kegiatan.ranwalindikator' => fn ($q) => $q->where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun]),
            'bidang.program.kegiatan.subkegiatan' => fn ($q) => $q->whereIn('id', $idNomens['subkegiatan'])
                ->withSum(
                    [
                        'ranwalindikator' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                    ],
                    'anggaran'
                )
                ->withSum(
                    [
                        'ranwalindikator' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                    ],
                    'target'
                ),
            'bidang.program.kegiatan.subkegiatan.ranwal' => fn ($q) => $q->where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun]),
            'bidang.program.kegiatan.subkegiatan.ranwalindikator' => fn ($q) => $q->where(['f1_perangkat_id' => $idopd, 'tahun' => $this->tahun->tahun]),
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.lokasiranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.klasifikasiranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.sumberdanaranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.sumberdanaranwal.uraianpendapatanranwal',
            'bidang.program.kegiatan.subkegiatan.ranwalindikator.sumberdanaranwal.uraianpendapatanranwal.subrincianlra',
        ])
            ->whereIn('id', $idNomens['urusan'])
            ->withSum(
                [
                    'subrincian' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                ],
                'anggaran'
            )
            ->get();

        $getopd = F1Perangkat::with([
            'kepalaopd',
            'tags',
            'tags.bidang',
            'tags.bidang.paguranwal' => function ($q) use ($idopd) {
                $q->withSum('subrincianranwal', 'anggaran')->where(['f1_perangkat_id' => $idopd]);
                $q->withSum('subrinrianrutinranwal', 'anggaran')->where(['f1_perangkat_id' => $idopd]);
            },
            'tags.bidang.paguranwal.uraianpendapatanranwal',
        ])->withSum('paguopdranwal', 'pagu')
            ->withSum('subrincianranwal', 'anggaran')
            ->withSum('subrincianrutinranwal', 'anggaran')
            ->where('tahun', $this->tahun->tahun)
            ->find($idopd);

        if ($getopd == null) {
            return redirect()->route('ranwal.ranwal');
        }
        $ranwalrutin = I5RutinOpdRanwal::where([
            'f1_perangkat_id' => $idopd,
            'tahun' => $this->tahun->tahun,
        ])->get();
        $nomenRutin = [
            'opd' => [0],
            'kegiatan' => [0],
            'subkegiatan' => [0],
        ];
        if (count($nomenRutin) !== 0) {
            foreach ($ranwalrutin as $key => $value) {
                $nomenRutin['opd'] = $value->f1_perangkat_id;
                $nomenRutin['kegiatan'][$value->a7_kegiatan_rutin_id] = $value->a7_kegiatan_rutin_id;
                $nomenRutin['subkegiatan'][$value->a8_subkegiatan_rutin_id] = $value->a8_subkegiatan_rutin_id;
            }
        }
        $rutins = A6ProgramRutin::with([
            'indikatorprogranwal' => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin' => fn ($q) => $q->whereIn('id', $nomenRutin['kegiatan'])
                ->withSum(
                    ['subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)],
                    'anggaran'
                ),
            'kegiatanrutin.indikatorkegranwal' => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin' => fn ($q) => $q->whereIn('id', $nomenRutin['subkegiatan'])
                ->withSum(
                    [
                        'subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)
                    ],
                    'anggaran'
                )->withSum('subrincianrutin', 'target'),
            'kegiatanrutin.subkegiatanrutin.ranwalrutin'
            => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin.subrincianrutin'
            => fn ($q) => $q->where([
                'f1_perangkat_id' => $nomenRutin['opd'],
                'tahun' => $this->tahun->tahun
            ]),
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.lokasi',
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.klasifikasi',
            'kegiatanrutin.subkegiatanrutin.subrincianrutin.sumberdana',
        ])

            ->withSum(
                ['subrincianrutin' => fn ($q) => $q->where('tahun', $this->tahun->tahun)],
                'anggaran'
            )->get();

        return view('ranwal.ranwalopdcetak', [
            'title' => 'Renja OPD',
            'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . $this->tahun->tahun,
            'opd' => $getopd,
            'rutins' => $rutins,
            'nomens' => $nomens,
        ]);
    }
}
