<?php

namespace App\Http\Controllers;

use App\Models\ETahapan;
use App\Models\ETahunAnggaran;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $tahapan;
    protected $tahun;

    public function __construct()
    {
        $this->tahapan = ETahapan::where('is_active', true)->first();
        $this->tahun = ETahunAnggaran::where('is_active', true)->first();
    }
}
