<?php

use App\Models\ELokasi;
use Illuminate\Support\Facades\Schema;
use App\Models\J6SubrincianRutinRanwal;
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
        Schema::create('l2_lokasi_subrincian_ranwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ELokasi::class);
            $table->foreignIdFor(J6SubrincianRutinRanwal::class);
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
        Schema::dropIfExists('l2_lokasi_subrincian_ranwals');
    }
};
