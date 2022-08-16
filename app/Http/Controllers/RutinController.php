<?php

namespace App\Http\Controllers;

use App\Imports\KegiatanRutinImport;
use App\Imports\SubkegiatanRutinImport;
use App\Models\A6ProgramRutin;
use App\Models\A7KegiatanRutin;
use App\Models\A8SubkegiatanRutin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RutinController extends Controller
{
    public function rutin()
    {
        $rutins = A6ProgramRutin::with([
            'kegiatanrutin',
            'kegiatanrutin.subkegiatanrutin',
        ])->get();
        // dump($rutins->toArray());
        return view('rutin.rutin', [
            'title' => 'Program Rutin',
            'desc' => 'Penunjang Urusan Pemerintahan',
            'rutins' => $rutins,
        ]);
    }

    public function kegiatan()
    {
        $rutins = A6ProgramRutin::with([
            'kegiatanrutin',
        ])->find(1);
        // dump($rutins->toArray());
        return view('rutin.kegiatan', [
            'title' => 'Kegiatan Rutin',
            'desc' => 'X.XX.' . $rutins->kode_unik_program . ' - ' . $rutins->uraian,
            'rutins' => $rutins,
        ]);
    }

    public function kegiatanimport(Request $request)
    {
        $file = $request->file('file');
        A7KegiatanRutin::truncate();
        Excel::import(new KegiatanRutinImport, $file);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Kegiatan Rutin Berhasil Di Upload</div>');
    }

    public function subkegiatan()
    {
        $rutins = A6ProgramRutin::with([
            'kegiatanrutin',
            'kegiatanrutin.subkegiatanrutin',
        ])->find(1);
        // dump($rutins->toArray());
        return view('rutin.subkegiatan', [
            'title' => 'Sub Kegiatan Rutin',
            'desc' => 'X.XX.' . $rutins->kode_unik_program . ' - ' . $rutins->uraian,
            'rutins' => $rutins,
        ]);
    }

    public function subkegiatanimport(Request $request)
    {
        $file = $request->file('file');
        A8SubkegiatanRutin::truncate();
        Excel::import(new SubkegiatanRutinImport, $file);
        return redirect()->back()->with('pesan', '<div class="alert alert-success">Sub Kegiatan Rutin Berhasil Di Upload</div>');
    }
}
