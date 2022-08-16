<?php

use App\Models\B1AkunNeraca;
use App\Models\B2KelompokNeraca;
use App\Models\B3JenisNeraca;
use App\Models\B4ObjekNeraca;
use App\Models\B5RincianNeraca;
use App\Models\B6SubrincianNeraca;
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
        Schema::create('k2_ssh_kategoris', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(B1AkunNeraca::class);
            // $table->foreignIdFor(B2KelompokNeraca::class);
            // $table->foreignIdFor(B3JenisNeraca::class);
            // $table->foreignIdFor(B4ObjekNeraca::class);
            // $table->foreignIdFor(B5RincianNeraca::class);
            // $table->foreignIdFor(B6SubrincianNeraca::class);
            $table->string('kode_unik_akun');
            $table->string('kode_unik_kelompok');
            $table->string('kode_unik_jenis');
            $table->string('kode_unik_objek');
            $table->string('kode_unik_rincian');
            $table->string('kode_unik_subrincian');
            $table->integer('kategori_kode');
            $table->string('kategori_name');
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
        Schema::dropIfExists('k2_ssh_kategoris');
    }
};
