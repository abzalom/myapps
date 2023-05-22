<?php

namespace App\Http\Controllers;

use App\Imports\StandarHargaImport;
use App\Models\B6SubrincianNeraca;
use App\Models\C6SubrincianLra;
use App\Models\D6SubrincianLo;
use App\Models\EZonasi;
use App\Models\StandarHarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\PrettyPrinter\Standard;

class StandarHargaController extends Controller
{
    public function standarhargahome()
    {
        // return StandarHarga::truncate();
        $sshs = C6SubrincianLra::select(
            [
                'id',
                'kode_unik_akun',
                'kode_unik_kelompok',
                'kode_unik_jenis',
                'kode_unik_objek',
                'kode_unik_rincian',
                'kode_unik_subrincian',
                'uraian',
            ]
        )
            ->with(
                [
                    'standarharga' => fn ($q) => $q->where('tahun', $this->tahun->tahun),
                ]
            )
            ->has('standarharga')
            ->where('kode_unik_akun', '5')
            ->get();
        // return $ssh;
        return view('standarharga.all.standar-harga', [
            'title' => 'Standar Harga | SSH',
            'desc' => 'Standar Satuan Harga (SSH)',
            'sshs' => $sshs,
            'tahun' => $this->tahun->tahun,
        ]);
    }

    public function storestandarharga(Request $request)
    {
        StandarHarga::truncate();
        $files = $request->file('file');
        Excel::import(new StandarHargaImport($this->tahun->tahun), $files);
        return back()->with('pesan', '<div class="alert alert-info">Standar harga berhasil di upload</div>');
    }

    public function standarhargacetak()
    {
        $neraca = B6SubrincianNeraca::with(
            [
                'standarharga' => fn ($q) => $q
                    ->select([
                        'rekening_subrincian',
                        'kategori_subrincian',
                        'uraian',
                        'spesifikasi',
                        'satuan',
                        'harga_zona_1',
                        'harga_zona_2',
                        'harga_zona_3',
                        'nama_kelompok',
                    ])
                    ->where('tahun', $this->tahun->tahun),
            ]
        )->has('standarharga')
            ->select([
                'id',
                'kode_unik_akun',
                'kode_unik_kelompok',
                'kode_unik_jenis',
                'kode_unik_objek',
                'kode_unik_rincian',
                'kode_unik_subrincian',
                'uraian',
            ])
            ->get();
        $lo = D6SubrincianLo::with(
            [
                'standarharga' => fn ($q) => $q
                    ->select([
                        'rekening_subrincian',
                        'kategori_subrincian',
                        'uraian',
                        'spesifikasi',
                        'satuan',
                        'harga_zona_1',
                        'harga_zona_2',
                        'harga_zona_3',
                        'nama_kelompok',
                    ])
                    ->where('tahun', $this->tahun->tahun),
            ]
        )
            ->has('standarharga')
            ->select([
                'id',
                'kode_unik_akun',
                'kode_unik_kelompok',
                'kode_unik_jenis',
                'kode_unik_objek',
                'kode_unik_rincian',
                'kode_unik_subrincian',
                'uraian',
            ])
            ->get();

        $kategori = $neraca->merge($lo)->sort();

        // return $kategori;

        return view('standarharga.standar-harga-cetak', [
            'title' => 'lampiran perbup standar harga ' . $this->tahun->tahun,
            'desc' => 'STANDAR HARGA SATUAN YANG BERFUNGSI SEBAGAI BATAS TERTINGGI DALAM PERENCANAAN DAN PELAKSANAAN ANGGARAN PENDAPATAN DAN BELANJA DAERAH KABUPATEN MAMBERAMO RAYA TAHUN ' . $this->tahun->tahun,
            'kategoris' => $kategori,
            'no' => 1,
        ]);
    }
}
