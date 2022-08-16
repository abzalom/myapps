<?php

use App\Models\F1Perangkat;
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
        Schema::create('f4_kepala_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->text('nama');
            $table->text('nip');
            $table->text('pangkat');
            $table->text('golongan');
            $table->text('jabatan');
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
        Schema::dropIfExists('f4_kepala_opds');
    }
};
