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
                ->where('kode_unik_akun', '1')
                ->whereNotIn('kode_unik_jenis', [
                    '1.1.01', '1.1.02', '1.1.03', '1.1.04', '1.1.05',
                    '1.1.06', '1.1.07', '1.1.08', '1.1.09', '1.1.10', '1.1.11'
                ])
                ->orWhere('kode_unik_subrincian', 'like', '%' . $request->q . '%')
                ->get();
            $lo = D6SubrincianLo::where('uraian', 'like', '%' . $request->q . '%')
                ->where('kode_unik_akun', '8')
                ->orWhere('kode_unik_subrincian', 'like', '%' . $request->q . '%')
                ->get();
            $data = $neraca->merge($lo);
            return $data->toJson();
        }
    }
}
