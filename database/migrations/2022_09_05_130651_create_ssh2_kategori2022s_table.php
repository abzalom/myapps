<?php

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
        Schema::create('ssh2_kategori2022s', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(B1AkunNeraca::class);
            // $table->foreignIdFor(B2KelompokNeraca::class);
            // $table->foreignIdFor(B3JenisNeraca::class);
            // $table->foreignIdFor(B4ObjekNeraca::class);
            // $table->foreignIdFor(B5RincianNeraca::class);
            // $table->foreignIdFor(B6SubrincianNeraca::class);
            $table->string('kode_unik_akun')->nullable();
            $table->string('kode_unik_kelompok')->nullable();
            $table->string('kode_unik_jenis')->nullable();
            $table->string('kode_unik_objek')->nullable();
            $table->string('kode_unik_rincian')->nullable();
            $table->string('kode_unik_subrincian')->nullable();
            $table->integer('kategori_kode')->nullable();
            $table->string('kategori_name')->nullable();
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
        Schema::dropIfExists('ssh2_kategori2022s');
    }
};
