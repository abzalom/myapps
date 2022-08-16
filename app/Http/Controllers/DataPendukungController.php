<?php

namespace App\Http\Controllers;

use App\Models\EKlasifikasi;
use App\Models\ELokasi;
use App\Models\EPenerimaManfaat;
use Illuminate\Http\Request;

class DataPendukungController extends Controller
{
    public function index()
    {
        return view('datapendukung.pendukung', [
            'title' => 'Data Pendukung',
            'desc' => 'Data Pendukung lainnya',
            'lokasis' => ELokasi::all(),
            'sasarans' => EPenerimaManfaat::all(),
            'klasifikasis' => EKlasifikasi::all(),
        ]);
    }

    // lokasi
    public function storelokasi(Request $reuest)
    {
        $lokasi = ELokasi::create($reuest->except('_token'));
        return redirect()->back()->with('pesan', 'Lokasi baru dengan nama ' . $lokasi->lokasi . ' telah ditambahkan');
    }

    public function deletelokasi($id)
    {
        $lokasi = ELokasi::find($id);
        $nama = $lokasi->lokasi;
        $lokasi->delete();
        return redirect()->back()->with('pesan', 'Lokasi dengan nama ' . $nama . ' telah dihapus');
    }

    // Penerima Manfaat
    public function storepenerimamanfaat(Request $reuest)
    {
        $data = EPenerimaManfaat::create($reuest->except('_token'));
        return redirect()->back()->with('pesan', $data->uraian . ' telah ditambahkan sebagai data penerima manfaat');
    }

    public function deletepenerimamanfaat($id)
    {
        $data = EPenerimaManfaat::find($id);
        $nama = $data->uraian;
        $data->delete();
        return redirect()->back()->with('pesan', $data->uraian . ' telah dihapus dari data penerima manfaat');
    }

    // Klasifikasi
    public function storeklasifikasi(Request $reuest)
    {
        $data = EKlasifikasi::create($reuest->except('_token'));
        return redirect()->back()->with('pesan', $data->uraian . ' telah ditambahkan sebagai klasifikasi anggaran');
    }

    public function deleteklasifikasi($id)
    {
        $data = EKlasifikasi::find($id);
        $nama = $data->uraian;
        $data->delete();
        return redirect()->back()->with('pesan', $data->uraian . ' telah dihapus dari klasifikasi anggaran');
    }
}
