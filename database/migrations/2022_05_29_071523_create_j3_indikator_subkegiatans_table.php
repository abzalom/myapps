<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\A3Program;
use App\Models\A4Kegiatan;
use App\Models\A5Subkegiatan;
use App\Models\EKlasifikasi;
use App\Models\EPenerimaManfaat;
use App\Models\EStatusRenja;
use App\Models\F1Perangkat;
use App\Models\H1PaguOpd;
use App\Models\I1RenjaOpd;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('j3_indikator_subkegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            $table->foreignIdFor(A3Program::class);
            $table->foreignIdFor(A4Kegiatan::class);
            $table->foreignIdFor(A5Subkegiatan::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(I1RenjaOpd::class);
            $table->foreignIdFor(H1PaguOpd::class);
            // $table->string('lokasi');
            $table->foreignIdFor(EKlasifikasi::class);
            $table->foreignIdFor(EPenerimaManfaat::class);
            $table->text('rincian');
            $table->text('indikator');
            $table->text('target');
            $table->text('satuan');
            $table->decimal('anggaran', 19, 2);
            $table->integer('mulai')->nullable();
            $table->integer('selesai')->nullable();
            $table->foreignIdFor(EStatusRenja::class)->default(1);
            // $table->integer('status')->default(0);
            $table->text('keterangan')->nullable();
            $table->year('tahun');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('j3_indikator_subkegiatans');
    }
};