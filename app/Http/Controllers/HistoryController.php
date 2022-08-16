<?php

namespace App\Http\Controllers;

use App\Models\H1PaguOpdHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function historypagu()
    {
        return view('history.historypagu', [
            'title' => 'History | Pagu',
            'desc' => 'Catatan Pembagian Pagu OPD Tahun Anggaran ' . $this->tahun->tahun,
            'histories' => H1PaguOpdHistory::where('tahun', $this->tahun->tahun)->with('opd', 'status')->get(),
        ]);
    }
}
