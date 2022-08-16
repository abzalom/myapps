<?php

use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use App\Models\C6SubrincianLra;
use App\Models\G1Pendapatan;
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
        Schema::create('g1_pendapatan_uraians', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(C1AkunLra::class);
            $table->foreignIdFor(C2KelompokLra::class);
            $table->foreignIdFor(C3JenisLra::class);
            $table->foreignIdFor(C4ObjekLra::class);
            $table->foreignIdFor(C5RincianLra::class);
            $table->foreignIdFor(C6SubrincianLra::class);
            $table->foreignIdFor(G1Pendapatan::class);
            $table->integer('kode');
            $table->string('kode_unik');
            $table->text('uraian');
            $table->decimal('anggaran', 19, 2);
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
        Schema::dropIfExists('g1_pendapatan_uraians');
    }
};
