<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $navs = [
            'Renja' => [
                '/renja/rancangan/awal' => 'Rancangan Awal'
            ],
            'Master' => [
                '/perangkat' => 'OPD',
                '/pendapatan' => 'Pendapatan',
            ],
            'Referensi Rekening' => [
                '/rekening/neraca' => 'Rekening Neraca',
                '/rekening/lra' => 'Rekening LRA',
                '/rekening/lo' => 'Rekening LO',
                '/datapendukung' => 'Data Pendukung',
            ],
            'Pengaturan' => [
                '/pengaturan/rkpd' => 'RKPD',
                '/pengaturan/pagu' => 'Pagu OPD',
                '/datapendukung' => 'Data Pendukung',
                '/pengaturan/store/table' => 'Store Table',
                '/olahdata' => 'Olah Data',
            ],
            'Catatan' => [
                '/history/pagu' => 'History pagu OPD',
            ],
            '/nomens/urusan' => 'Nomenklatur',
            'Rutin' => [
                '/rutin' => 'Rutin',
                '/rutin/kegiatan' => 'Kegiatan',
                '/rutin/subkegiatan' => 'Sub Kegiatan',
            ],
            'Standar Harga' => [
                '/standarharga/ssh' => '1. SSH',
                '/standarharga/hspk' => '2. HSPK',
                '/standarharga/asb' => '3. ASB',
                '/standarharga/sbu' => '4. SBU',
            ],
            'Laporan' => [
                '#renja' => 'Renja',
                '#rka' => 'RKA',
            ],
        ];
        return view('components.navbar', compact('navs'));
    }
}
