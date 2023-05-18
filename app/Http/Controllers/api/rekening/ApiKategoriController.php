<?php

namespace App\Http\Controllers\Api\Rekening;

use App\Http\Controllers\Controller;
use App\Models\B6SubrincianNeraca;
use App\Models\D6SubrincianLo;
use Illuminate\Http\Request;

class ApiKategoriController extends Controller
{
    public function getkodekategoribyid(Request $request)
    {
        if ($request->q) {
            $neraca = B6SubrincianNeraca::where('uraian', 'like', '%' . $request->q . '%')
                ->orWhere('kode_unik_subrincian', 'like', '%' . $request->q . '%')
                ->get();
            $lo = D6SubrincianLo::where('uraian', 'like', '%' . $request->q . '%')
                ->orWhere('kode_unik_subrincian', 'like', '%' . $request->q . '%')
                ->get();
            $data = $neraca->merge($lo);
            return $data->toJson();
        }
    }
}
