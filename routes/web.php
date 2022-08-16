<?php

set_time_limit(0);

use App\Http\Controllers\AjaxHtmlReturn;
use App\Http\Controllers\api\rekening\ApiLraController;
use App\Http\Controllers\api\rekening\ApiNeracaController;
use App\Http\Controllers\api\ssh\ApiSshRutinController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiLoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPendukungController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NomenController;
use App\Http\Controllers\PaguController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\RanwalController;
use App\Http\Controllers\RanwalRutinController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\RekeningLoController;
use App\Http\Controllers\RekeningLraController;
use App\Http\Controllers\RekeningNeracaController;
use App\Http\Controllers\rka\RkaRanwalController;
use App\Http\Controllers\rka\RkaRanwalRutinController;
use App\Http\Controllers\RutinController;
use App\Http\Controllers\Standarharga\AsbController;
use App\Http\Controllers\Standarharga\HspkController;
use App\Http\Controllers\Standarharga\SbuController;
use App\Http\Controllers\Standarharga\SshController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('apps.index');
});

// Rutin
Route::controller(RutinController::class)->group(function () {
    Route::get('/rutin', 'rutin')->name('rutin.rutin');
    Route::get('/rutin/kegiatan', 'kegiatan')->name('rutin.kegiatan');
    Route::post('/rutin/kegiatan/import', 'kegiatanimport')->name('rutin.kegiatanimport');
    Route::get('/rutin/subkegiatan', 'subkegiatan')->name('rutin.subkegiatan');
    Route::post('/rutin/subkegiatan/import', 'subkegiatanimport')->name('rutin.subkegiatanimport');
});

// Nomenklatur
Route::controller(NomenController::class)->group(function () {
    Route::get('/nomens/urusan', 'urusan')->name('nomens.urusan');
    Route::get('/nomens/urusan/{urusan}/bidang', 'bidang')->name('nomens.bidang');
    Route::get('/nomens/urusan/{urusan}/bidang/{bidang}/program', 'program')->name('nomens.program');
    Route::get('/nomens/urusan/{urusan}/bidang/{bidang}/program/{program}/kegiatan', 'kegiatan')->name('nomens.kegiatan');
    Route::get('/nomens/urusan/{urusan}/bidang/{bidang}/program/{program}/kegiatan/{kegiatan}/subkegiatan', 'subkegiatan')->name('nomens.subkegiatan');

    Route::get('/nomen/api/bidang/{id1}/{id2}', 'apibidang')->name('apps.apibidang');
    Route::get('/nomen/api/subkegiatan/{id1}', 'apisubkegiatan')->name('apps.apisubkegiatan');
});

// Rekening Lra
Route::controller(RekeningLraController::class)->group(function () {
    Route::get('/rekening/lra', 'index')->name('lra.index');
    Route::get('/rekening/lra/kelompok/{akun}', 'kelompok')->name('lra.kelompok');
    Route::get('/rekening/lra/jenis/{kelompok}', 'jenis')->name('lra.jenis');
    Route::get('/rekening/lra/objek/{jenis}', 'objek')->name('lra.objek');
    Route::get('/rekening/lra/rincian/{objek}', 'rincian')->name('lra.rincian');
    Route::get('/rekening/lra/subrincian/{rincian}', 'subrincian')->name('lra.subrincian');
});

// Rekening Neraca
Route::controller(RekeningNeracaController::class)->group(function () {
    Route::get('/rekening/neraca', 'index')->name('neraca.index');
    Route::get('/rekening/neraca/kelompok/{akun}', 'kelompok')->name('neraca.kelompok');
    Route::get('/rekening/neraca/jenis/{kelompok}', 'jenis')->name('neraca.jenis');
    Route::get('/rekening/neraca/objek/{jenis}', 'objek')->name('neraca.objek');
    Route::get('/rekening/neraca/rincian/{objek}', 'rincian')->name('neraca.rincian');
    Route::get('/rekening/neraca/subrincian/{rincian}', 'subrincian')->name('neraca.subrincian');
});

// Rekening Lo
Route::controller(RekeningLoController::class)->group(function () {
    Route::get('/rekening/lo', 'index')->name('lo.index');
    Route::get('/rekening/lo/kelompok/{akun}', 'kelompok')->name('lo.kelompok');
    Route::get('/rekening/lo/jenis/{kelompok}', 'jenis')->name('lo.jenis');
    Route::get('/rekening/lo/objek/{jenis}', 'objek')->name('lo.objek');
    Route::get('/rekening/lo/rincian/{objek}', 'rincian')->name('lo.rincian');
    Route::get('/rekening/lo/subrincian/{rincian}', 'subrincian')->name('lo.subrincian');
});


