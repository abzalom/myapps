<?php

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
        Schema::create('a1_urusans', function (Blueprint $table) {
            $table->id();
            // kode
            $table->string("kode_urusan")->index();
            // kode unik
            $table->integer("kode_unik_urusan")->unique()->index();
            // uraian
            $table->text("uraian");
            $table->text("kinerja")->nullable();
            $table->text("indikator")->nullable();
            $table->text("satuan")->nullable();
            $table->text("keterangan")->nullable();
            $table->boolean("kewenangan");
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
        Schema::dropIfExists('a1_urusans');
    }
};
