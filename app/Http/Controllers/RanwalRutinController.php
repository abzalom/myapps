<?php

namespace App\Http\Controllers;

use App\Models\A8SubkegiatanRutin;
use App\Models\H1PaguOpdRanwal;
use App\Models\I5RutinOpdRanwal;
use App\Models\J3IndikatorSubkegiatanRanwal;
use App\Models\J4IndikatorProgramRutinRanwal;
use App\Models\J5IndikatorKegiatanRutinRanwal;
use App\Models\J6SubrincianRutinRanwal;
use App\Models\L2LokasiSubrincianRanwal;
use Illuminate\Http\Request;

class RanwalRutinController extends Controller
{
    public function store(Request $request)
    {
        $kodeunik = $request->get('program') . '.' . $request->get('kegiatan') . '.' . $request->get('subkegiatan') . '.' . $request->get('idopd');
        $subkeg = A8SubkegiatanRutin::find($request->get('subkegiatan'));
        $data = [
            'f1_perangkat_id' => $request->get('idopd'),
            'a6_program_rutin_id' => $request->get('program'),
            'a7_kegiatan_rutin_id' => $request->get('kegiatan'),
            'a8_subkegiatan_rutin_id' => $request->get('subkegiatan'),
            'e_prioritas_nasional_id' => $request->get('prionas'),
            'e_prioritas_provinsi_id' => $request->get('prioprov'),
            'e_prioritas_daerah_id' => $request->get('prioda'),
            'e_tahapan_id' => $this->tahapan->id,
            'e_tahun_anggaran_id' => $this->tahun->id,
            'status' => 1,
            'tahun' => $this->tahun->tahun,
            'kode_unik_renja' => $kodeunik,
        ];
        I5RutinOpdRanwal::create($data);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Sub Kegiatan <strong>X.XX.' . $subkeg->kode_unik_subkegiatan . ' - ' . $subkeg->uraian . '</strong> berhasil ditambahkan</div>');
    }

    public function destory(Request $request)
    {
        $i5rutin = I5RutinOpdRanwal::find($request->idranwalRutin);
        $uraian = A8SubkegiatanRutin::find($i5rutin->a8_subkegiatan_rutin_id);
        $j6subrincian = J6SubrincianRutinRanwal::where('i5_rutin_opd_ranwal_id', $i5rutin->id);
        $j6subrincian->delete();
        $i5rutin->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Sub Kegiatan <strong>: X.XX.' . $uraian->kode_unik_subkegiatan . ' - ' . $uraian->uraian . '</strong> berhasil dihapus</div>');
    }

    public function subrincianstore(Request $request, J3IndikatorSubkegiatanRanwal $indikator, J6SubrincianRutinRanwal $subrincianrutin)
    {
        $nonrutin = $indikator::where([
            'f1_perangkat_id' => $request->get('f1_perangkat_id'),
            'a2_bidang_id' => $request->get('a2_bidang_id'),
            'h1_pagu_opd_ranwal_id' => $request->get('h1_pagu_opd_ranwal_id'),
        ])->sum('anggaran');
        $rutin = $subrincianrutin::where([
            'f1_perangkat_id' => $request->get('f1_perangkat_id'),
            'h1_pagu_opd_ranwal_id' => $request->get('h1_pagu_opd_ranwal_id'),
        ])->sum('anggaran');
        $paguopd = H1PaguOpdRanwal::find($request->get('h1_pagu_opd_ranwal_id'));
        $total = $rutin + $nonrutin + str_replace(',', '.', $request->get('anggaran'));
        $limit = $paguopd->pagu - $total;
        $request->merge(['anggaran' => str_replace(',', '.', $request->get('anggaran'))]);
        if ($limit < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-danger">Jumlah anggaran melebihi batasan pagu!</div>');
        } else {
            // dump($request->all());
            $getid = $subrincianrutin::create($request->except('_token', 'lokasi'));
            $dataLokasi = [];
            foreach ($request->get('lokasi') as $key => $value) {
                $data = [
                    'e_lokasi_id' => $value,
                    'j6_subrincian_rutin_ranwal_id' => $getid->id,
                    'tahun' => $this->tahun->tahun,
                ];
                L2LokasiSubrincianRanwal::create($data);
            }
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator Sub Kegiatan berhasil ditambahkan</div>');
        }
    }

