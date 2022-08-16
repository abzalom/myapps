<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
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
        Schema::create('a3_programs', function (Blueprint $table) {
            $table->id();
            // ids
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            // kode
            $table->string("kode_urusan")->index();
            $table->string("kode_bidang")->index();
            $table->string("kode_program")->index();
            // kode unik
            $table->string("kode_unik_urusan")->index();
            $table->string("kode_unik_bidang")->index();
            $table->string("kode_unik_program")->unique()->index();
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
        Schema::dropIfExists('a3_programs');
    }
};