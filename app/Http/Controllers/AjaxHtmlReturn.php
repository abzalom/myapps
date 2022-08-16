<?php

namespace App\Http\Controllers;

use App\Models\A2Bidang;
use App\Models\EStatusHistoryPagu;
use App\Models\F1Perangkat;
use App\Models\F2Tagging;
use App\Models\H1PaguOpd;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\each;

class AjaxHtmlReturn extends Controller
{
    // Pindah pagu dengan sumber dana
    public function opdexcept($idopd)
    {
        $opd = F1Perangkat::where('tahun', $this->tahun->tahun)->whereNot('id', $idopd)->get();
        echo '<option value="">Pilih OPD</option>';
        foreach ($opd as $value) {
            echo '<option value="' . $value->id . '">' . $value->kode_perangkat . ' - ' . $value->nama_perangkat . '</option>';
        }
    }

    public function getbidangpindah($idopd)
    {
        $tags = F2Tagging::where('f1_perangkat_id', $idopd)->get();
        $ids = [];
        foreach ($tags as $value) {
            $ids[] = $value->a2_bidang_id;
        }
        $a2bidang = A2Bidang::whereIn('id', $ids)->get();
        echo '<option value="">Pilih Bidang</option>';
        foreach ($a2bidang as $key => $value) {
            echo '<option value="' . $value->id . '" data-urusan="' . $value->a1_urusan_id . '">' . $value->kode_unik_bidang . ' - ' . $value->uraian . '</option>';
        }
    }

    public function pagupindahopd($idopd, $a2bidang)
    {
        $pagupindahan = H1PaguOpd::with('pendapatan')->where(['f1_perangkat_id' => $idopd, 'a2_bidang_id' => $a2bidang, 'tahun' => $this->tahun->tahun])->get();
        echo '<option value="">Pilih Sumber Dana</option>';
        foreach ($pagupindahan as $pagu) {
            echo '<option value="' . $pagu->pendapatan->id . '">' . $pagu->pendapatan->uraian . '</option>';
        }
    }

    // Edit biasa

    public function editpagubiasa($idopd, $idpagu)
    {
        $pagu = H1PaguOpd::where(['id' => $idpagu, 'f1_perangkat_id' => $idopd])->first();
        return $pagu;
    }

    public function statuspaguedit()
    {
        $statuspaguedit = EStatusHistoryPagu::whereIn('id', [2, 3])->get();
        echo '<option value="">Pilih</option>';
        foreach ($statuspaguedit as $value) {
            echo '<option value="' . $value->id . '">' . ucwords($value->uraian) . '</option>';
        }
    }

    public function getopdbypendapatanuraian($idpendapatanuraian, $idopd)
    {
        $sumbers = H1PaguOpd::with('opd')->where('g1_pendapatan_uraian_id', $idpendapatanuraian)->whereNot('f1_perangkat_id', $idopd)->get();
        $getIdOPds = [];
        foreach ($sumbers as $key => $value) {
            $getIdOPds[$value->f1_perangkat_id] = $value->f1_perangkat_id;
        }
        $opds = F1Perangkat::whereIn('id', $getIdOPds)->get();
        echo '<option value="">Pilih</option>';
        foreach ($opds as $opd) {
            // dump($opd->toArray());
            echo '<option value="' . $opd->id . '">' . $opd->kode_perangkat . ' - ' . ucwords($opd->nama_perangkat) . '</option>';
        }
    }

    public function getbidangbyopd($idopd) // Pindah pagu antar OPD dengan sumber dana yang sama
    {
        $tags = F2Tagging::where('f1_perangkat_id', $idopd)->get();
        $ids = [];
        foreach ($tags as $key => $value) {
            $ids[] = $value->a2_bidang_id;
        }
        $a2bidang = A2Bidang::whereIn('id', $ids)->get();

        // dump($a2bidang->toArray());
        // dump($tags->toArray());

        // Return Option data
        echo '<option value="">Pilih</option>';
        foreach ($a2bidang as $key => $value) {
            echo '<option value="' . $value->id . '">' . ucwords($value->uraian) . '</option>';
        }
    }
}
