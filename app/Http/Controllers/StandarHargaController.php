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
            // ->limit(1)
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

    public function updatetandarharga(Request $request)
    {
        $request->validate(
            [
                'kategori' => 'required',
                'rekening' => 'required',
                'uraian' => 'required',
                'spesifikasi' => 'required',
                'satuan' => 'required',
            ],
            [
                'kategori.required' => 'error: update gagal! kategori tidak boleh kosong!',
                'rekening.required' => 'error: update gagal! rekening tidak boleh kosong!',
                'uraian.required' => 'error: update gagal! uraian tidak boleh kosong!',
                'spesifikasi.required' => 'error: update gagal! spesifikasi tidak boleh kosong!',
                'satuan.required' => 'error: update gagal! satuan tidak boleh kosong!',
            ]
        );
        $komponen = StandarHarga::find($request->id);
        $neraca = B6SubrincianNeraca::where('kode_unik_subrincian', $request->kategori)->first();
        $lo = D6SubrincianLo::where('kode_unik_subrincian', $request->kategori)->first();

        $kategori = $neraca ? $neraca : $lo;
        $rekening = C6SubrincianLra::where('kode_unik_subrincian', $request->rekening)->first();

        $komponen->rekening_akun = $rekening->kode_unik_akun;
        $komponen->rekening_kelompok = $rekening->kode_unik_kelompok;
        $komponen->rekening_jenis = $rekening->kode_unik_jenis;
        $komponen->rekening_objek = $rekening->kode_unik_objek;
        $komponen->rekening_rincian = $rekening->kode_unik_rincian;
        $komponen->rekening_subrincian = $rekening->kode_unik_subrincian;
        $komponen->kategori_kelompok = $kategori->kode_unik_kelompok;
        $komponen->kategori_jenis = $kategori->kode_unik_jenis;
        $komponen->kategori_objek = $kategori->kode_unik_objek;
        $komponen->kategori_rincian = $kategori->kode_unik_rincian;
        $komponen->kategori_subrincian = $kategori->kode_unik_subrincian;

        $komponen->uraian = $request->uraian;
        $komponen->spesifikasi = $request->spesifikasi;
        $komponen->satuan = $request->satuan;
        $komponen->harga_zona_1 = $request->harga_zona_1;
        $komponen->harga_zona_2 = $request->harga_zona_2;
        $komponen->harga_zona_3 = $request->harga_zona_3;
        $komponen->tahun = $this->tahun->tahun;

        $komponen->kode_kelompok = $kategori->kode_kategori_ssh;
        $komponen->nama_kelompok = $kategori->kategori_ssh;

        $komponen->save();

        return back()->with('pesan', '<div class="alert alert-info">Komponen belanja ' . $komponen->rekening_subrincian . ' - ' . $komponen->uraian . ' berhasil diupdate</div>');
    }
}