    public function subrincianupdate(Request $request, J3IndikatorSubkegiatanRanwal $indikator, J6SubrincianRutinRanwal $subrincianrutin)
    {
        // return $request->all();
        $datarutin = $subrincianrutin::find($request->get('idsubrincian'));
        $anggaran_rutin = $subrincianrutin::where([
            'f1_perangkat_id' => $datarutin->f1_perangkat_id,
            'a2_bidang_id' => $datarutin->a2_bidang_id,
            'h1_pagu_opd_ranwal_id' => $datarutin->h1_pagu_opd_ranwal_id,
        ])->whereNot('id', $datarutin->id)->sum('anggaran');
        $anggaran_non_rutin = $indikator::where([
            'f1_perangkat_id' => $datarutin->f1_perangkat_id,
            'a2_bidang_id' => $datarutin->a2_bidang_id,
            'h1_pagu_opd_ranwal_id' => $datarutin->h1_pagu_opd_ranwal_id,
        ])->sum('anggaran');
        $paguopd = H1PaguOpdRanwal::find($datarutin->h1_pagu_opd_ranwal_id);
        $total = $anggaran_rutin + $anggaran_non_rutin + str_replace(',', '.', $request->get('anggaran'));
        $limit = $paguopd->pagu - $total;

        if ($limit < 0) {
            return redirect()->back()->with('pesan', '<div class="alert alert-danger">Jumlah anggaran melebihi Rp. ' . number_format($total - $paguopd->pagu, 2, ',', '.') . ' dari batasan pagu sebesar Rp. ' . number_format($paguopd->pagu, 2, ',', '.') . ' !</div>');
        } else {
            $datarutin->rincian = $request->get('rincian');
            $datarutin->target = $request->get('target');
            $datarutin->anggaran = str_replace(',', '.', $request->get('anggaran'));
            $datarutin->h1_pagu_opd_ranwal_id = $request->get('h1_pagu_opd_ranwal_id');
            $datarutin->e_jenis_pekerjaan_id = $request->get('e_jenis_pekerjaan_id');
            $datarutin->keterangan = $request->get('keterangan');
            // return $datarutin->toArray();
            $lokasi = L2LokasiSubrincianRanwal::where('j6_subrincian_rutin_ranwal_id', $datarutin->id);
            $lokasi->delete();
            $datarutin->save();
            foreach ($request->get('lokasi') as $key => $value) {
                $datalokasi = [
                    'e_lokasi_id' => $value,
                    'j6_subrincian_rutin_ranwal_id' => $datarutin->id,
                    'tahun' => $this->tahun->tahun,
                ];
                L2LokasiSubrincianRanwal::create($datalokasi);
            }
            return redirect()->back()->with('pesan', '<div class="alert alert-warning">Indikator ' . $datarutin->uraian . ' berhasil diupdate</div>');
        }
    }

    public function subrinciandelete(Request $request, J6SubrincianRutinRanwal $subrincianrutin)
    {
        $datarutin = $subrincianrutin::find($request->get('idsubrincianrutin'));
        $datarutin->delete();
        return redirect()->back()->with('pesan', '<div class="alert alert-danger">Indikator berhasil dihapus!</div>');
    }

    public function indikatorprogramstore(Request $request)
    {
        if ($request->idindikator == null) {
            J4IndikatorProgramRutinRanwal::create($request->except('_token'));
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator program rutin berhasil ditambahkan!</div>');
        } else {
            $indikator = J4IndikatorProgramRutinRanwal::find($request->idindikator);
            $indikator->sasaran = $request->sasaran;
            $indikator->capaian = $request->capaian;
            $indikator->target = $request->target;
            $indikator->satuan = $request->satuan;
            $indikator->save();
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator program rutin berhasil diupdate!</div>');
        }
    }

    public function indikatorkegiatanstore(Request $request)
    {
        if ($request->idindikator == null) {
            J5IndikatorKegiatanRutinRanwal::create($request->except('_token', 'idindikator'));
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator kegiatan rutin berhasil ditambahkan!</div>');
        } else {
            $indikator = J5IndikatorKegiatanRutinRanwal::find($request->idindikator);
            $indikator->capaian = $request->capaian;
            $indikator->target_capaian = $request->target_capaian;
            $indikator->satuan_capaian = $request->satuan_capaian;
            $indikator->keluaran = $request->keluaran;
            $indikator->target_keluaran = $request->target_keluaran;
            $indikator->satuan_keluaran = $request->satuan_keluaran;
            $indikator->hasil = $request->hasil;
            $indikator->target_hasil = $request->target_hasil;
            $indikator->satuan_hasil = $request->satuan_hasil;
            $indikator->save();
            return redirect()->back()->with('pesan', '<div class="alert alert-success">Indikator kegiatan rutin berhasil diupdate!</div>');
        }
    }
}
