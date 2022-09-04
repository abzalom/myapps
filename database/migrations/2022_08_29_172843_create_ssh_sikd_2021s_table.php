<?php

use App\Models\EJenisKomponen;
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
        Schema::create('ssh_sikd_2021s', function (Blueprint $table) {
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

            /**
             * Kategori
             */
            $table->string('kategori_akun')->nullable();
            $table->string('kategori_kelompok')->nullable();
            $table->string('kategori_jenis')->nullable();
            $table->string('kategori_objek')->nullable();
            $table->string('kategori_rincian')->nullable();
            $table->string('kategori_subrincian')->nullable();
            $table->integer('kategori_kode')->nullable();
            $table->string('kategori_name')->nullable();

            /**
             * Uraian Komponen
             */
            $table->string('kode_urut_komponen')->index();
            $table->text('uraian');
            $table->text('spesifikasi')->nullable();
            $table->decimal('harga', 14, 2);
            $table->text('satuan')->nullable();
            $table->decimal('inflasi', 14, 2)->nullable();
            $table->foreignIdFor(EJenisKomponen::class);
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
        Schema::dropIfExists('ssh_sikd_2021s');
    }
};
