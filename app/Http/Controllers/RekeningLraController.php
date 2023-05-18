<?php

namespace App\Http\Controllers;

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
use Illuminate\Http\Request;

class RekeningLraController extends Controller
{
    public function index()
    {
        return view('rekening.lra', [
            'title' => 'Rekening LRA',
            'desc' => 'Rekening Laporan Realisasi Anggaran (LRA)',
            'akuns' => C1AkunLra::all(),
        ]);
    }

    public function kelompok($akun)
    {
        $kelompoks = C2KelompokLra::where('c1_akun_lra_id', $akun)->get();
        foreach ($kelompoks as $kelompok) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            echo '<button class="btn btn-secondary btn-sm kelompok" type="button" value="' . $kelompok->id . '" data-bs-toggle="collapse" data-bs-target="#kelompok' . $kelompok->id . '" aria-expanded="false" aria-controls="kelompok' . $kelompok->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $kelompok->kode_unik_kelompok . ' - ' . $kelompok->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="kelompok' . $kelompok->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function jenis($kelompok)
    {
        $jenises = C3JenisLra::where('c2_kelompok_lra_id', $kelompok)->get();
        foreach ($jenises as $jenis) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            echo '<button class="btn btn-warning btn-sm jenis" type="button" value="' . $jenis->id . '" data-bs-toggle="collapse" data-bs-target="#jenis' . $jenis->id . '" aria-expanded="false" aria-controls="jenis' . $jenis->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $jenis->kode_unik_jenis . ' - ' . $jenis->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="jenis' . $jenis->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function objek($jenis)
    {
        $objeks = C4ObjekLra::where('c3_jenis_lra_id', $jenis)->get();
        foreach ($objeks as $objek) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            echo '<button class="btn btn-success btn-sm objek" type="button" value="' . $objek->id . '" data-bs-toggle="collapse" data-bs-target="#objek' . $objek->id . '" aria-expanded="false" aria-controls="objek' . $objek->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $objek->kode_unik_objek . ' - ' . $objek->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="objek' . $objek->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function rincian($objek)
    {
        $rincians = C5RincianLra::where('c4_objek_lra_id', $objek)->get();
        foreach ($rincians as $rincian) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            echo '<button class="btn btn-info btn-sm rincian" type="button" value="' . $rincian->id . '" data-bs-toggle="collapse" data-bs-target="#rincian' . $rincian->id . '" aria-expanded="false" aria-controls="rincian' . $rincian->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $rincian->kode_unik_rincian . ' - ' . $rincian->uraian;
            echo '<button class="btn btn-primary btn-sm ms-3" data-bs-target="modal"><i class="fa-solid fa-plus-circle"></i></button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="rincian' . $rincian->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function subrincian($rincian)
    {
        $subrincians = C6SubrincianLra::where('c5_rincian_lra_id', $rincian)->get();
        foreach ($subrincians as $subrincian) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            // echo '<button class="btn btn-warning btn-sm subrincian" type="button" value="' . $subrincian->id . '" data-bs-toggle="collapse" data-bs-target="#subrincian' . $subrincian->id . '" aria-expanded="false" aria-controls="subrincian' . $subrincian->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<a href="#copy" onclick="copyToClipboard(\'ambil_' . $subrincian->kode_unik_subrincian . '\')"><i class="far fa-copy fa-lg"></i></a> ' . '<span id="ambil_' . $subrincian->kode_unik_subrincian . '">' . $subrincian->kode_unik_subrincian . '</span>' . ' - ' . $subrincian->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="subrincian' . $subrincian->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function rekapan($akun)
    {
        $rekenings = C1AkunLra::with([
            'kelompok',
            'kelompok.jenis',
            'kelompok.jenis.objek',
            'kelompok.jenis.objek.rincian',
            'kelompok.jenis.objek.rincian.subrincian',
        ])
            ->where('kode_unik_akun', $akun)
            ->get();
        return view('rekening.rekapan', [
            'title' => 'Rekening',
            'desc' => 'Data Rekening',
            'rekenings' => $rekenings,
        ]);
    }
}
