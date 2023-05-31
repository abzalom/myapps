<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\C6SubrincianLra;
use Illuminate\Http\Request;

class ApiRekeningController extends Controller
{
    public function getkoderekeningbyid(Request $request)
    {
        if ($request->q) {
            return C6SubrincianLra::where([
                ['uraian', 'like', '%' . $request->q . '%'],
                ['kode_unik_akun', '=', '5'],
            ])
                ->orWhere('kode_unik_subrincian', 'like', '%' . $request->q . '%')
                ->where('kode_unik_akun', '5')
                ->get();
        }
    }
}
