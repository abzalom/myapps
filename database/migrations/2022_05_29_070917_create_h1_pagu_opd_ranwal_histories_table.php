<?php

use App\Models\F1Perangkat;
use App\Models\C6SubrincianLra;
use App\Models\EStatusHistoryPagu;
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
        Schema::create('h1_pagu_opd_ranwal_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(F1Perangkat::class);
            $table->foreignIdFor(G2PendapatanUraianRanwal::class);
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
        Schema::dropIfExists('h1_pagu_opd_ranwal_histories');
    }
};
