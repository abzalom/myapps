<?php

use App\Models\F1Perangkat;
use App\Models\A7KegiatanRutin;
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
        Schema::create('j5_indikator_kegiatan_rutin_rankirs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A7KegiatanRutin::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->string('kode_unik_kegiatan');
            $table->text('capaian');
            $table->string('target_capaian');
            $table->string('satuan_capaian');
            $table->text('keluaran');
            $table->string('target_keluaran');
            $table->string('satuan_keluaran');
            $table->text('hasil');
            $table->string('target_hasil');
            $table->string('satuan_hasil');
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
        Schema::dropIfExists('j5_indikator_kegiatan_rutin_rankirs');
    }
};
