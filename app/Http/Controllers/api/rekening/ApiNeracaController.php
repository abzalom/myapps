<?php

namespace App\Http\Controllers\api\rekening;

use App\Http\Controllers\Controller;
use App\Http\Resources\rekening\RekeningLraResource;
use App\Http\Resources\RekeningResource;
use App\Models\B1AkunNeraca;
use App\Models\B2KelompokNeraca;
use App\Models\B3JenisNeraca;
use App\Models\B4ObjekNeraca;
use App\Models\B5RincianNeraca;
use App\Models\B6SubrincianNeraca;
use Illuminate\Http\Request;

class ApiNeracaController extends Controller
{

    public function akunneracasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B1AkunNeraca::search($request->q));
        } else {
            return null;
        }
    }

    public function kelompokneracasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B2KelompokNeraca::search($request->q));
        } else {
            return null;
        }
    }

    public function jenisneracasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B3JenisNeraca::search($request->q));
        } else {
            return null;
        }
    }

    public function objekneracasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B4ObjekNeraca::search($request->q));
        } else {
            return null;
        }
    }

    public function rincianneracasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B5RincianNeraca::search($request->q));
        } else {
            return null;
        }
    }

    public function subrincianneracasearch(Request $request)
    {
        // return B6SubrincianNeraca::search($request->q);
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', B6SubrincianNeraca::search($request->q)->get());
        } else {
            $json = [
                'data' => [
                    [
                        'id' => '',
                        'kode_unik_subrincian' => '',
                        'uraian' => '',
                    ]
                ]
            ];
            return collect($json);
        }
    }

    public function kategorineracasearch(Request $request, $kategori)
    {
        if (isset($request->q)) {
            return B6SubrincianNeraca::search($request->q)->where('kode_kategori_ssh', $kategori)->orderBy('id')->get();
        } else {
            $json =  [
                [
                    'id' => '',
                    'kode_unik_subrincian' => '',
                    'uraian' => '',
                ]
            ];
            return collect($json);
        }
    }

    public function subrincianbykode($kode)
    {
        $kode = str_replace('-', '.', $kode);
        return B6SubrincianNeraca::where('kode_unik_subrincian', $kode)->first();
    }
}
