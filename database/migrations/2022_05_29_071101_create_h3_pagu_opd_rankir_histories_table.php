<?php

use App\Models\F1Perangkat;
use App\Models\C6SubrincianLra;
use App\Models\EStatusHistoryPagu;
use Illuminate\Support\Facades\Schema;
use App\Models\G4PendapatanUraianRankir;
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
        Schema::create('h3_pagu_opd_rankir_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(G4PendapatanUraianRankir::class);
            $table->foreignIdFor(C6SubrincianLra::class);
            $table->decimal('pagu', 16, 2);
            $table->foreignIdFor(EStatusHistoryPagu::class);
            $table->text('keterangan');
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
        Schema::dropIfExists('h3_pagu_opd_rankir_histories');
    }
};
