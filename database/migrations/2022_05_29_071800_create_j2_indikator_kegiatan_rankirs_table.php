<?php

use App\Models\A4Kegiatan;
use App\Models\F1Perangkat;
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
        Schema::create('j2_indikator_kegiatan_rankirs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A4Kegiatan::class);
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
        Schema::dropIfExists('j2_indikator_kegiatan_rankirs');
    }
};
