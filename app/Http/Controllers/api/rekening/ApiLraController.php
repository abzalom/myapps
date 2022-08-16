<?php

namespace App\Http\Controllers\api\rekening;

use App\Models\C1AkunLra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RekeningResource;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
use App\Models\D6SubrincianLo;

class ApiLraController extends Controller
{

    public function apiakunlra()
    {
        return new RekeningResource(true, 'Akun Rekening LRA', C1AkunLra::all());
    }

    public function apikelompoklra()
    {
        return new RekeningResource(true, 'Kelompok Rekening LRA', C2KelompokLra::all());
    }

    public function apijenislra()
    {
        return new RekeningResource(true, 'Jenis Rekening LRA', C3JenisLra::all());
    }

    public function apiobjeklra()
    {
        return new RekeningResource(true, 'Objek Rekening LRA', C4ObjekLra::all());
    }

    public function apirincianlra()
    {
        return new RekeningResource(true, 'Rincian Rekening LRA', C5RincianLra::all());
    }

    public function apisubrincianlra()
    {
        return new RekeningResource(true, 'Sub Rincian Rekening LRA', C6SubrincianLra::all());
    }

    /**
     * Neraca For Search
     */
    public function apiakunlrasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Akun Rekening LRA', C1AkunLra::all());
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

    public function apikelompoklrasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Kelompok Rekening LRA', C2KelompokLra::all());
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

    public function apijenislrasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Jenis Rekening LRA', C3JenisLra::all());
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

    public function apiobjeklrasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Objek Rekening LRA', C4ObjekLra::all());
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

    public function apirincianlrasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Rincian Rekening LRA', C5RincianLra::all());
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

    public function apisubrincianlrasearch(Request $request, $kategori)
    {
        if ($kategori == 1) {
            if (isset($request->q)) {
                return new RekeningResource(true, 'Sub Rincian Rekening LRA', C6SubrincianLra::search($request->q)->whereIn('kode_unik_jenis', ['5.1.02'])->get());
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
        } elseif ($kategori == 2) {
            if (isset($request->q)) {
                return new RekeningResource(true, 'Sub Rincian Rekening LRA', C6SubrincianLra::search($request->q)->whereIn('kode_unik_objek', ['5.1.02.03'])->get());
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
        } elseif ($kategori == 3) {
            if (isset($request->q)) {
                return new RekeningResource(true, 'Sub Rincian Rekening LRA', C6SubrincianLra::search($request->q)->whereIn('kode_unik_kelompok', ['5.2'])->get());
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
        } elseif ($kategori == 4) {
            if (isset($request->q)) {

                $whereNot = [
                    '5.1.02.01', '5.1.02.03', '5.1.02.06',
                ];
                return [
                    'data' => C6SubrincianLra::where('uraian', 'like', '%' . $request->q . '%')
                        ->whereIn('kode_unik_kelompok', ['5.1', '5.3', '5.4'])
                        ->whereNotIn('kode_unik_objek', $whereNot)
                        ->get()
                ];
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
    }

    public function apisubrincianlrarkasearch(Request $request)
    {
        if (isset($request->q)) {
            return new RekeningResource(true, 'Sub Rincian Rekening LRA', C6SubrincianLra::search($request->q)->get());
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
        return C6SubrincianLra::where('kode_unik_subrincian', $kode)->first();
    }
}
