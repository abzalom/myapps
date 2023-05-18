<?php

namespace App\Http\Controllers;

use App\Models\ETahapan;
use App\Models\ETahunAnggaran;
use App\Models\F1Perangkat;
use App\Models\F2Tagging;
use App\Models\G1Pendapatan;
use App\Models\G1PendapatanUraian;
use Database\Seeders\Data\Pendukung\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function rkpd()
    {
        return view('pengaturan.pengaturanrkpd', [
            'title' => 'Pengaturan',
            'desc' => 'Pengaturan RKPD',
            'tahapans' => ETahapan::all(),
            'tahuns' => ETahunAnggaran::all(),
        ]);
    }

    public function tahapan(Request $request, ETahapan $tahapan)
    {
        $tahapan->where('is_active', true)->update(['is_active' => false]);
        $status = $tahapan->find($request->get('id'));
        $status->is_active = true;
        $status->save();
        return redirect()->back();
    }

    public function tahapanlock(Request $request, ETahapan $tahapan)
    {
        $tahapan->where('is_active', true)->update(['is_active' => false]);
        return redirect()->back();
    }

    public function tahun(ETahunAnggaran $tahun, $id)
    {
        $tahun->where('is_active', true)->update(['is_active' => false]);
        $active = $tahun->find($id);
        $active->is_active = true;
        $active->save();
        return redirect()->back();
    }

    public function storetable()
    {
        $path = app_path() . "/Models";
        $tables = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $out = explode('.', $result);
            array_push($tables, $out[0]);
        }
        foreach ($tables as  $table) {
            $class = "App\\Models\\" . $table;
            $class = new $class;
            $json = $class::all()->toJson();
            Storage::disk('public')->put('/save/json/' . $table . '.json', $json);
        }
        return redirect('/')->with('pesan', 'Semua Table berhasil di simpan');
    }

    public function olahdata()
    {
        /**
         * Delete data
         */
        // $data = F1Perangkat::where('tahun', null)->delete();

        /**
         * Update & Insert column
         */
        $data = G1PendapatanUraian::all();
        $each = $data->each(function ($query) {
            // $query->tahun = '2022';
            // $query->save();
            // dump($query->toArray());
            $data = [
                'c1_akun_lra_id' => $query->c1_akun_lra_id,
                'c2_kelompok_lra_id' => $query->c2_kelompok_lra_id,
                'c3_jenis_lra_id' => $query->c3_jenis_lra_id,
                'c4_objek_lra_id' => $query->c4_objek_lra_id,
                'c5_rincian_lra_id' => $query->c5_rincian_lra_id,
                'c6_subrincian_lra_id' => $query->c6_subrincian_lra_id,
                'g1_pendapatan_id' => $query->g1_pendapatan_id,
                'kode' => $query->kode,
                'kode_unik' => $query->kode_unik,
            ];
            // G1Pendapatan::create($data);
            // dump($data);
        });
        return redirect('/');
    }
}
