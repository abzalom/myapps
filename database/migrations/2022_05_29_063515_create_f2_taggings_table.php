<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
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
        Schema::create('f2_taggings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            $table->string('kode_urut');
            $table->string('kode_perangkat')->index();
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
        Schema::dropIfExists('f2_taggings');
    }
};
