<?php

use App\Http\Controllers\Api\ApiRekeningController;
use App\Http\Controllers\Api\ApiStandarHargaController;
use App\Http\Controllers\Api\Rekening\ApiKategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLoController;
use App\Http\Controllers\api\rekening\ApiLraController;
use App\Http\Controllers\api\ssh\ApiSshRutinController;
use App\Http\Controllers\api\rekening\ApiNeracaController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// API Rekening Neraca
Route::controller(ApiNeracaController::class)->group(function () {
    Route::get('/api/neraca/subrincian/search', 'subrincianneracasearch')->name('apineraca.subrincianneracasearch');
    Route::get('/api/neraca/kategori/{ketegori}/search', 'kategorineracasearch')->name('apineraca.kategorineracasearch');
    Route::get('/api/neraca/subrincian/bykode/{kode}', 'subrincianbykode')->name('apineraca.subrincianbykode');
});


// API Rekening LRA
Route::controller(ApiLraController::class)->group(function () {
    Route::get('/api/lra/{kategori}/subrincian/search', 'apisubrincianlrasearch')->name('apilra.apisubrincianlrasearch');
    Route::get('/api/lra/subrincian/rka/search', 'apisubrincianlrarkasearch')->name('apilra.apisubrincianlrarkasearch');
    Route::get('/api/lra/subrincian/bykode/{kode}', 'subrincianbykode')->name('apineraca.subrincianbykode');
});

// API Rekening Neraca
Route::controller(ApiLoController::class)->group(function () {
    Route::get('/api/lo/subrincian/search', 'subrincianlosearch')->name('apilo.subrincianlosearch');
    Route::get('/api/lo/kategori/{ketegori}/search', 'kategorilosearch')->name('apilo.kategorilosearch');
    Route::get('/api/lo/subrincian/bykode/{kode}', 'subrincianbykode')->name('apineraca.subrincianbykode');
});

// API SSH
Route::controller(ApiSshRutinController::class)->group(function () {
    Route::get('/api/ssh/komponen/rutin/{rekening}', 'komponenrutin')->name('sshrutin.komponenrutin');
});


// Api
Route::controller(ApiController::class)->group(function () {
    Route::get('/pagu/pindahan/opd/{idopd}', 'pagupindahopd')->name('api.pagupindahopd');
    Route::get('/api/pendapatan/komponen/{idkomponen}', 'pendapatankomponen')->name('api.pendapatankomponen');
    Route::get('/api/pagu/add/opd/{idopd}/bidang/{idbidang}', 'paguexceptidbyopd')->name('api.paguexceptidbyopd');

    // Renja
    Route::get('/api/renja/add/bidang/{idopd}', 'getrenjabidang')->name('api.getrenjabidang');
    Route::get('/api/renja/add/program/{idbid}', 'getrenjaprogrambybidang')->name('api.getrenjaprogrambybidang');
    Route::get('/api/renja/add/kegiatan/{idprog}', 'getrenjakegiatanbyprogram')->name('api.getrenjakegiatanbyprogram');
    Route::get('/api/renja/add/subkegiatan/{idkeg}/opd/{idopd}', 'getrenjasubkegiatanbykegiatan')->name('api.getrenjasubkegiatanbykegiatan');
    Route::get('/api/renja/add/prioritas', 'getprioritas')->name('api.getprioritas');
    Route::get('/api/renja/get/prioritas/prog/{idprog}/opd/{idopd}', 'getprioritasprog')->name('api.getprioritasprog');
    Route::get('/api/renja/get/prioritas/keg/{idkeg}/opd/{idopd}', 'getprioritaskeg')->name('api.getprioritaskeg');
    Route::get('/api/renja/sumberdana/opd/{idopd}/bidang/{idbid}', 'getsumberdanabyopd')->name('api.getsumberdanabyopd');

    // Data Pendukung
    Route::get('/api/data/get/klasifikasi', 'getklasifikasi')->name('api.getklasifikasi');
    Route::get('/api/data/get/penerimamanfaat', 'getpenerimamanfaat')->name('api.getpenerimamanfaat');
    Route::get('/api/data/get/kalender', 'getkalender')->name('api.getkalender');
    Route::get('/api/data/get/lokasi', 'getlokasi')->name('api.getlokasi');
    Route::get('/api/data/get/zonasi', 'getzonasi')->name('api.getzonasi');
    Route::get('/api/data/get/jeniskomponen', 'getjeniskomponen')->name('api.getjeniskomponen');

    // Indikator Non Rutin
    Route::get('/api/indikator/program/{idprog}/opd/{idopd}', 'getindikatorprog')->name('api.getindikatorprog');
    Route::get('/api/renja/indikatorsubkeg/{idindisub}', 'getindikatorsubkeg')->name('api.getindikatorsubkeg');

    // Indikator Rutin
    Route::get('/api/indikator/program/rutin/{idindikatorprog}', 'getindikatorprogrutin')->name('api.getindikatorprogrutin');
    Route::get('/api/indikator/kegiatan/rutin/{idindikatorkeg}', 'getindikatorkegrutin')->name('api.getindikatorkegrutin');

    // Pekerjaan DAK
    Route::get('/api/dak/lokus', 'lokusdak')->name('api.lokusdak');

    // Rutin
    Route::get('/api/rutin/kegiatan', 'getkegiatanrutin')->name('api.getkegiatanrutin');
    Route::get('/api/rutin/subkegiatan/{idkegiatan}/opd/{idopd}', 'getsubkegiatanrutin')->name('api.getsubkegiatanrutin');

    // Rutin By ID
    Route::get('/api/rutin/subkegiatan/{idsubkeg}', 'getsubkegrutinbyid')->name('api.getsubkegrutinbyid');
    Route::get('/api/rutin/subrincian/{idsubrincian}', 'getsubrincianrutinbyid')->name('api.getsubrincianrutinbyid');

    // Komponen SSH
    Route::get('/api/komponen/ssh/{id}', 'komponenssh')->name('api.komponenssh');
});


// API STANDAR HARGA
Route::controller(ApiKategoriController::class)->group(function () {
    Route::post('/api/get/kategori/by/kode', 'getkodekategoribyid');
});
Route::controller(ApiRekeningController::class)->group(function () {
    Route::post('/api/get/rekening/by/kode', 'getkoderekeningbyid');
});
Route::controller(ApiStandarHargaController::class)->group(function () {
    Route::post('/api/get/all/standarharga', 'getallstandarharga');
    Route::post('/api/find/standarharga', 'findstandarharga');
});
