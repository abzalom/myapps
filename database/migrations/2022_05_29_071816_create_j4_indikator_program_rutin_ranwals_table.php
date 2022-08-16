<?php

use App\Models\F1Perangkat;
use App\Models\A6ProgramRutin;
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
        Schema::create('j4_indikator_program_rutin_ranwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A6ProgramRutin::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->string('kode_unik_program');
            $table->text('sasaran');
            $table->text('capaian');
            $table->string('target');
            $table->string('satuan');
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
        Schema::dropIfExists('j4_indikator_program_rutin_ranwals');
    }
};
