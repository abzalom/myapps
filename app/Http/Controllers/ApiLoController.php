<?php

namespace App\Http\Controllers;

use App\Http\Resources\RekeningResource;
use App\Models\D1AkunLo;
use App\Models\D2KelompokLo;
use App\Models\D3JenisLo;
use App\Models\D4ObjekLo;
use App\Models\D5RincianLo;
use App\Models\D6SubrincianLo;
use Illuminate\Http\Request;

class ApiLoController extends Controller
{
    public function akunlosearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D1AkunLo::search($request->q));
        } else {
            return null;
        }
    }

    public function kelompoklosearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D2KelompokLo::search($request->q));
        } else {
            return null;
        }
    }

    public function jenislosearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D3JenisLo::search($request->q));
        } else {
            return null;
        }
    }

    public function objeklosearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D4ObjekLo::search($request->q));
        } else {
            return null;
        }
    }

    public function rincianlosearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D5RincianLo::search($request->q));
        } else {
            return null;
        }
    }

    public function subrincianlosearch(Request $request)
    {
        // return B6SubrincianNeraca::search($request->q);
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D6SubrincianLo::search($request->q)->get());
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

    public function kategorilosearch(Request $request, $ketegori)
    {
        // return B6SubrincianNeraca::search($request->q);
        if (isset($request->q)) {
            return new RekeningResource(true, 'Data Akun Neraca', D6SubrincianLo::search($request->q)->where('kode_kategori_ssh', $ketegori)->orderBy('id')->get());
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

    public function subrincianbykode($kode)
    {
        $kode = str_replace('-', '.', $kode);
        return D6SubrincianLo::where('kode_unik_subrincian', $kode)->first();
    }
}
