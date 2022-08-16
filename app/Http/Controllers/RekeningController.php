<?php

namespace App\Http\Controllers;

use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function apilrajenis($idkel)
    {
        $jenis = C3JenisLra::where('c2_kelompok_lra_id', $idkel)->get();
        foreach ($jenis as $value) {
            echo '<option value="' . $value->id . '">' . $value->kode_unik_jenis . ' - ' . $value->uraian . '</option>';
        }
    }

    public function apilraobjek($idjenis)
    {
        $objek = C4ObjekLra::where('c3_jenis_lra_id', $idjenis)->get();
        foreach ($objek as $value) {
            echo '<option value="' . $value->id . '">' . $value->kode_unik_objek . ' - ' . $value->uraian . '</option>';
        }
    }

    public function apilrarincian($idobjek)
    {
        $rincian = C5RincianLra::where('c4_objek_lra_id', $idobjek)->get();
        foreach ($rincian as $value) {
            echo '<option value="' . $value->id . '">' . $value->kode_unik_rincian . ' - ' . $value->uraian . '</option>';
        }
    }

    public function apilrasubrincian($idrincian)
    {
        $subrincian = C6SubrincianLra::where('c5_rincian_lra_id', $idrincian)->get();
        foreach ($subrincian as $value) {
            echo '<option value="' . $value->id . '">' . $value->kode_unik_subrincian . ' - ' . $value->uraian . '</option>';
        }
    }
}
