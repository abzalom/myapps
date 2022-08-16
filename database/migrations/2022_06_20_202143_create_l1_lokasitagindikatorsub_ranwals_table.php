<?php

use App\Models\ELokasi;
use App\Models\J3IndikatorSubkegiatanRanwal;
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
        Schema::create('l1_lokasitagindikatorsub_ranwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ELokasi::class);
            $table->foreignIdFor(J3IndikatorSubkegiatanRanwal::class);
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
        Schema::dropIfExists('l1_lokasitagindikatorsub_ranwals');
    }
};
