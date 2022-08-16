<?php

use App\Models\A3Program;
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
        Schema::create('j1_indikator_program_rankirs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A3Program::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->string('kode_unik_program');
            $table->text('sasaran');
            $table->text('capaian');
            $table->string('target');
            $table->string('satuan');
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
        Schema::dropIfExists('j1_indikator_program_rankirs');
    }
};
