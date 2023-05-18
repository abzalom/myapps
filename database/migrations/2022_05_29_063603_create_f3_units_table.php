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
        Schema::create('f3_units', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->integer('kode_unit')->unique()->index();
            $table->text('nama_unit');
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
        Schema::dropIfExists('f3_units');
    }
};
