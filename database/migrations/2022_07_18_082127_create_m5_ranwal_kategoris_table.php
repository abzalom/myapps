<?php

use App\Models\F1Perangkat;
use App\Models\A5Subkegiatan;
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
        Schema::create('m5_ranwal_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(I2RenjaOpdRanwal::class);
            $table->foreignIdFor(A5Subkegiatan::class);
            $table->foreignIdFor(J3IndikatorSubkegiatanRanwal::class);
            $table->string('kode_unik_akun');
            $table->string('kode_unik_kelompok');
            $table->string('kode_unik_jenis');
            $table->string('kode_unik_objek');
            $table->string('kode_unik_rincian');
            $table->string('kode_unik_subrincian');
            $table->integer('kategori_kode');
            $table->string('kategori_name');
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
        Schema::dropIfExists('m5_ranwal_kategoris');
    }
};
