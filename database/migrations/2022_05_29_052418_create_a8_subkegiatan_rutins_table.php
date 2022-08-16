<?php

use App\Models\A6ProgramRutin;
use App\Models\A7KegiatanRutin;
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
        Schema::create('a8_subkegiatan_rutins', function (Blueprint $table) {
            $table->id();
            // ids
            $table->foreignIdFor(A6ProgramRutin::class);
            $table->foreignIdFor(A7KegiatanRutin::class);
            // kode
            $table->string("kode_program")->index();
            $table->string("kode_kegiatan")->index();
            $table->string("kode_subkegiatan")->index();
            // kode unik
            $table->string("kode_unik_program");
            $table->string("kode_unik_kegiatan");
            $table->string("kode_unik_subkegiatan")->unique()->index();
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
        Schema::dropIfExists('a8_subkegiatan_rutins');
    }
};
