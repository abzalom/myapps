<?php

use App\Models\B1AkunNeraca;
use App\Models\B3JenisNeraca;
use App\Models\B4ObjekNeraca;
use App\Models\B5RincianNeraca;
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
        Schema::create('b6_subrincian_neracas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(B1AkunNeraca::class);
            $table->foreignIdFor(B2KelompokNeraca::class);
            $table->foreignIdFor(B3JenisNeraca::class);
            $table->foreignIdFor(B4ObjekNeraca::class);
            $table->foreignIdFor(B5RincianNeraca::class);

            $table->string('kode_akun');
            $table->string('kode_kelompok');
            $table->string('kode_jenis');
            $table->string('kode_objek');
            $table->string('kode_rincian');
            $table->string('kode_subrincian');
            $table->string('kode_unik_akun')->index();
            $table->string('kode_unik_kelompok')->index();
            $table->string('kode_unik_jenis')->index();
            $table->string('kode_unik_objek')->index();
            $table->string('kode_unik_rincian')->index();
            $table->string('kode_unik_subrincian')->index()->unique();
            $table->text('uraian');
            $table->string('kategori_ssh')->nullable();
            $table->integer('kode_kategori_ssh')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('b6_subrincian_neracas');
    }
};
