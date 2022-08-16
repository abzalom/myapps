<?php

use App\Models\F1Perangkat;
use App\Models\EKlasifikasi;
use App\Models\EStatusRenja;
use App\Models\A6ProgramRutin;
use App\Models\A7KegiatanRutin;
use App\Models\EJenisPekerjaan;
use App\Models\EPenerimaManfaat;
use App\Models\A8SubkegiatanRutin;
use App\Models\H2PaguOpdRancangan;
use App\Models\I6RutinOpdRancangan;
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
        Schema::create('j6_subrincian_rutin_rancangans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A6ProgramRutin::class);
            $table->foreignIdFor(A7KegiatanRutin::class);
            $table->foreignIdFor(A8SubkegiatanRutin::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(I6RutinOpdRancangan::class);
            $table->foreignIdFor(H2PaguOpdRancangan::class);
            // $table->string('lokasi');
            $table->foreignIdFor(EKlasifikasi::class);
            $table->foreignIdFor(EPenerimaManfaat::class);
            $table->text('rincian');
            // $table->text('indikator');
            $table->text('target');
            // $table->text('satuan');
            $table->decimal('anggaran', 19, 2);
            $table->foreignIdFor(EJenisPekerjaan::class);
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
        Schema::dropIfExists('j6_subrincian_rutin_rancangans');
    }
};
