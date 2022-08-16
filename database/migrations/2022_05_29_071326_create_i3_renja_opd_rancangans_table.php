<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\ETahapan;
use App\Models\A3Program;
use App\Models\A4Kegiatan;
use App\Models\F1Perangkat;
use App\Models\A5Subkegiatan;
use App\Models\ETahunAnggaran;
use App\Models\EPrioritasDaerah;
use App\Models\EPrioritasNasional;
use App\Models\EPrioritasProvinsi;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i3_renja_opd_rancangans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            $table->foreignIdFor(A3Program::class);
            $table->foreignIdFor(A4Kegiatan::class);
            $table->foreignIdFor(A5Subkegiatan::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(EPrioritasNasional::class)->nullable();
            $table->foreignIdFor(EPrioritasProvinsi::class)->nullable();
            $table->foreignIdFor(EPrioritasDaerah::class)->nullable();
            $table->foreignIdFor(ETahapan::class);
            $table->foreignIdFor(ETahunAnggaran::class);
            $table->integer('status')->default(0);
            $table->string('kode_unik_renja')->unique()->index();
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
        Schema::dropIfExists('i3_renja_opd_rancangans');
    }
};
