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
        Schema::create('tag_kategori_belanjas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kategori')->nullable();
            $table->text('kategori_uraian')->nullable();
            $table->string('kode_belanja')->nullable();
            $table->string('kategori_ssh')->nullable();
            $table->integer('kode_kategori_ssh')->nullable();
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
        Schema::dropIfExists('tag_kategori_belanjas');
    }
};
