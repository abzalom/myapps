<?php

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
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
        Schema::create('c4_objek_lras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(C1AkunLra::class);
            $table->foreignIdFor(C2KelompokLra::class);
            $table->foreignIdFor(C3JenisLra::class);
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index()->unique();
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
        Schema::dropIfExists('c4_objek_lras');
    }
};
