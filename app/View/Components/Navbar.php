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
            [
                'name' => 'Renja',
                'drop' => [
                    [
                        'name' => 'Rancangan Awal',
                        'link' => '/renja/rancangan/awal',
                        'role' => ['admin', 'user'],
                    ],
                ],
                'role' => ['admin', 'user'],
            ],
            [
                'name' => 'Master',
                'drop' => [
                    [
                        'name' => 'OPD',
                        'link' => '/perangkat',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Pendapatan',
                        'link' => '/pendapatan',
                        'role' => ['admin'],
                    ],
                ],
                'role' => ['admin'],
            ],
            [
                'name' => 'Referensi',
                'drop' => [
                    [
                        'name' => 'Rekening Neraca',
                        'link' => '/rekening/neraca',
                        'role' => ['admin', 'user'],
                    ],
                    [
                        'name' => 'Rekening LRA',
                        'link' => '/rekening/lra',
                        'role' => ['admin', 'user'],
                    ],
                    [
                        'name' => 'Rekening LO',
                        'link' => '/rekening/lo',
                        'role' => ['admin', 'user'],
                    ],

                    [
                        'name' => 'Nomenklatur',
                        'link' => '/nomens/urusan',
                        'role' => ['admin', 'user'],
                    ],
                    [
                        'name' => 'Rekening Belanja',
                        'link' => '/rekening/belanja',
                        'role' => ['admin', 'user'],
                    ],
                ],
                'role' => ['admin', 'user'],
            ],
            [
                'name' => 'Pengaturan',
                'drop' => [
                    [
                        'name' => 'RKPD',
                        'link' => '/pengaturan/rkpd',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Pagu OPD',
                        'link' => '/pengaturan/pagu',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Pagu OPD',
                        'link' => '/pengaturan/pagu',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Data Pendukung',
                        'link' => '/datapendukung',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Store Table',
                        'link' => '/pengaturan/store/table',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Olah Data',
                        'link' => '/olahdata',
                        'role' => ['admin'],
                    ],
                ],
                'role' => ['admin'],
            ],
            [
                'name' => 'Catatan',
                'drop' => [
                    [
                        'name' => 'History pagu OPD',
                        'link' => '/history/pagu',
                        'role' => ['admin'],
                    ],
                ],
                'role' => ['admin'],
            ],
            [
                'name' => 'Rutin',
                'drop' => [
                    [
                        'name' => 'Rutin',
                        'link' => '/rutin',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Kegiatan',
                        'link' => '/rutin/kegiatan',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Sub Kegiatan',
                        'link' => '/rutin/subkegiatan',
                        'role' => ['admin'],
                    ],
                ],
                'role' => ['admin'],
            ],
            [
                'name' => 'Standar Harga',
                'drop' => [
                    [
                        'name' => 'Home',
                        'link' => '/standarharga/all',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => '1. SSH',
                        'link' => '/standarharga/ssh',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => '2. HSPK',
                        'link' => '/standarharga/hspk',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => '3. ASB',
                        'link' => '/standarharga/asb',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => '4. SBU',
                        'link' => '/standarharga/sbu',
                        'role' => ['admin'],
                    ],
                    [
                        'name' => 'Cetak',
                        'link' => '/standarharga/cetak',
                        'role' => ['admin'],
                    ],
                ],
                'role' => ['admin'],
            ],
            // 'Rekening LRA' => [
            //     '/rekening/lra/rekap/4' => 'Pendapatan',
            // ],
            // 'Laporan' => [
            //     '#renja' => 'Renja',
            //     '#rka' => 'RKA',
            // ],
            // 'Olah Data' => [
            //     '/olahdata/nomenklatur' => 'Nomenklatur',
            //     '/olahdata/standarharga/2022' => 'Standar Harga 2022'
            // ],
        ];
        return view('components.navbar', compact('navs'));
    }
}
