<?php

namespace App\Http\Controllers;

use App\Models\A1Urusan;
use App\Models\C6SubrincianLra;
use App\Models\EStatusHistoryPagu;
use App\Models\F1Perangkat;
use App\Models\F2Tagging;
use App\Models\G1Pendapatan;
use App\Models\G1PendapatanUraian;
use App\Models\G2PendapatanUraianRanwal;
use App\Models\H1PaguOpd;
use App\Models\H1PaguOpdHistory;
use App\Models\H1PaguOpdRanwal;
use App\Models\H1PaguOpdRanwalHistory;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PaguController extends Controller
{
    public function paguopd()
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        $nomens = A1Urusan::with([
            'bidang',
            'bidang.tags' => fn ($q) => $q->where('tahun', $this->tahun->tahun),
            'bidang.tags.opd' => fn ($q) => $q->where('tahun', $this->tahun->tahun),
            'bidang.tags.opd.paguopd' => fn ($q) => $q->where('tahun', $this->tahun->tahun),
        ])->get();
        return view('pengaturan.paguopd', [
            'title' => 'Pagu OPD',
            'desc' => 'Pengaturan Pagu OPD',
            'nomens' => $nomens,
            'sumbers' => G1PendapatanUraian::all(),
            'statusHistory' => EStatusHistoryPagu::whereIn('id', [2, 3])->get(),
            'tahapan' => $this->tahapan,
        ]);
    }

    public function pagustore(Request $request)
    {
        $opd = F1Perangkat::with([
            'tags' => fn ($q) => $q->where([
                'a1_urusan_id' => (int) $request->get('urusan_baru_id'),
                'a2_bidang_id' => (int) $request->get('bidang_baru_id'),
                'f1_perangkat_id' => (int) $request->get('idopd_baru'),
                'tahun' => $this->tahun->tahun,
            ]),
        ])
            ->where('tahun', $this->tahun->tahun)
            ->find((int) $request->get('idopd_baru'));

        if ($request->get('statuspagu') == 1) {
            $g1pendapatan = G1PendapatanUraian::withSum(
                ['paguopd'
                => fn ($q) => $q->where('tahun', $this->tahun->tahun)],
                'pagu'
            )
                ->where('tahun', $this->tahun->tahun)
                ->find((int) $request->get('sumber_baru'));
            $c6subrincian = C6SubrincianLra::find($g1pendapatan->c6_subrincian_lra_id);
            // Check jika pagu over dari pendapatan
            (int) $total = $g1pendapatan->paguopd_sum_pagu + (int) $request->get('pagu_baru');
            (int) $selisih = (int)$g1pendapatan->anggaran - $total;
            if ($selisih < 0) {
                return redirect()->back()->with('pesan', '<div class="alert alert-danger"><i class="fa-solid fa-exclamation-triangle fa-2xl"></i> Jumlah pagu yang di input sebesar <strong>Rp. ' . number_format($request->get('pagu_baru'), 2, ',', '.') . '</strong> melebihi jumlah pendapatan sebesar <strong>Rp. ' . number_format($g1pendapatan->anggaran, 2, ',', '.') . '</strong> dari sumber dana <strong>' . $g1pendapatan->uraian . '</strong> pada <strong>' . $opd->nama_perangkat . '</strong></div>');
            }

            // Siapkan data
            $dataBaru = [
                'a1_urusan_id' => (int) $request->get('urusan_baru_id'),
                'a2_bidang_id' => (int) $request->get('bidang_baru_id'),
                'f1_perangkat_id' => $opd->id,
                'g1_pendapatan_uraian_id' => $g1pendapatan->id,
                'c6_subrincian_lra_id' => $g1pendapatan->c6_subrincian_lra_id,
                'pagu' => str_replace(',', '.', $request->get('pagu_baru')),
                'tahun' => $this->tahun->tahun,
            ];

            // Siapkan History
            $dataHistory = [
                'f1_perangkat_id' => $opd->id,
                'sumber' => $g1pendapatan->uraian,
                'subrekening' => $c6subrincian->uraian,
                'c6_subrincian_lra_id' => $c6subrincian->id,
                'pagu' => str_replace(',', '.', $request->get('pagu_baru')),
                'tahun' => $this->tahun->tahun,
                'e_status_history_pagu_id' => (int) $request->get('statuspagu'),
                'keterangan' => 'pagu awal pembagian',
                'peruntukan' => 'pagu awal pembagian',
                'tahun' => $this->tahun->tahun,
            ];
            $pagu_baru = new H1PaguOpd;
            $paguHistory = new H1PaguOpdHistory;
            $pagu_baru->create($dataBaru);
            $paguHistory->create($dataHistory);
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Sumber dana <strong>' . $g1pendapatan->uraian . '</strong> telah di tambahkan ke <strong>' . strtoupper($opd->nama_perangkat) . '</strong> dengan jumlah anggaran sebesar <strong>Rp. ' . number_format(str_replace(',', '.', $request->get('pagu_baru')), 2, ',', '.') . '</strong></div>');
        } else {
            $opd_sebelumnya = H1PaguOpd::where([
                'f1_perangkat_id' => $request->get('opd_pindahan'),
                'g1_pendapatan_uraian_id' => $request->get('sumber_pidahan'),
                'tahun' => $this->tahun->tahun,
            ])->first();
            $pagu_baru_pada_opd_sebelumnya = $opd_sebelumnya->pagu - (int) $request->get('pagu_pindahan');
            $opdLama = F1Perangkat::where('tahun', $this->tahun->tahun)->find($request->get('opd_pindahan'));


            if ($pagu_baru_pada_opd_sebelumnya < 0) {
                return redirect()->back()->with('pesan', '<div class="alert alert-danger"><i class="fa-solid fa-exclamation-triangle fa-2xl"></i> Pemindahan pagu dari <strong class="text-danger">' . $opdLama->nama_perangkat . '</strong> ke <strong class="text-danger">' . $opd->nama_perangkat . '</strong> gagal karena jumlah pagu yang di input <strong class="text-danger">melebihi</strong> jumlah pagu pada opd sebelumnya yaitu hanya sebesar <strong class="text-danger">Rp. ' . number_format($opd_sebelumnya->pagu, 2, ',', '.') . '</strong></div>');
            }

            $paguawal = $opd_sebelumnya->pagu;
            $opd_sebelumnya->pagu = $pagu_baru_pada_opd_sebelumnya;
            $opd_sebelumnya->save();

            $g1pendapatan = G1PendapatanUraian::where('tahun', $this->tahun->tahun)->find((int) $request->get('sumber_pidahan'));
            $c6subrincian = C6SubrincianLra::find($g1pendapatan->c6_subrincian_lra_id);

            $dataBaru = [
                'a1_urusan_id' => (int) $request->get('urusan_baru_id'),
                'a2_bidang_id' => (int) $request->get('bidang_baru_id'),
                'f1_perangkat_id' => $opd->id,
                'g1_pendapatan_uraian_id' => $g1pendapatan->id,
                'c6_subrincian_lra_id' => $opd_sebelumnya->c6_subrincian_lra_id,
                'pagu' => str_replace(',', '.', $request->get('pagu_pindahan')),
                'tahun' => $this->tahun->tahun,
            ];

            $dataHistory = [
                [
                    'f1_perangkat_id' => $opd->id,
                    'sumber' => $g1pendapatan->uraian,
                    'subrekening' => $c6subrincian->uraian,
                    'c6_subrincian_lra_id' => $c6subrincian->id,
                    'pagu' => str_replace(',', '.', $request->get('pagu_pindahan')),
                    'tahun' => $this->tahun->tahun,
                    'e_status_history_pagu_id' => (int) $request->get('statuspagu'),
                    'keterangan' => 'Diambil anggaran sebesar Rp. ' . number_format(str_replace(',', '.', $request->get('pagu_pindahan')), 2, ',', '.') . ' dari ' . $opdLama->nama_perangkat,
                    'peruntukan' => $request->get('tujuan_pindah'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'f1_perangkat_id' => $opd_sebelumnya->f1_perangkat_id,
                    'sumber' => $g1pendapatan->uraian,
                    'subrekening' => $c6subrincian->uraian,
                    'c6_subrincian_lra_id' => $c6subrincian->id,
                    'pagu' => $opd_sebelumnya->pagu,
                    'tahun' => $this->tahun->tahun,
                    'e_status_history_pagu_id' => (int) $request->get('statuspagu'),
                    'keterangan' => 'Anggaran berkurang sebesar Rp. ' . number_format(str_replace(',', '.', $request->get('pagu_pindahan')), 2, ',', '.') . ' dan di pindahkan ke ' . $opd->nama_perangkat,
                    'peruntukan' => str_replace(',', '.', $request->get('tujuan_pindah')),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            $pagu_baru = new H1PaguOpd;
            $pagu_baru->create($dataBaru);
            $paguHistory = new H1PaguOpdHistory;
            $paguHistory->insert($dataHistory);
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Sumber dana <strong>' . $g1pendapatan->uraian . '</strong> telah di tambahkan ke <strong>' . strtoupper($opd->nama_perangkat) . '</strong> dengan jumlah anggaran sebesar <strong>Rp. ' . number_format(str_replace(',', '.', $request->get('pagu_pindahan')), 2, ',', '.') . '</strong> yang diambil dari <strong>' . strtoupper($opdLama->nama_perangkat) . '</strong></div>');
        }
    }

    public function paguupdatereguler(Request $request)
    {
        if ($request->get('tujuan_edit_biasa') == null) {
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Alasan perubahan pagu wajib diisi!</div>');
        }
        $pagu = H1PaguOpd::find($request->get('idpagu'));
        $pagu->pagu = $request->get('jumlah_pagu');

        $opd = F1Perangkat::find($request->get('idopd'));
        $g1pendapatan = G1PendapatanUraian::find($pagu->g1_pendapatan_uraian_id);
        $c6subrincian = C6SubrincianLra::find($pagu->c6_subrincian_lra_id);

        $jumlah_pagu = str_replace(',', '.', $request->get('jumlah_pagu'));
        $pagu_awal = str_replace(',', '.', $request->get('pagu_awal'));
        $tambah_pagu = str_replace(',', '.', $request->get('tambah_pagu'));
        $kurang_pagu = str_replace(',', '.', $request->get('kurang_pagu'));

        if ((int) $request->get('status_pagu') == 2) {
            $ket = 'Jumlah anggaran pagu pada ' . $opd->nama_perangkat . ' yang bersumber dari ' . $g1pendapatan->uraian . ' bertambah sebesar Rp. ' . number_format($tambah_pagu, 2, ',', '.') . ' sehingga anggaran bertambah menjadi sebesar Rp. ' . number_format($jumlah_pagu, 2, ',', '.') . ' dari jumlah sebelumnya sebesar Rp. ' . number_format($pagu_awal, 2, ',', '.');
        }
        if ((int) $request->get('status_pagu') == 3) {
            $ket = 'Jumlah anggaran pagu pada ' . $opd->nama_perangkat . ' yang bersumber dari ' . $g1pendapatan->uraian . ' berkurang sebesar Rp. ' . number_format($kurang_pagu, 2, ',', '.') . ' sehingga anggaran berkurang menjadi sebesar Rp. ' . number_format($jumlah_pagu, 2, ',', '.') . ' dari jumlah sebelumnya sebesar Rp. ' . number_format($pagu_awal, 2, ',', '.');
        }

        $dataHistory = [
            'f1_perangkat_id' => $opd->id,
            'sumber' => $g1pendapatan->uraian,
            'subrekening' => $c6subrincian->uraian,
            'c6_subrincian_lra_id' => $c6subrincian->id,
            'pagu' => $jumlah_pagu,
            'tahun' => $this->tahun->tahun,
            'e_status_history_pagu_id' => (int) $request->get('status_pagu'),
            'keterangan' => $ket,
            'peruntukan' => $request->get('tujuan_edit_biasa'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $pagu->save();
        $history = new H1PaguOpdHistory();
        $history->create($dataHistory);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">' . $ket . '</div>');
    }

    public function paguupdatepindah(Request $request, H1PaguOpd $h1PaguOpd)
    {
        (int) $sisa = $request->get('pagu_sisa');
        if ($sisa < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-danger"><i class="fa-solid fa-exclamation-triangle fa-2xl"></i> Jumlah pagu yang dipindahkan melebihi jumlah pagu sebelumnya</div>');
        }

        $g1pendapatan = G1PendapatanUraian::find($request->get('id_pedapatan_uraian'));

        $opdawal = F1Perangkat::find($request->get('idopd'));
        $c6subrincian = C6SubrincianLra::find($g1pendapatan->c6_subrincian_lra_id);

        $paguopdawal = $h1PaguOpd::find($request->get('idpagu'));

        $opdtujuan = F1Perangkat::find($request->get('opd_tujuan'));
        $paguopdtujuan = $h1PaguOpd::where([
            'f1_perangkat_id' => $request->get('opd_tujuan'),
            'a2_bidang_id' => $request->get('bidang_tujuan'),
            'g1_pendapatan_uraian_id' => $request->get('id_pedapatan_uraian'),
            'tahun' => $this->tahun->tahun,
        ])->first();

        $paguopdawal->pagu = $request->get('pagu_sisa');
        $nilaitujuansebelum = $paguopdtujuan->pagu;
        $paguopdtujuan->pagu = $paguopdtujuan->pagu + $request->get('pagu_pindah');

        $dataHistoryawal = [
            'f1_perangkat_id' => $opdawal->id,
            'sumber' => $g1pendapatan->uraian,
            'subrekening' => $c6subrincian->uraian,
            'c6_subrincian_lra_id' => $c6subrincian->id,
            'pagu' => $paguopdawal->pagu,
            'tahun' => $this->tahun->tahun,
            'e_status_history_pagu_id' => (int) $request->get('status_pagu'),
            'keterangan' => 'dipindahkan jumlah pagu sebesar Rp. ' . number_format($request->get('pagu_pindah'), 2, ',', '.') . ' dari ' . $opdawal->nama_perangkat . ' ke ' . $opdtujuan->nama_perangkat . ' yang bersumber dari ' . $g1pendapatan->uraian . ' sehingga aggaran yang tersisa sebesar Rp. ' . number_format($request->get('pagu_sisa'), 2, ',', '.') . ' dari nilai sebelumnya sebesar Rp. ' . number_format($request->get('pagu_awal'), 2, ',', '.'),
            'peruntukan' => $request->get('tujuan_pindah'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $dataHistoryTujuan = [
            'f1_perangkat_id' => $opdtujuan->id,
            'sumber' => $g1pendapatan->uraian,
            'subrekening' => $c6subrincian->uraian,
            'c6_subrincian_lra_id' => $c6subrincian->id,
            'pagu' => $paguopdtujuan->pagu,
            'tahun' => $this->tahun->tahun,
            'e_status_history_pagu_id' => (int) $request->get('status_pagu'),
            'keterangan' => 'anggaran bertambah sebesar Rp. ' . number_format($request->get('pagu_pindah'), 2, ',', '.') . ' yang diambil dari ' . $opdawal->nama_perangkat . ' yang bersumber dari ' . $g1pendapatan->uraian . ' sehingga aggaran yang menjadi sebesar Rp. ' . number_format($paguopdtujuan->pagu, 2, ',', '.') . ' dari nilai sebelumnya sebesar Rp. ' . number_format($nilaitujuansebelum, 2, ',', '.'),
            'peruntukan' => $request->get('tujuan_pindah'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $paguopdawal->save();
        $paguopdtujuan->save();
        H1PaguOpdHistory::create($dataHistoryawal);
        H1PaguOpdHistory::create($dataHistoryTujuan);
        return redirect()->back()->with('pesan', '<div class="alert alert-success"><i class="fa-solid fa-check-circle fa-2xl"></i> Pagu dengan jumlah sebesaar Rp. ' . number_format($request->get('pagu_pindah'), 2, ',', '.') . ' yang bersumber dari ' . $g1pendapatan->uraian . ' berhasil dipindahkan dari ' . $opdawal->nama_perangkat . ' ke ' . $opdtujuan->nama_perangkat . '</div>');
    }

    public function paguvalidasi(Request $request)
    {
        $paguopd = H1PaguOpd::all();
        // $paguranwal = H1PaguOpdRanwal::where('tahun', $this->tahun->tahun);
        // return $paguopd;

        H1PaguOpdRanwal::truncate();
        if ($request->get('tahapan') == 1) {
            $data = [];
            foreach ($paguopd as $key => $value) {
                H1PaguOpdRanwal::insert([
                    'id' => $value->id,
                    'a1_urusan_id' => $value->a1_urusan_id,
                    'a2_bidang_id' => $value->a2_bidang_id,
                    'f1_perangkat_id' => $value->f1_perangkat_id,
                    'g2_pendapatan_uraian_ranwal_id' => $value->g1_pendapatan_uraian_id,
                    'c6_subrincian_lra_id' => $value->c6_subrincian_lra_id,
                    'pagu' => $value->pagu,
                    'tahun' => $value->tahun,
                    'deleted_at' => $value->deleted_at,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                ]);
            }
            return redirect()->back()->with('pesan', '<div class="alert alert-success"><i class="fa-solid fa-check-circle fa-2xl"></i> Pagu OPD pada tahapan Rancangan Awal Berhasil tervalidasi!</div>');
        }
    }
}
