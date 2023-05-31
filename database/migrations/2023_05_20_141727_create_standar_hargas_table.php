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
        Schema::create('standar_hargas', function (Blueprint $table) {
            $table->id();
            /**
             * Rekening
             */
            $table->string('rekening_akun')->nullable();
            $table->string('rekening_kelompok')->nullable();
            $table->string('rekening_jenis')->nullable();
            $table->string('rekening_objek')->nullable();
            $table->string('rekening_rincian')->nullable();
            $table->string('rekening_subrincian')->nullable();
            $table->text('rekening_uraian')->nullable();

            /**
             * Kategori
             */
            $table->string('kategori_akun')->nullable();
            $table->string('kategori_kelompok')->nullable();
            $table->string('kategori_jenis')->nullable();
            $table->string('kategori_objek')->nullable();
            $table->string('kategori_rincian')->nullable();
            $table->string('kategori_subrincian')->nullable();
            $table->text('kategori_uraian')->nullable();

            /**
             * Uraian Komponen
             */
            $table->text('uraian');
            $table->text('spesifikasi')->nullable();
            $table->decimal('harga_zona_1', 14, 2)->nullable();
            $table->decimal('harga_zona_2', 14, 2)->nullable();
            $table->decimal('harga_zona_3', 14, 2)->nullable();
            $table->text('satuan')->nullable();
            $table->year('tahun');
            $table->integer('kode_kelompok')->nullable();
            $table->string('nama_kelompok')->nullable();
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
        Schema::dropIfExists('standar_hargas');
    }
};