// Master Data
Route::controller(PerangkatController::class)->group(function () {
    Route::get('/perangkat', 'index')->name('opd.index');
    Route::post('/perangkat/store', 'store')->name('opd.store');
    Route::post('/perangkat/store/kepala', 'storekepalaopd')->name('opd.storekepalaopd');
    Route::post('/perangkat/update', 'update')->name('opd.update');
    Route::get('/perangkat/api/edit/{id}', 'apiedit')->name('opd.apiedit');
});

// Pendapatan
Route::controller(PendapatanController::class)->middleware('tahapan')->group(function () {
    Route::get('/pendapatan', 'index')->name('pendapatan.index');
    Route::post('/pendapatan/store', 'store')->name('pendapatan.store');
    Route::post('/pendapatan/uraian/store', 'storeuraian')->name('pendapatan.storeuraian');
    Route::post('/pendapatan/uraian/update', 'updateuraian')->name('pendapatan.updateuraian');

    // Validasi
    Route::get('/pendapatan/validasi/ranwal', 'validasiranwal')->name('pendapatan.validasiranwal');
});

Route::controller(RekeningController::class)->group(function () {
    Route::get('/rekening/lra/api/jenis/{idkel}', 'apilrajenis')->name('opd.apilrajenis');
    Route::get('/rekening/lra/api/objek/{idjenis}', 'apilraobjek')->name('opd.apilraobjek');
    Route::get('/rekening/lra/api/rincian/{idobjek}', 'apilrarincian')->name('opd.apilrarincian');
    Route::get('/rekening/lra/api/subrincian/{idrincian}', 'apilrasubrincian')->name('opd.apilrasubrincian');
});

// Data Pendukung
Route::controller(DataPendukungController::class)->group(function () {
    Route::get('/datapendukung', 'index')->name('datadukung.index');

    // Lokasi
    Route::post('/datapendukung/lokasi/store', 'storelokasi')->name('datadukung.storelokasi');
    Route::get('/datapendukung/lokasi/delete/{idlokasi}', 'deletelokasi')->name('datadukung.deletelokasi');
    // Penerima manfaat
    Route::post('/datapendukung/penerimamanfaat/store', 'storepenerimamanfaat')->name('datadukung.storepenerimamanfaat');
    Route::get('/datapendukung/penerimamanfaat/delete/{idpenerimamanfaat}', 'deletepenerimamanfaat')->name('datadukung.deletepenerimamanfaat');
    // klasifikasi anggaran
    Route::post('/datapendukung/klasifikasi/store', 'storeklasifikasi')->name('datadukung.storeklasifikasi');
    Route::get('/datapendukung/klasifikasi/delete/{idklasifikasi}', 'deleteklasifikasi')->name('datadukung.deleteklasifikasi');
});

// Pengaturan
Route::controller(PengaturanController::class)->group(function () {
    Route::get('/pengaturan/rkpd', 'rkpd')->name('pengaturan.rkpd');
    Route::post('/pengaturan/tahapan', 'tahapan')->name('pengaturan.tahapan');
    Route::post('/pengaturan/tahapan/lock', 'tahapanlock')->name('pengaturan.tahapanlock');
    Route::get('/pengaturan/tahun/{id}', 'tahun')->name('pengaturan.tahun');
    Route::get('/pengaturan/store/table', 'storetable')->name('pengaturan.storetable');
    Route::get('/olahdata', 'olahdata')->name('pengaturan.olahdata');
});

