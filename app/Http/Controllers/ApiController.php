<?php

namespace App\Http\Controllers;

use App\Models\A2Bidang;
use App\Models\A3Program;
use App\Models\A4Kegiatan;
use App\Models\A5Subkegiatan;
use App\Models\A7KegiatanRutin;
use App\Models\A8SubkegiatanRutin;
use App\Models\EJenisKomponen;
use App\Models\EKalender;
use App\Models\EKlasifikasi;
use App\Models\ELokasi;
use App\Models\EPenerimaManfaat;
use App\Models\EPrioritasDaerah;
use App\Models\EPrioritasNasional;
use App\Models\EPrioritasProvinsi;
use App\Models\EZonasi;
use App\Models\F1Perangkat;
use App\Models\F2Tagging;
use App\Models\G1PendapatanUraian;
use App\Models\H1PaguOpd;
use App\Models\H1PaguOpdRanwal;
use App\Models\I2RenjaOpdRanwal;
use App\Models\I5RutinOpdRanwal;
use App\Models\J1IndikatorProgramRanwal;
use App\Models\J2IndikatorKegiatanRanwal;
use App\Models\J3IndikatorSubkegiatanRanwal;
use App\Models\J4IndikatorProgramRutinRanwal;
use App\Models\J5IndikatorKegiatanRutinRanwal;
use App\Models\J6SubrincianRutinRanwal;
use App\Models\K3SshKomponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    public function pagupindahopd($idopd)
    {
        // return g1
    }

    public function pendapatankomponen($idkomponen)
    {
        return G1PendapatanUraian::with('subrincian')->find($idkomponen);
    }

    public function paguexceptidbyopd($idopd, $idbidang)
    {
        $h1pagu = H1PaguOpd::where(['f1_perangkat_id' => $idopd, 'a2_bidang_id' => $idbidang, 'tahun' => $this->tahun->tahun])->get();
        if (count($h1pagu) !== 0) {
            $ids = [];
            foreach ($h1pagu as $key => $value) {
                $ids[$key] = $value->g1_pendapatan_uraian_id;
            }
            $g1pendapatan = G1PendapatanUraian::whereNotIn('id', $ids)->where('tahun', $this->tahun->tahun)->get();
        } else {
            $g1pendapatan = G1PendapatanUraian::where('tahun', $this->tahun->tahun)->get();
        }
        return $g1pendapatan;
    }

    public function lokusdak()
    {
        $json = json_decode(file_get_contents(storage_path('app/public/json/lokus_dak_2023.json')));
        $data = [];
        foreach ($json as $value) {
            $data[$value->t1_id][] = [
                't1_kode' => $value->t1_kode,
                't1_nama' => $value->t1_nama,
                $value->t2_id => [],
            ];
        }
        dump($data);
        return view('sementara.dak', [
            'title' => 'DAK',
            'desc' => 'Data DAK Sementara',
            'data' => $data,
        ]);
    }


    public function getrenjabidang($idopd)
    {
        $tags = F2Tagging::where('f1_perangkat_id', $idopd)->get();
        $ids = [];
        foreach ($tags as $key => $value) {
            $ids[$key] = $value->a2_bidang_id;
        }
        $bidang = A2Bidang::whereIn('id', $ids)->get();
        return $bidang;
    }

    public function getrenjaprogrambybidang($idbid)
    {
        return A3Program::where('a2_bidang_id', $idbid)->get();
    }

    public function getrenjakegiatanbyprogram($idprog)
    {
        return A4Kegiatan::where('a3_program_id', $idprog)->get();
    }

    public function getrenjasubkegiatanbykegiatan($idkeg, $idopd)
    {
        $ranwal = I2RenjaOpdRanwal::where(['f1_perangkat_id' => $idopd, 'a4_kegiatan_id' => $idkeg])->get();
        $ids = [];
        if (count($ranwal) == 0) {
            $ids['idsub'] = [0];
        } else {
            foreach ($ranwal as $key => $value) {
                $ids['idsub'][] = $value->a5_subkegiatan_id;
            }
        }
        return A5Subkegiatan::where('a4_kegiatan_id', $idkeg)->whereNotIn('id', $ids['idsub'])->get();
    }

    public function getprioritas()
    {
        $prionas = EPrioritasNasional::all();
        $prioprov = EPrioritasProvinsi::all();
        $prioda = EPrioritasDaerah::all();

        $data = [
            'nasional' => $prionas,
            'provinsi' => $prioprov,
            'daerah' => $prioda,
        ];

        return $data;
    }

    public function getprioritasprog($idprog, $idopd)
    {
        $indikatorprog = J1IndikatorProgramRanwal::where(['a3_program_id' => $idprog, 'f1_perangkat_id' => $idopd])->first();
        $data['status'] = 'Error';
        $data['data'] = null;
        if ($indikatorprog !== null) {
            $data['status'] = 'success';
            $data['data'] = $indikatorprog;
        }
        return $data;
    }

    public function getprioritaskeg($idkeg, $idopd)
    {
        $indikatorkeg = J2IndikatorKegiatanRanwal::where(['a4_kegiatan_id' => $idkeg, 'f1_perangkat_id' => $idopd])->first();
        $data['status'] = 'Error';
        $data['data'] = null;
        if ($indikatorkeg !== null) {
            $data['status'] = 'success';
            $data['data'] = $indikatorkeg;
        }
        return $data;
    }

    public function getsumberdanabyopd($idopd, $idbid)
    {
        return H1PaguOpdRanwal::with([
            'uraianpendapatanranwal',
            'uraianpendapatanranwal.subrincianlra',
            'uraianpendapatanranwal.subrincianlra.rincianlra',
        ])->where(['f1_perangkat_id' => $idopd, 'a2_bidang_id' => $idbid])->get();
    }

    public function getklasifikasi()
    {
        return EKlasifikasi::all();
    }

    public function getpenerimamanfaat()
    {
        return EPenerimaManfaat::all();
    }

    public function getkalender()
    {
        return EKalender::all();
    }

    public function getlokasi()
    {
        return ELokasi::all();
    }

    public function getindikatorsubkeg($id)
    {
        $indikatorsub = J3IndikatorSubkegiatanRanwal::with([
            'subkegiatan',
            'sumberdanaranwal',
            'lokasiranwal',
        ])->find($id);
        $data['status'] = 'Error';
        $data['data'] = null;
        if ($indikatorsub !== null) {
            $data['status'] = 'success';
            $data['data'] = $indikatorsub;
        }
        return $data;
    }

    public function getkegiatanrutin()
    {
        $data = A7KegiatanRutin::all();
        return $data;
    }

    public function getsubkegiatanrutin($idkeg, $idopd)
    {
        $rutinranwal = I5RutinOpdRanwal::where('f1_perangkat_id', $idopd)->get();
        $ids = [];
        if (count($rutinranwal) == 0) {
            $ids = [0];
        } else {
            foreach ($rutinranwal as $key => $value) {
                $ids[] = $value->a8_subkegiatan_rutin_id;
            }
        }
        $data = A8SubkegiatanRutin::where('a7_kegiatan_rutin_id', $idkeg)->whereNotIn('id', $ids)->get();
        return $data;
    }

    public function getsubkegrutinbyid($id)
    {
        return A8SubkegiatanRutin::find($id);
    }

    public function getsubrincianrutinbyid($id)
    {
        return J6SubrincianRutinRanwal::with([
            'subkegiatan',
            'lokasi',
            'sumberdana',
            'jenis',
        ])->find($id);
    }

    public function getzonasi()
    {
        return EZonasi::all();
    }

    public function getjeniskomponen()
    {
        return EJenisKomponen::all();
    }

    public function komponenssh($idkomponen)
    {
        return K3SshKomponen::find($idkomponen);
    }

    public function getindikatorprogrutin($idindikatorprog)
    {
        return J4IndikatorProgramRutinRanwal::find($idindikatorprog);
    }

    public function getindikatorkegrutin($idindikator)
    {
        return J5IndikatorKegiatanRutinRanwal::find($idindikator);
    }
}
