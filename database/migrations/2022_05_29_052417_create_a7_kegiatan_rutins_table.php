<?php

use App\Models\A6ProgramRutin;
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
        Schema::create('a7_kegiatan_rutins', function (Blueprint $table) {
            $table->id();
            // ids
            $table->foreignIdFor(A6ProgramRutin::class);
            // kode
            $table->string("kode_program")->index();
            $table->string("kode_kegiatan")->index();
            // kode unik
            $table->string("kode_unik_program");
            $table->string("kode_unik_kegiatan")->unique()->index();
            // uraian
            $table->text("uraian");
            $table->text("kinerja")->nullable();
            $table->text("indikator")->nullable();
            $table->text("satuan")->nullable();
            $table->text("keterangan")->nullable();
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
        Schema::dropIfExists('a7_kegiatan_rutins');
    }
};
