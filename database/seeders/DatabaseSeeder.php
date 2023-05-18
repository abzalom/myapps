<?php

namespace Database\Seeders;

use App\Models\A6ProgramRutin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            A1UrusanSeeder::class,
            A2BidangSeeder::class,
            A3ProgramSeeder::class,
            A4KegiatanSeeder::class,
            A5SubkegiatanSeeder::class,
            A6ProgramRutinSeeder::class,
            A7KegiatanRutinSeeder::class,
            A8SubkegiatanRutinSeeder::class,

            B1AkunNeracaSeeder::class,
            B2KelompokNeracaSeeder::class,
            B3JenisNeracaSeeder::class,
            B4ObjekNeracaSeeder::class,
            B5RincianNeracaSeeder::class,
            B6SubrincianNeracaSeeder::class,

            C1AkunLraSeeder::class,
            C2KelompokLraSeeder::class,
            C3JenisLraSeeder::class,
            C4ObjekLraSeeder::class,
            C5RincianLraSeeder::class,
            C6SubrincianLraSeeder::class,

            D1AkunLoSeeder::class,
            D2KelompokLoSeeder::class,
            D3JenisLoSeeder::class,
            D4ObjekLoSeeder::class,
            D5RincianLoSeeder::class,
            D6SubrincianLoSeeder::class,

            EJenisKomponenSeeder::class,
            EJenisPekerjaanSeeder::class,
            EJenisSshSeeder::class,
            EKalenderSeeder::class,
            EKelompokBidangSeeder::class,
            EKlasifikasiSeeder::class,
            ELokasiSeeder::class,
            EPenerimaManfaatSeeder::class,
            EPrioritasDaerahSeeder::class,
            EPrioritasNasionalSeeder::class,
            EPrioritasProvinsiSeeder::class,
            EStatusHistoryPaguSeeder::class,
            EStatusRenjaSeeder::class,
            ETahapanSeeder::class,
            ETahunAnggaranSeeder::class,
            EZonasiSeeder::class,

            F1PerangkatSeeder::class,
            F2TaggingSeeder::class,

            G1PendapatanSeeder::class,
            G1PendapatanUraianSeeder::class,

            G2PendapatanRanwalSeeder::class,
            G2PendapatanUraianRanwalSeeder::class,

            G3PendapatanRancanganSeeder::class,
            G3PendapatanUraianRancanganSeeder::class,

            G4PendapatanRankirSeeder::class,
            G4PendapatanUraianRankirSeeder::class,

            H1PaguOpdHistorySeeder::class,

            TagKategoriBelanjaSeeder::class,
        ]);
    }
}
