<?php

use App\Models\A8SubkegiatanRutin;
use App\Models\C1AkunLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C2KelompokLra;
use App\Models\C6SubrincianLra;
use App\Models\F1Perangkat;
use App\Models\I5RutinOpdRanwal;
use App\Models\J6SubrincianRutinRanwal;
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
        Schema::create('m1_rka_rutin_tag_ranwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(I5RutinOpdRanwal::class);
            $table->foreignIdFor(A8SubkegiatanRutin::class);
            $table->foreignIdFor(J6SubrincianRutinRanwal::class);
            $table->string('kode_unik_akun');
            $table->string('kode_unik_kelompok');
            $table->string('kode_unik_jenis');
            $table->string('kode_unik_objek');
            $table->string('kode_unik_rincian');
            $table->string('kode_unik_subrincian');
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
        Schema::dropIfExists('m1_rka_rutin_tag_ranwals');
    }
};
