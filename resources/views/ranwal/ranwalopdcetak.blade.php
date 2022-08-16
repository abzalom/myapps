<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="/vendors/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>RENJA {{ $opd->nama_perangkat }}</title>
    <style>
        /* Large rounded green border */
        hr {
            /* height: 20px; */
            color: #000000 !important;
            background-color: #000000 !important;
            border: 10px solid black !important;
        }
    </style>
    <script>
        // print();
    </script>
</head>

<body>
    <div class="container-fluid border-bottom border-dark border-2">
        <div class="col-10">
            <div class="row mt-3">
                <div class="col-4 m-0 p-0">
                    <div class="text-end">
                        <img src="/imgs/logo/mamraya_logo.jpg" style="width: 30%" class="rounded"
                            alt="Kabupaten Mamberamo Raya">
                    </div>
                </div>
                <div class="col-8 m-0 p-0 text-center">
                    <h3 class="mb-0">PEMERINTAH KABUPATEN MAMBERAMO RAYA</h3>
                    <h4>{{ $opd->nama_perangkat }}</h4>
                    <p><i>Alamat : Jalan Raya Dinas Otonom, Kompleks Perkantoran - Burmeso</i></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 text-center">
        <h5 class="mb-0">RENCANA KERJA KERJA PEMERINTAH DAERAH</h5>
        <h5>TAHUN ANGGARAN {{ $opd->tahun }}</h5>
    </div>
    <div class="container-fluid mt-3">
        <table class="table table-bordered" style="font-size: 80%;">
            <thead class="table-secondary
            text-center align-middle">
                <tr>
                    <th scope="col" rowspan="2" colspan="5">Kode</th>
                    <th scope="col" rowspan="2" style="width: 30%">Uraian</th>
                    <th scope="col" rowspan="2">Sasaran Program</th>
                    <th scope="col" colspan="2">Capaian Program</th>
                    <th scope="col" colspan="2">Capaian Kegiatan</th>
                    <th scope="col" colspan="2">Otcome Kegiatan</th>
                    <th scope="col" colspan="2">Hasil Kegiatan</th>
                    <th scope="col" rowspan="2">Kinerja</th>
                    <th scope="col" rowspan="2">Indikator</th>
                    <th scope="col" rowspan="2">Target</th>
                    <th scope="col" rowspan="2">Klasifikasi</th>
                    <th scope="col" rowspan="2">Anggaran</th>
                    <th scope="col" rowspan="2">Sumber Dana</th>
                    <th scope="col" rowspan="2">Lokasi</th>
                </tr>
                <tr>
                    <th>Capaian</th>
                    <th>Target</th>
                    <th>Capaian</th>
                    <th>Target</th>
                    <th>Outcome</th>
                    <th>Target</th>
                    <th>Hasil</th>
                    <th>Target</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <!--
                ---
                --- Program Rutin
                ---
                -->
                @foreach ($rutins as $programrutin)
                    @if (count($programrutin->kegiatanrutin) !== 0)
                        <tr class="fw-bold">
                            <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_urusan }}</td>
                            <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_bidang }}</td>
                            <td style="width: 2%">{{ $programrutin->kode_program }}</td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                            </td>
                            <td>{{ $programrutin->uraian }}</td>
                            <td>
                                @if ($programrutin->indikatorprogranwal !== null)
                                    {{ $programrutin->indikatorprogranwal->sasaran }}
                                @endif
                            </td>
                            <td>
                                @if ($programrutin->indikatorprogranwal !== null)
                                    {{ $programrutin->indikatorprogranwal->capaian }}
                                @endif
                            </td>
                            <td>
                                @if ($programrutin->indikatorprogranwal !== null)
                                    {{ $programrutin->indikatorprogranwal->target . ' ' . $programrutin->indikatorprogranwal->satuan }}
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-end">
                                {{ number_format($programrutin->subrincianrutin_sum_anggaran, 2, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($programrutin->kegiatanrutin as $kegiatanrutin)
                            <tr class="fw-bold">
                                <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_urusan }}</td>
                                <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_bidang }}</td>
                                <td style="width: 2%">{{ $programrutin->kode_program }}</td>
                                <td style="width: 2%">{{ $kegiatanrutin->kode_kegiatan }}</td>
                                <td style="width: 2%"></td>
                                <td>{{ $kegiatanrutin->uraian }}</td>
                                <td>
                                    @if ($programrutin->indikatorprogranwal !== null)
                                        {{ $programrutin->indikatorprogranwal->sasaran }}
                                    @endif
                                </td>
                                <td>
                                    @if ($programrutin->indikatorprogranwal !== null)
                                        {{ $programrutin->indikatorprogranwal->capaian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($programrutin->indikatorprogranwal !== null)
                                        {{ $programrutin->indikatorprogranwal->target . ' ' . $programrutin->indikatorprogranwal->satuan }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->capaian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->target_capaian . ' ' . $kegiatanrutin->indikatorkegranwal->satuan_capaian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->keluaran }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->target_keluaran . ' ' . $kegiatanrutin->indikatorkegranwal->satuan_keluaran }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->hasil }}
                                    @endif
                                </td>
                                <td>
                                    @if ($kegiatanrutin->indikatorkegranwal !== null)
                                        {{ $kegiatanrutin->indikatorkegranwal->target_hasil . ' ' . $kegiatanrutin->indikatorkegranwal->satuan_hasil }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end">
                                    {{ number_format($kegiatanrutin->subrincianrutin_sum_anggaran, 2, ',', '.') }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($kegiatanrutin->subkegiatanrutin as $subkegiatanrutin)
                                <tr>
                                    <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_urusan }}</td>
                                    <td style="width: 2%">{{ $opd->tags[0]->bidang->kode_bidang }}</td>
                                    <td style="width: 2%">{{ $programrutin->kode_program }}</td>
                                    <td style="width: 2%">{{ $kegiatanrutin->kode_kegiatan }}</td>
                                    <td style="width: 2%">{{ $subkegiatanrutin->kode_subkegiatan }}</td>
                                    <td>{{ $subkegiatanrutin->uraian }}</td>
                                    <td>
                                        @if ($programrutin->indikatorprogranwal !== null)
                                            {{ $programrutin->indikatorprogranwal->sasaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($programrutin->indikatorprogranwal !== null)
                                            {{ $programrutin->indikatorprogranwal->capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($programrutin->indikatorprogranwal !== null)
                                            {{ $programrutin->indikatorprogranwal->target . ' ' .  $programrutin->indikatorprogranwal->satuan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->target_capaian. ' ' .  $kegiatanrutin->indikatorkegranwal->satuan_capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->keluaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->target_keluaran . ' ' .  $kegiatanrutin->indikatorkegranwal->satuan_keluaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->hasil }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatanrutin->indikatorkegranwal !== null)
                                            {{ $kegiatanrutin->indikatorkegranwal->target_hasil . ' ' . $kegiatanrutin->indikatorkegranwal->satuan_hasil }}
                                        @endif
                                    </td>
                                    <td>{{ $subkegiatanrutin->kinerja }}</td>
                                    <td>{{ $subkegiatanrutin->indikator }}</td>
                                    <td>
                                        @if ($subkegiatanrutin->subrincianrutin_sum_target == 0)
                                            
                                            {{ '?? ' .  $subkegiatanrutin->satuan }}
                                        @else
                                            {{ $subkegiatanrutin->subrincianrutin_sum_target . ' ' . $subkegiatanrutin->satuan }}
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($subkegiatanrutin->subrincianrutin->unique('klasifikasi') as $klasifikasi)
                                            {{ $klasifikasi->klasifikasi->uraian }}
                                        @endforeach
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($subkegiatanrutin->subrincianrutin_sum_anggaran, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        @foreach ($subkegiatanrutin->subrincianrutin->unique('sumberdana') as $subrincian)
                                            {{ $subrincian->sumberdana->uraianpendapatanranwal->uraian }},&nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $lokasiuniquerutin = [];
                                        @endphp
                                        @foreach ($subkegiatanrutin->subrincianrutin as $subrincianrutin)
                                            @foreach ($subrincianrutin->lokasi as $lokasirutin)
                                                @php
                                                    $lokasiuniquerutin[$lokasirutin->lokasi->id] = $lokasirutin->lokasi->lokasi;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                        @foreach ($lokasiuniquerutin as $itemlokasirutin)
                                            {{ $itemlokasirutin }},
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                @endforeach



                <!--
                ---
                --- Program Non Rutin
                ---
                -->

                @foreach ($nomens as $urusan)
                    {{-- <tr class="fw-bold">
                        <td style="width: 2%">{{ $urusan->kode_urusan }}</td>
                        <td>{{ $urusan->uraian }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">{{ number_format($urusan->subrincian_sum_anggaran, 2, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                    </tr> --}}
                    @foreach ($urusan->bidang as $bidang)
                        <tr class="fw-bold">
                            <td style="width: 2%">{{ $urusan->kode_urusan }}</td>
                            <td style="width: 2%">{{ $bidang->kode_bidang }}</td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                            <td style="width: 2%"></td>
                            <td>{{ $bidang->uraian }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-end">
                                {{ number_format($bidang->subrincianranwal_sum_anggaran, 2, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($bidang->program as $program)
                            <tr class="fw-bold">
                                <td style="width: 2%">{{ $urusan->kode_urusan }}</td>
                                <td style="width: 2%">{{ $bidang->kode_bidang }}</td>
                                <td style="width: 2%">{{ $program->kode_program }}</td>
                                <td style="width: 2%"></td>
                                <td style="width: 2%"></td>
                                    <td>{{ $program->uraian }}</td>
                                <td>
                                    @if ($program->ranwalindikator !== null)
                                        {{ $program->ranwalindikator->sasaran }}
                                    @endif
                                </td>
                                <td>
                                    @if ($program->ranwalindikator !== null)
                                        {{ $program->ranwalindikator->capaian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($program->ranwalindikator !== null)
                                        {{ $program->ranwalindikator->target . ' ' . $program->ranwalindikator->satuan }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end">
                                    {{ number_format($program->subrincian_sum_anggaran, 2, ',', '.') }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($program->kegiatan as $kegiatan)
                                <tr class="fw-bold">
                                    <td style="width: 2%">{{ $urusan->kode_urusan }}</td>
                                    <td style="width: 2%">{{ $bidang->kode_bidang }}</td>
                                    <td style="width: 2%">{{ $program->kode_program }}</td>
                                    <td style="width: 2%">{{ $kegiatan->kode_kegiatan }}</td>
                                    <td style="width: 2%"></td>
                                        <td>{{ $kegiatan->uraian }}</td>
                                    <td>
                                        @if ($program->ranwalindikator !== null)
                                            {{ $program->ranwalindikator->sasaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($program->ranwalindikator !== null)
                                            {{ $program->ranwalindikator->capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($program->ranwalindikator !== null)
                                            {{ $program->ranwalindikator->target. ' ' . $program->ranwalindikator->satuan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->target_capaian. ' ' . $kegiatan->ranwalindikator->satuan_capaian }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->keluaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->target_keluaran . ' ' . $kegiatan->ranwalindikator->satuan_keluaran }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->hasil }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            {{ $kegiatan->ranwalindikator->target_hasil . ' ' .  $kegiatan->ranwalindikator->satuan_hasil }}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">
                                        {{ number_format($kegiatan->subrincian_sum_anggaran, 2, ',', '.') }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($kegiatan->subkegiatan as $subkegiatan)
                                    <tr>
                                        <td style="width: 2%">{{ $urusan->kode_urusan }}</td>
                                        <td style="width: 2%">{{ $bidang->kode_bidang }}</td>
                                        <td style="width: 2%">{{ $program->kode_program }}</td>
                                        <td style="width: 2%">{{ $kegiatan->kode_kegiatan }}</td>
                                        <td style="width: 2%">{{ $subkegiatan->kode_subkegiatan }}</td>
                                            <td>{{ $subkegiatan->uraian }}</td>
                                        <td>
                                            @if ($program->ranwalindikator !== null)
                                                {{ $program->ranwalindikator->sasaran }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($program->ranwalindikator !== null)
                                                {{ $program->ranwalindikator->capaian }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($program->ranwalindikator !== null)
                                                {{ $program->ranwalindikator->target  . ' ' .  $program->ranwalindikator->satuan }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null)
                                                {{ $kegiatan->ranwalindikator->capaian }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null)
                                                {{ $kegiatan->ranwalindikator->target_capaian  . ' ' .  $kegiatan->ranwalindikator->satuan_capaian }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null) {{ $kegiatan->ranwalindikator->keluaran }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null)
                                                {{ $kegiatan->ranwalindikator->target_keluaran  . ' ' .  $kegiatan->ranwalindikator->satuan_keluaran }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null)
                                                {{ $kegiatan->ranwalindikator->hasil }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kegiatan->ranwalindikator !== null)
                                                {{ $kegiatan->ranwalindikator->target_hasil . ' ' . $kegiatan->ranwalindikator->satuan_hasil }}
                                            @endif
                                        </td>
                                        <td>{{ $subkegiatan->kinerja }}</td>
                                        <td>{{ $subkegiatan->indikator }}</td>
                                        <td class="text-nowrap">
                                            @if ($subkegiatan->ranwalindikator_sum_target == 0)
                                                {{ '?? ' .  $subkegiatan->satuan }}
                                            @else
                                                {{ $subkegiatan->ranwalindikator_sum_target . ' ' .  $subkegiatan->satuan }}
                                            @endif
                                        </td>
                                        <td>
                                            {{-- @dump($subkegiatan->ranwalindikator->unique('klasifikasiranwal')->toArray()) --}}
                                            @foreach ($subkegiatan->ranwalindikator->unique('klasifikasiranwal') as $subrincian)
                                                {{ $subrincian->klasifikasiranwal->uraian }}
                                            @endforeach
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($subkegiatan->ranwalindikator_sum_anggaran, 2, ',', '.') }}
                                        </td>
                                        <td style="width: 20%">
                                            @foreach ($subkegiatan->ranwalindikator->unique('sumberdanaranwal') as $subrincian)
                                                {{ $subrincian->sumberdanaranwal->uraianpendapatanranwal->uraian }},&nbsp;
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $lokasiunique = [];
                                            @endphp
                                            @foreach ($subkegiatan->ranwalindikator as $subrincian)
                                                @foreach ($subrincian->lokasiranwal as $lokasi)
                                                    @php
                                                        $lokasiunique[$lokasi->lokasi->id] = $lokasi->lokasi->lokasi;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                            @foreach ($lokasiunique as $itemlokasi)
                                                {{ $itemlokasi }},
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="container text-center mt-5 mb-5">
            <div class="row">
                <div class="col-7">

                </div>
                <div class="col-5 align-self-end">
                    <div class="text-center">
                        Burmeso, {{ date('d, M, Y') }}
                        <br>
                        <strong>
                            @if ($opd->kepalaopd !== null)
                                {{ ucwords(strtolower($opd->kepalaopd->jabatan)) }}
                                {{ ucwords(strtolower($opd->nama_perangkat)) }}
                            @else
                                Kepala/Plt/Plh {{ ucwords(strtolower($opd->nama_perangkat)) }}
                            @endif
                        </strong>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        @if ($opd->kepalaopd !== null)
                            <span class="border-2 border-bottom m-0 p-0 border-dark">
                                {{ $opd->kepalaopd->nama }}
                                <br>NIP : {{ $opd->kepalaopd->nip }}
                            </span>
                        @else
                            <span class="border-2 border-bottom m-0 p-0 border-dark">
                                Nama Lengkap Kepala OPD
                            </span>
                            <br>NIP : XXXXXXXX XXXXXX XX XXX
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
