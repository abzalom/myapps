<?php

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
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
        Schema::create('c3_jenis_lras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(C1AkunLra::class);
            $table->foreignIdFor(C2KelompokLra::class);
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index()->unique();
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
        Schema::dropIfExists('c3_jenis_lras');
    }
};
