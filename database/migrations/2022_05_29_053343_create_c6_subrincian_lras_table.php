<?php

use App\Models\C1AkunLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C2KelompokLra;
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
        Schema::create('c6_subrincian_lras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(C1AkunLra::class);
            $table->foreignIdFor(C2KelompokLra::class);
            $table->foreignIdFor(C3JenisLra::class);
            $table->foreignIdFor(C4ObjekLra::class);
            $table->foreignIdFor(C5RincianLra::class);
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_subrincian');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index();
            $table->string('kode_unik_rincian')->index();
            $table->string('kode_unik_subrincian')->index()->unique();
            $table->text('uraian');
            // $table->string('alias');
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
        Schema::dropIfExists('c6_subrincian_lras');
    }
};
