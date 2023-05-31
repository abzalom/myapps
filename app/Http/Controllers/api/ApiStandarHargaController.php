<?php

namespace App\Http\Controllers\Api;

use App\Models\StandarHarga;
use Illuminate\Http\Request;
use App\Models\D6SubrincianLo;
use App\Models\C6SubrincianLra;
use App\Models\B6SubrincianNeraca;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ApiStandarHargaController extends Controller
{

    public function getallstandarharga(Request $request)
    {
        if ($request->ajax) {
            $sshs = StandarHarga::select([
                'id',
                'rekening_subrincian',
                'rekening_uraian',
                'kategori_subrincian',
                'kategori_uraian',
                DB::raw("CONCAT(standar_hargas.rekening_subrincian,' - ',standar_hargas.rekening_uraian) as rekening"),
                'uraian',
                'spesifikasi',
                'harga_zona_1',
                'harga_zona_2',
                'harga_zona_3',
                'satuan',
                'kode_kelompok',
                'nama_kelompok',
            ]);
            // return $sshs;
            return DataTables::eloquent($sshs)
                ->addColumn('action', function ($data) {
                    // return $data->id;
                    return '
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button value="' . $data->id . '" type="button" class="btn btn-sm btn-secondary edit-komponen-ssh" data-bs-toggle="modal" data-bs-target="#editSshModal"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </div>
                ';
                })
                ->filterColumn('rekening', function ($query, $keyword) {
                    $sql = "CONCAT(standar_hargas.rekening_subrincian,' - ',standar_hargas.rekening_uraian) like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->toJson();
        } else {
            return abort(403);
        }
    }

    public function findstandarharga(Request $request)
    {
        return StandarHarga::find($request->id);
    }
}
