<?php

namespace App\Http\Controllers;

use App\Models\F1Perangkat;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class RenjaController extends Controller
{

    public function renjaranwal()
    {
        if ($this->tahun == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        return view('renja.renja', [
            'title' => 'Renja OPD',
            'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . $this->tahun->tahun,
            'opds' => F1Perangkat::all(),
        ]);
    }

    public function rancangan()
    {
        echo 'Rancangan';
    }

    public function rankir()
    {
        echo 'Rancangan Akhir';
    }
}
