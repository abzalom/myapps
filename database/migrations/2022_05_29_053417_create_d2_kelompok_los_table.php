<?php

use App\Models\D1AkunLo;
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
        Schema::create('d2_kelompok_los', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(D1AkunLo::class);
            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index()->unique();
            $table->text('uraian');
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
        Schema::dropIfExists('d2_kelompok_los');
    }
};
