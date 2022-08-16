<?php

use App\Models\B1AkunNeraca;
use App\Models\B3JenisNeraca;
use App\Models\B4ObjekNeraca;
use App\Models\B2KelompokNeraca;
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
        Schema::create('b5_rincian_neracas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(B1AkunNeraca::class);
            $table->foreignIdFor(B2KelompokNeraca::class);
            $table->foreignIdFor(B3JenisNeraca::class);
            $table->foreignIdFor(B4ObjekNeraca::class);

            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index();
            $table->string('kode_unik_rincian')->index()->unique();
            $table->text('uraian');
            // $table->string('alias');
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
        Schema::dropIfExists('b5_rincian_neracas');
    }
};
