<?php

namespace App\Http\Controllers;

use App\Models\D1AkunLo;
use App\Models\D2KelompokLo;
use App\Models\D3JenisLo;
use App\Models\D4ObjekLo;
use App\Models\D5RincianLo;
use App\Models\D6SubrincianLo;
use Illuminate\Http\Request;

class RekeningLoController extends Controller
{
    public function index()
    {
        return view('rekening.lo', [
            'title' => 'Rekening LO',
            'desc' => 'Rekening Laporan Operasional (LO)',
            'akuns' => D1AkunLo::all(),
        ]);
    }

    public function kelompok($akun)
    {
        $kelompoks = D2KelompokLo::where('d1_akun_lo_id', $akun)->get();
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
        $jenises = D3JenisLo::where('d2_kelompok_lo_id', $kelompok)->get();
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
        $objeks = D4ObjekLo::where('d3_jenis_lo_id', $jenis)->get();
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
        $rincians = D5RincianLo::where('d4_objek_lo_id', $objek)->get();
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
        $subrincians = D6SubrincianLo::where('d5_rincian_lo_id', $rincian)->get();
        foreach ($subrincians as $subrincian) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 7%">';
            // echo '<button class="btn btn-warning btn-sm subrincian" type="button" value="' . $subrincian->id . '" data-bs-toggle="collapse" data-bs-target="#subrincian' . $subrincian->id . '" aria-expanded="false" aria-controls="subrincian' . $subrincian->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-10">';
            echo $subrincian->kode_unik_subrincian . ' - ' . $subrincian->uraian;
            echo '</div>';
            echo '<div class="col-2">';
            echo $subrincian->kategori_ssh . ' - ' . $subrincian->kode_kategori_ssh;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="subrincian' . $subrincian->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }
}
