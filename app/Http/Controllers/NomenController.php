<?php

namespace App\Http\Controllers;

use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\A3Program;
use App\Models\A4Kegiatan;
use App\Models\A5Subkegiatan;
use Illuminate\Http\Request;

class NomenController extends Controller
{
    public function urusan()
    {
        $nomens = A1Urusan::where('kewenangan', true)->get();
        return view('nomens.urusan', [
            'title' => 'Nomenklatur',
            'desc' => 'Nomenklatur Kepmendagri 050-5889 Tahun 2021',
            'nomens' => $nomens,
        ]);
    }

    public function bidang($urusan)
    {
        $nomens = A1Urusan::with([
            'bidang',
        ])->where(['kewenangan' => true])->find($urusan);
        return view('nomens.bidang', [
            'title' => 'Nomenklatur',
            'desc' => 'Nomenklatur Kepmendagri 050-5889 Tahun 2021',
            'nomens' => $nomens,
        ]);
    }

    public function program($urusan, $bidang)
    {
        $nomens = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('id', $bidang),
            'bidang.program',
        ])->where(['kewenangan' => true])->find($urusan);
        // dd($nomens->toArray());
        return view('nomens.program', [
            'title' => 'Nomenklatur',
            'desc' => 'Nomenklatur Kepmendagri 050-5889 Tahun 2021',
            'nomens' => $nomens,
        ]);
    }

    public function kegiatan($urusan, $bidang, $program)
    {
        $nomens = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('id', $bidang),
            'bidang.program' => fn ($q) => $q->where('id', $program),
            'bidang.program.kegiatan',
        ])->where(['kewenangan' => true])->find($urusan);
        // dd($nomens->toArray());
        return view('nomens.kegiatan', [
            'title' => 'Nomenklatur',
            'desc' => 'Nomenklatur Kepmendagri 050-5889 Tahun 2021',
            'nomens' => $nomens,
        ]);
    }

    public function subkegiatan($urusan, $bidang, $program, $kegiatan)
    {
        $nomens = A1Urusan::with([
            'bidang' => fn ($q) => $q->where('id', $bidang),
            'bidang.program' => fn ($q) => $q->where('id', $program),
            'bidang.program.kegiatan' => fn ($q) => $q->where('id', $kegiatan),
            'bidang.program.kegiatan.subkegiatan',
        ])->where(['kewenangan' => true])->find($urusan);
        // dump($nomens->toArray());
        return view('nomens.subkegiatan', [
            'title' => 'Nomenklatur',
            'desc' => 'Nomenklatur Kepmendagri 050-5889 Tahun 2021',
            'nomens' => $nomens,
        ]);
    }

    public function apibidang($id1, $id2 = null)
    {
        $bids = A2Bidang::whereNotIn('id', [$id1, $id2])->get();
        echo '<option value=""></option>';
        foreach ($bids as $bid) {
            echo '<option value="' . $bid->id . '">' . $bid->kode_unik_bidang . ' - ' . $bid->uraian . '</option>';
        }
    }

    public function apisubkegiatan($id)
    {
        return A5Subkegiatan::find($id);
    }
}
