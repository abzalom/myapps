<?php

use App\Models\A1Urusan;
use App\Models\A2Bidang;
use App\Models\F1Perangkat;
use App\Models\C6SubrincianLra;
use Illuminate\Support\Facades\Schema;
use App\Models\G2PendapatanUraianRanwal;
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
        Schema::create('h1_pagu_opd_ranwals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(A1Urusan::class);
            $table->foreignIdFor(A2Bidang::class);
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(G2PendapatanUraianRanwal::class);
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
        Schema::dropIfExists('h1_pagu_opd_ranwals');
    }
};
