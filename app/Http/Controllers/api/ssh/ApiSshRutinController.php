<?php

namespace App\Http\Controllers\api\ssh;

use App\Http\Controllers\Controller;
use App\Http\Resources\SshResource;
use App\Models\K1SshTag;
use App\Models\K3SshKomponen;
use Illuminate\Http\Request;

class ApiSshRutinController extends Controller
{
    public function komponenrutin($kode)
    {
        $kode = str_replace('-', '.', $kode);
        return new SshResource(true, 'success', K3SshKomponen::where(['rekening_subrincian' => $kode, 'tahun' => $this->tahun->tahun])->get());
    }
}
