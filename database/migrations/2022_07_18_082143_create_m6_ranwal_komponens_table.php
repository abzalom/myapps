<?php

use App\Models\EZonasi;
use App\Models\F1Perangkat;
use App\Models\A5Subkegiatan;
use App\Models\EJenisKomponen;
use App\Models\I2RenjaOpdRanwal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\J3IndikatorSubkegiatanRanwal;
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
        Schema::create('m6_ranwal_komponens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(I2RenjaOpdRanwal::class);
            $table->foreignIdFor(A5Subkegiatan::class);
            $table->foreignIdFor(J3IndikatorSubkegiatanRanwal::class);
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
            $table->text('spesifikasi');
            $table->decimal('harga', 14, 2);
            $table->text('satuan');
            $table->decimal('inflasi', 14, 2);
            $table->decimal('volume', 14, 2);
            $table->boolean('pajak');
            $table->foreignIdFor(EJenisKomponen::class);
            $table->foreignIdFor(EZonasi::class);
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
        Schema::dropIfExists('m6_ranwal_komponens');
    }
};
