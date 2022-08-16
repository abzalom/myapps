<?php

use App\Models\B1AkunNeraca;
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
        Schema::create('b2_kelompok_neracas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(B1AkunNeraca::class);

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
        Schema::dropIfExists('b2_kelompok_neracas');
    }
};
