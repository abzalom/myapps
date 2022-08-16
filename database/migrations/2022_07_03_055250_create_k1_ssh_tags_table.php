<?php

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
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
        Schema::create('k1_ssh_tags', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(C1AkunLra::class);
            // $table->foreignIdFor(C2KelompokLra::class);
            // $table->foreignIdFor(C3JenisLra::class);
            // $table->foreignIdFor(C4ObjekLra::class);
            // $table->foreignIdFor(C5RincianLra::class);
            // $table->foreignIdFor(C6SubrincianLra::class);
            // $table->foreign('kode_unik_akun')->references('kode_unik_akun')->on('c1_akun_lras');
            // $table->foreign('kode_unik_kelompok')->references('kode_unik_kelompok')->on('c2_kelompok_lras');
            // $table->foreign('kode_unik_jenis')->references('kode_unik_jenis')->on('c3_jenis_lras');
            // $table->foreign('kode_unik_objek')->references('kode_unik_objek')->on('c4_objek_lras');
            // $table->foreign('kode_unik_rincian')->references('kode_unik_rincian')->on('c5_rincian_lras');
            // $table->foreign('kode_unik_subrincian')->references('kode_unik_subrincian')->on('c6_subrincian_lras');
            $table->string('kode_unik_akun');
            $table->string('kode_unik_kelompok');
            $table->string('kode_unik_jenis');
            $table->string('kode_unik_objek');
            $table->string('kode_unik_rincian');
            $table->string('kode_unik_subrincian');
            // $table->string('kategori_ssh')->nullable();
            // $table->string('kode_kategori_ssh')->nullable();
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
        Schema::dropIfExists('k1_ssh_tags');
    }
};