// Pengaturan Pagu OPD
Route::controller(PaguController::class)->group(function () {
    Route::get('/pengaturan/pagu', 'paguopd')->name('pengaturan.paguopd');
    Route::post('/pengaturan/pagu/store', 'pagustore')->name('pengaturan.pagustore');
    Route::post('/pengaturan/pagu/update/reguler/', 'paguupdatereguler')->name('pengaturan.paguupdatereguler');
    Route::post('/pengaturan/pagu/update/pindah/', 'paguupdatepindah')->name('pengaturan.paguupdatepindah');
    Route::post('/pengaturan/pagu/validasi', 'paguvalidasi')->name('pengaturan.paguvalidasi');
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

// Ajax For HTML Return
Route::controller(AjaxHtmlReturn::class)->group(function () {
    // Pindahan dengan sumber dana
    Route::get('/ajax/opd/except/{idopd}', 'opdexcept')->name('ajax.opdexcept');
    Route::get('/ajax/bidang/pindah/{idopd}', 'getbidangpindah')->name('ajax.getbidangpindah');
    Route::get('/ajax/pagu/pindahan/opd/{idopd}/bidang/{idbidang}', 'pagupindahopd')->name('ajax.pagupindahopd');

    // Edit Biasa
    Route::get('/ajax/pagu/edit/biasa/{opd}/{pagu}', 'editpagubiasa')->name('ajax.editpagubiasa');
    Route::get('/ajax/pagu/edit/status', 'statuspaguedit')->name('ajax.statuspaguedit');

    // Pindah Pagu antar OPD dengan sumber dana yang asama
    Route::get('/ajax/pagu/pindah/bysumber/{idpendapatanuraian}/{idopd}', 'getopdbypendapatanuraian')->name('ajax.getopdbypendapatanuraian');
    Route::get('/ajax/pagu/pindah/bidangbyopd/{idopd}', 'getbidangbyopd')->name('ajax.getbidangbyopd');
});

// History
Route::controller(HistoryController::class)->group(function () {
    Route::get('/history/pagu', 'historypagu')->name('history.historypagu');
});

Route::controller(RanwalController::class)->group(function () {
    Route::get('/renja/rancangan/awal', 'ranwal')->name('ranwal.ranwal');
    Route::get('/renja/rancangan/awal/opd/{id}', 'ranwalopd')->name('ranwal.ranwalopd');
    // Create Renja Ranwal
    Route::post('/renja/rancangan/awal/store', 'store')->name('ranwal.store');
    // Create Indikator & Sub Rincian
    Route::post('/renja/rancangan/awal/indikator/program/store', 'indikatorprogramstore')->name('ranwal.indikatorprogramstore');
    Route::post('/renja/rancangan/awal/indikator/kegiatan/store', 'indikatorkegiatanstore')->name('ranwal.indikatorkegiatanstore');
    Route::post('/renja/rancangan/awal/indikator/subkegiatan/store', 'indikatorsubkegiatanstore')->name('ranwal.indikatorsubkegiatanstore');
    Route::post('/renja/rancangan/awal/indikator/subkegiatan/update', 'indikatorsubkegiatanupdate')->name('ranwal.indikatorsubkegiatanupdate');
    Route::post('/renja/rancangan/awal/indikator/subkegiatan/delete', 'indikatorsubkegiatandelete')->name('ranwal.indikatorsubkegiatandelete');
    // Delete Renja
    Route::post('/renja/rancangan/awal/delete', 'destroy')->name('ranwal.destroy');
    // Cetak Renja Ranwal
    Route::get('/renja/rancangan/awal/cetak/opd/{id}', 'cetakrenja')->name('ranwal.cetakrenja');
});

Route::controller(RanwalRutinController::class)->group(function () {
    Route::post('/ranwalrutin/store', 'store')->name('ranwalrutin.store');
    Route::post('/ranwalrutin/destory', 'destory')->name('ranwalrutin.destory');
    Route::post('/ranwalrutin/subrincian/store', 'subrincianstore')->name('ranwalrutin.subrincianstore');
    Route::post('/ranwalrutin/subrincian/update', 'subrincianupdate')->name('ranwalrutin.subrincianupdate');
    Route::post('/ranwalrutin/subrincian/delete', 'subrinciandelete')->name('ranwalrutin.subrinciandelete');
    Route::post('/ranwalrutin/indikator/program/store', 'indikatorprogramstore')->name('ranwalrutin.indikatorprogramstore');
    Route::post('/ranwalrutin/indikator/kegiatan/store', 'indikatorkegiatanstore')->name('ranwalrutin.indikatorkegiatanstore');
});

// Standar Harga SSH Route
Route::controller(SshController::class)->group(function () {
    Route::get('/standarharga/ssh', 'ssh')->name('ssh.ssh');
    Route::post('/standarharga/ssh/store', 'sshstore')->name('ssh.sshstore');
    Route::post('/standarharga/ssh/update', 'sshupdate')->name('ssh.sshupdate');
    Route::post('/standarharga/ssh/upload', 'sshupload')->name('ssh.sshupload');
    Route::post('/standarharga/ssh/delete', 'sshdelete')->name('ssh.sshdelete');
    Route::get('/standarharga/ssh/validasi/ranwal', 'validasisshranwal')->name('ssh.validasisshranwal');
});

// Standar Harga HSPK Route
Route::controller(HspkController::class)->group(function () {
    Route::get('/standarharga/hspk', 'hspk')->name('hspk.hspk');
    Route::post('/standarharga/hspk/store', 'hspkstore')->name('hspk.hspkstore');
    Route::post('/standarharga/hspk/update', 'hspkupdate')->name('hspk.hspkupdate');
    Route::post('/standarharga/hspk/upload', 'hspkupload')->name('hspk.hspkupload');
    Route::post('/standarharga/hspk/delete', 'hspkdelete')->name('hspk.hspkdelete');
    Route::get('/standarharga/hspk/validasi/ranwal', 'validasihspkranwal')->name('hspk.validasihspkranwal');
});

// Standar Harga ASB Route
Route::controller(AsbController::class)->group(function () {
    Route::get('/standarharga/asb', 'asb')->name('asb.asb');
    Route::post('/standarharga/asb/store', 'asbstore')->name('asb.asbstore');
    Route::post('/standarharga/asb/update', 'asbupdate')->name('asb.asbupdate');
    Route::post('/standarharga/asb/upload', 'asbupload')->name('asb.asbupload');
    Route::post('/standarharga/asb/delete', 'asbdelete')->name('asb.asbdelete');
    Route::get('/standarharga/asb/validasi/ranwal', 'validasiasbranwal')->name('asb.validasiasbranwal');
});

// Standar Harga SBU Route
Route::controller(SbuController::class)->group(function () {
    Route::get('/standarharga/sbu', 'sbu')->name('sbu.sbu');
    Route::post('/standarharga/sbu/store', 'sbustore')->name('sbu.sbustore');
    Route::post('/standarharga/sbu/update', 'sbuupdate')->name('sbu.sbuupdate');
    Route::post('/standarharga/sbu/upload', 'sbuupload')->name('sbu.sbuupload');
    Route::post('/standarharga/sbu/delete', 'sbudelete')->name('sbu.sbudelete');
    Route::get('/standarharga/sbu/validasi/ranwal', 'validasisburanwal')->name('sbu.validasisburanwal');
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

// RKA OPD
Route::controller(RkaRanwalRutinController::class)->group(function () {
    Route::get('/rka/rutin/opd/{idopd}/renja/{idrenja}/rincian/{idsubrincian}', 'rkarutin')->name('rkarutin.rkarutin');
    Route::post('/rka/rutin/store', 'rkarutinstore')->name('rkarutin.rkarutinstore');
    Route::post('/rka/rutin/update', 'rkarutinupdate')->name('rkarutin.rkarutinupdate');
    Route::get('/rka/rutin/delete/{idkomponen}', 'rkarutindelete')->name('rkarutin.rkarutindelete');
    Route::get('/rka/rutin/restore/{idkomponen}', 'rkarutinrestore')->name('rkarutin.rkarutinrestore');
    Route::get('/rka/rutin/get/komponen/{id}', 'getkomponenbyid')->name('rkarutin.getkomponenbyid');
});
// RKA OPD
Route::controller(RkaRanwalController::class)->group(function () {
    Route::get('/rka/ranwal/opd/{idopd}/renja/{idrenja}/rincian/{idsubrincian}', 'rkaranwal')->name('rkaranwal.rkaranwal');
    Route::post('/rka/ranwal/store', 'rkaranwalstore')->name('rkaranwal.rkaranwalstore');
    Route::post('/rka/ranwal/update', 'rkaranwalupdate')->name('rkaranwal.rkaranwalupdate');
    Route::get('/rka/ranwal/delete/{idkomponen}', 'rkaranwaldelete')->name('rkaranwal.rkaranwaldelete');
    Route::get('/rka/ranwal/restore/{idkomponen}', 'rkaranwalrestore')->name('rkaranwal.rkaranwalrestore');
    Route::get('/rka/ranwal/get/komponen/{id}', 'getkomponenbyid')->name('rkaranwal.getkomponenbyid');
});