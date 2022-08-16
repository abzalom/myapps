<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\F1Perangkat;
use App\Models\C6SubrincianLra;
use App\Models\F2Tagging;
use App\Models\G1PendapatanUraian;
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
        Schema::create('h1_pagu_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            $table->foreignIdFor(F1Perangkat::class);
            // $table->foreignIdFor(F2Tagging::class);
            $table->foreignIdFor(G1PendapatanUraian::class);
            $table->foreignIdFor(C6SubrincianLra::class);
            $table->decimal('pagu', 16, 2)->nullable();
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
        Schema::dropIfExists('h1_pagu_opds');
    }
};
