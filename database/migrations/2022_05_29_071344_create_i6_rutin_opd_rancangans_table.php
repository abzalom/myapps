<?php

use App\Models\ETahapan;
use App\Models\F1Perangkat;
use App\Models\A6ProgramRutin;
use App\Models\ETahunAnggaran;
use App\Models\A7KegiatanRutin;
use App\Models\EPrioritasDaerah;
use App\Models\A8SubkegiatanRutin;
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
        Schema::create('i6_rutin_opd_rancangans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(A6ProgramRutin::class);
            $table->foreignIdFor(A7KegiatanRutin::class);
            $table->foreignIdFor(A8SubkegiatanRutin::class);
            $table->foreignIdFor(EPrioritasNasional::class)->nullable();
            $table->foreignIdFor(EPrioritasProvinsi::class)->nullable();
            $table->foreignIdFor(EPrioritasDaerah::class)->nullable();
            $table->foreignIdFor(ETahapan::class);
            $table->foreignIdFor(ETahunAnggaran::class);
            $table->integer('status')->default(0);
            $table->string('kode_unik_renja')->unique()->index();
            $table->year('tahun');
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
        Schema::dropIfExists('i6_rutin_opd_rancangans');
    }
};
