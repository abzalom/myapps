<?php

use App\Models\D1AkunLo;
use App\Models\D3JenisLo;
use App\Models\D4ObjekLo;
use App\Models\D2KelompokLo;
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
        Schema::create('d5_rincian_los', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(D1AkunLo::class);
            $table->foreignIdFor(D2KelompokLo::class);
            $table->foreignIdFor(D3JenisLo::class);
            $table->foreignIdFor(D4ObjekLo::class);
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index();
            $table->string('kode_unik_rincian')->index()->unique();
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
        Schema::dropIfExists('d5_rincian_los');
    }
};
