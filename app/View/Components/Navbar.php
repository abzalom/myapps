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
            'Referensi' => [
                '/rekening/neraca' => 'Rekening Neraca',
                '/rekening/lra' => 'Rekening LRA',
                '/rekening/lo' => 'Rekening LO',
                '/datapendukung' => 'Data Pendukung',
                '/nomens/urusan' => 'Nomenklatur',
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
                // route('ssh.sshexport') => 'Export Excel',
            ],
            'Laporan' => [
                '#renja' => 'Renja',
                '#rka' => 'RKA',
            ],
            'Olah Data' => [
                '/olahdata/nomenklatur' => 'Nomenklatur',
                '/olahdata/standarharga/2022' => 'Standar Harga 2022'
            ],
        ];
        return view('components.navbar', compact('navs'));
    }
}
