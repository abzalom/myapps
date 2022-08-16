<x-app-layout title="{{ $title }}">
    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
        <h5 class="text-uppercase">{{ $opd->kode_perangkat }} - {{ $opd->nama_perangkat }}</h5>
    </div>

    <div class="row mb-4 mt-4" style="font-size: 90%">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover align-middle" style="width: 60%">
                <thead style="background-color: rgb(186, 189, 206)">
                    <tr class="text-center">
                        <th>Sumber Pendanaan</th>
                        <th>Pagu</th>
                        <th>Renja</th>
                        <th>Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opd->tags as $sumber)
                        <tr class="fw-bold">
                            <td>{{ $sumber->bidang->uraian }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($sumber->bidang->paguranwal as $pagu)
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;- {{ $pagu->uraianpendapatanranwal->uraian }}</td>
                                <td class="text-nowrap text-end">{{ number_format($pagu->pagu, 2, ',', '.') }}</td>
                                <td class="text-nowrap text-end">
                                    {{ number_format($pagu->subrincianranwal_sum_anggaran + $pagu->subrinrianrutinranwal_sum_anggaran, 2, ',', '.') }}
                                </td>
                                <td class="text-nowrap text-end">
                                    {{ number_format($pagu->pagu - ($pagu->subrincianranwal_sum_anggaran + $pagu->subrinrianrutinranwal_sum_anggaran), 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot style="background-color: rgb(186, 189, 206)">
                    <th class="text-end">Total</th>
                    <th class="text-nowrap text-end">{{ number_format($opd->paguopdranwal_sum_pagu, 2, ',', '.') }}</th>
                    <th class="text-nowrap text-end">
                        {{ number_format($opd->subrincianranwal_sum_anggaran + $opd->subrincianrutinranwal_sum_anggaran, 2, ',', '.') }}</th>
                    <th class="text-nowrap text-end">
                        {{ number_format($opd->paguopdranwal_sum_pagu - ($opd->subrincianranwal_sum_anggaran + $opd->subrincianrutinranwal_sum_anggaran), 2, ',', '.') }}
                    </th>
                </tfoot>
            </table>
        </div>
    </div>

    @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            {!! session()->get('pesan') !!}
        </div>
    @endif

    {{-- @dd($opd->tags->toArray()) --}}

    <div class="row mt-4 mb-4">
        <div class="col-6">
            <button class="btn btn-primary" id="addRenjaButton" data-bs-toggle="modal"
                data-bs-target="#tambahRenjaModal"><i class="fa-solid fa-plus-square fa-xl"></i> Input Renja</button>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('ranwal.cetakrenja', [$opd->id]) }}" class="btn btn-success" target="_blank"><i
                    class="fa-solid fa-file-excel fa-lg"></i> Excel</a>
            <a href="{{ route('ranwal.cetakrenja', [$opd->id]) }}" class="btn btn-secondary" target="_blank"><i
                    class="fa-solid fa-print fa-lg"></i> Cetak Renja</a>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" style="width: 140%">
                <thead class="table-dark text-center align-middle text-nowrap">
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col" style="width: 30%">Uraian</th>
                        <th scope="col">Indikator</th>
                        <th scope="col">Target</th>
                        <th scope="col">Klasifikasi</th>
                        <th scope="col">Anggaran</th>
                        <th scope="col">Sumber Dana</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($rutins as $program)
                        @php
                            $idindikatorprogrutin = '';
                        @endphp
                        <tr class="fw-bold">
                            <td>
                                X.XX.{{ $program->kode_unik_program }}
                                {{-- {{ $opd->tags[0]->bidang->kode_unik_bidang }}.{{ $program->kode_unik_program }} --}}
                            </td>
                            <td>
                                {{ $program->uraian }}
                            </td>
                            <td>
                                @if ($program->indikatorprogranwal !== null)
                                    @php
                                        $idindikatorprogrutin = $program->indikatorprogranwal->id;
                                    @endphp
                                    {{ $program->indikatorprogranwal->capaian }}
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if ($program->indikatorprogranwal !== null)
                                    {{ $program->indikatorprogranwal->target }}
                                    {{ $program->indikatorprogranwal->satuan }}
                                @endif
                            </td>
                            <td></td>
                            <td class="text-end text-nowrap">
                                Rp. {{ number_format($program->subrincianrutin_sum_anggaran, 2, ',', '.') }}</td>
                            <td></td>
                            {{-- <td></td> --}}
                            <td></td>
                            <td class="text-center text-nowrap">
                                <!-- Add Renja -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addRutinModal"><i
                                        class="fa-solid fa-plus-square fa-lg"></i></button>

                                <!-- Add/Edit indikator Program -->
                                <button class="btn btn-secondary btn-sm indikator-program-rutin"
                                    value="{{ $idindikatorprogrutin }}" data-bs-toggle="modal"
                                    data-bs-target="#addIndikatorProgramRutinModal"><i
                                        class="fa-solid fa-pencil-square fa-lg"></i></button>
                            </td>
                        </tr>
                        @if ($program->kegiatanrutin !== null)
                            @foreach ($program->kegiatanrutin as $kegiatan)
                                @php
                                    $idindikatorkegrutin = '';
                                @endphp
                                <tr class="fw-bold">
                                    <td>X.XX.{{ $kegiatan->kode_unik_kegiatan }}</td>
                                    <td>{{ $kegiatan->uraian }}</td>
                                    <td>
                                        @if ($kegiatan->indikatorkegranwal !== null)
                                            @php
                                                $idindikatorkegrutin = $kegiatan->indikatorkegranwal->id;
                                            @endphp
                                            {{ $kegiatan->indikatorkegranwal->hasil }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kegiatan->indikatorkegranwal !== null)
                                            {{ $kegiatan->indikatorkegranwal->target_hasil }}
                                            {{ $kegiatan->indikatorkegranwal->satuan_hasil }}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td>{{ number_format($kegiatan->subrincianrutin_sum_anggaran, 2, ',', '.') }}</td> --}}
                                    <td></td>
                                    <td></td>
                                    <td class="text-center text-nowrap">
                                        <button class="btn btn-success btn-sm indikator-kegiatan-rutin"
                                            value="{{ $kegiatan->id }}" data-idindikator="{{ $idindikatorkegrutin }}"
                                            data-kodekeg="{{ $kegiatan->kode_unik_kegiatan }}"
                                            data-namakeg="{{ $kegiatan->uraian }}" data-bs-toggle="modal"
                                            data-bs-target="#addIndikatorKegiatanRutinModal"><i
                                                class="fa-solid fa-pencil-square fa-lg"></i></button>
                                    </td>
                                </tr>
                                @foreach ($kegiatan->subkegiatanrutin as $subkegiatan)
                                    <tr>
                                        <td>X.XX.{{ $subkegiatan->kode_unik_subkegiatan }}</td>
                                        <td>{{ $subkegiatan->uraian }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        {{-- <td>{{ number_format($subkegiatan->subrincianrutin_sum_anggaran, 2, ',', '.') }}</td> --}}
                                        <td></td>
                                        <td></td>
                                        <td class="text-center text-nowrap">
                                            <button class="btn btn-warning btn-sm add-subrincian-rutin"
                                                data-idsubkeg="{{ $subkegiatan->id }}"
                                                data-idranwalrutin="{{ $subkegiatan->ranwalrutin->id }}"
                                                data-idopd="{{ $subkegiatan->ranwalrutin->f1_perangkat_id }}"
                                                data-idbidang="{{ $opd->tags[0]->bidang->id }}" data-bs-toggle="modal"
                                                data-bs-target="#addSubRincianRutinModal"><i
                                                    class="fa-solid fa-plus-square fa-lg"></i></button>
                                            <button class="btn btn-danger btn-sm delete-subkegiatan-rutin"
                                                data-idranwalrutin="{{ $subkegiatan->ranwalrutin->id }}"
                                                data-ranwalrutin="X.XX.{{ $subkegiatan->kode_unik_subkegiatan . ' - ' . $subkegiatan->uraian }}"
                                                data-bs-toggle="modal" data-bs-target="#deleteRenjaRutinModal">
                                                <i class="fa-solid fa-trash fa-lg"></i></button>
                                        </td>
                                    </tr>
                                    @foreach ($subkegiatan->subrincianrutin as $subrincianrutin)
                                        <tr style="background-color: rgb(255, 255, 215); font-style: italic;">
                                            <td class="text-nowrap text-center" style="width: 8%">
                                                <div class="row">
                                                    <div class="col">
                                                        <button class="btn btn-info btn-sm me-2 edit-subrincian-rutin"
                                                            value="{{ $subrincianrutin->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#editSubRincianRutinModal"><i
                                                                class="fa-solid fa-pencil-square fa-lg"></i></button>
                                                        <button class="btn btn-danger btn-sm delete-subrincian-rutin"
                                                            value="{{ $subrincianrutin->id }}"
                                                            data-rincian="{{ $subrincianrutin->rincian }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteSubRincianRutinModal"><i
                                                                class="fa-solid fa-trash fa-lg"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ ucwords($subrincianrutin->rincian) }}</td>
                                            <td>{{ ucwords($subkegiatan->indikator) }}</td>
                                            <td class="text-nowrap">{{ ucwords($subrincianrutin->target) }}
                                                {{ $subkegiatan->satuan }}</td>
                                            <td>{{ ucwords($subrincianrutin->klasifikasi->uraian) }}</td>
                                            <td>{{ number_format($subrincianrutin->anggaran, 2, ',', '.') }}</td>
                                            <td style="width: 15%">
                                                {{ ucwords($subrincianrutin->sumberdana->uraianpendapatanranwal->uraian) }}
                                            </td>
                                            <td>
                                                @foreach ($subrincianrutin->lokasi as $lokasi)
                                                    {{ ucwords($lokasi->lokasi->lokasi) }},
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('rkarutin.rkarutin', [$opd->id, encrypt($subrincianrutin->i5_rutin_opd_ranwal_id), encrypt($subrincianrutin->id)]) }}"
                                                    class="btn btn-primary btn-sm">RKA Belanja</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="9" style="background-color: rgb(124, 117, 177)"></td>
                    </tr>


                    <!--
                    -- Program Non RUtin
                    -->
                    @foreach ($nomens as $urusan)
                        @foreach ($urusan->bidang as $bidang)
                            @foreach ($bidang->program as $program)
                                <tr class="fw-bold">
                                    <td>{{ $program->kode_unik_program }}</td>
                                    <td>{{ $program->uraian }}</td>
                                    @if ($program->ranwalindikator !== null)
                                        <td style="width: 20%">{{ $program->ranwalindikator->capaian }}</td>
                                        <td class="text-nowrap">{{ $program->ranwalindikator->target }}
                                            {{ $program->ranwalindikator->satuan }}</td>
                                    @else
                                        <td style="width: 20%"></td>
                                        <td></td>
                                    @endif
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary btn-sm indikator-program"
                                            data-idopd="{{ $opd->id }}" data-idprog="{{ $program->id }}"
                                            data-kodeprog="{{ $program->kode_unik_program }}"
                                            data-prog="{{ $program->kode_unik_program }} - {{ $program->uraian }}"
                                            data-bs-toggle="modal" data-bs-target="#addIndikatorProgamModal"><i
                                                class="fa-solid fa-pencil-square fa-lg"></i></button>
                                    </td>
                                </tr>
                                @foreach ($program->kegiatan as $kegiatan)
                                    <tr class="fw-bold">
                                        <td>{{ $kegiatan->kode_unik_kegiatan }}</td>
                                        <td>{{ $kegiatan->uraian }}</td>
                                        @if ($kegiatan->ranwalindikator !== null)
                                            <td>{{ $kegiatan->ranwalindikator->hasil }}</td>
                                            <td class="text-nowrap">{{ $kegiatan->ranwalindikator->target_hasil }}
                                                {{ $kegiatan->ranwalindikator->satuan_hasil }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-sm indikator-kegiatan"
                                                data-idopd="{{ $opd->id }}" data-idkeg="{{ $kegiatan->id }}"
                                                data-kodekeg="{{ $kegiatan->kode_unik_kegiatan }}"
                                                data-keg="{{ $kegiatan->kode_unik_kegiatan }} - {{ $kegiatan->uraian }}"
                                                data-bs-toggle="modal" data-bs-target="#addIndikatorKegiatanModal"><i
                                                    class="fa-solid fa-pencil-square fa-lg"></i></button>
                                        </td>
                                    </tr>
                                    @foreach ($kegiatan->subkegiatan as $subkegiatan)
                                        <tr>
                                            <td>{{ $subkegiatan->kode_unik_subkegiatan }}</td>
                                            <td>{{ $subkegiatan->uraian }}</td>
                                            <td>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            {{-- <td>{{ number_format($subkegiatan->ranwalindikator_sum_anggaran, 2, ',', '.') }}</td> --}}
                                            <td></td>
                                            <td></td>
                                            <td class="text-center text-nowrap">
                                                <button class="btn btn-primary btn-sm indikator-subkegiatan"
                                                    value="{{ $subkegiatan->id }}"
                                                    data-idranwal="{{ $subkegiatan->ranwal->id }}"
                                                    data-idopd="{{ $opd->id }}"
                                                    data-idbid="{{ $bidang->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#addSubRincianModal"><i
                                                        class="fa-solid fa-plus-square fa-lg"></i></button>
                                                <button class="btn btn-danger btn-sm delete-renja"
                                                    value="{{ $subkegiatan->ranwal->id }}"
                                                    data-subkeguraian="{{ $subkegiatan->uraian }}"
                                                    data-bs-toggle="modal" data-bs-target="#deleteRenjaModal"><i
                                                        class="fa-solid fa-trash fa-lg"></i></button>
                                            </td>
                                        </tr>
                                        @foreach ($subkegiatan->ranwalindikator as $indikator)
                                            <tr style="background-color: rgb(255, 255, 215); font-style: italic;">
                                                <td class="text-nowrap text-center" style="width: 8%">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button
                                                                class="btn btn-info btn-sm edit-indikator-subkegiatan me-2"
                                                                value="{{ $indikator->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#editSubRincianModal"><i
                                                                    class="fa-solid fa-pencil-square fa-lg"></i></button>
                                                            <button
                                                                class="btn btn-danger btn-sm delete-indikator-subkegiatan"
                                                                value="{{ $indikator->id }}"
                                                                data-rincian="{{ $indikator->rincian }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteSubRincianModal"><i
                                                                    class="fa-solid fa-trash fa-lg"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ ucwords($indikator->rincian) }}</td>
                                                <td>{{ ucwords($indikator->indikator) }}</td>
                                                <td class="text-nowrap">{{ ucwords($indikator->target) }}
                                                    {{ $indikator->satuan }}</td>
                                                <td>{{ ucwords($indikator->klasifikasiranwal->uraian) }}</td>
                                                <td>{{ number_format($indikator->anggaran, 2, ',', '.') }}</td>
                                                <td style="width: 15%">
                                                    {{ ucwords($indikator->sumberdanaranwal->uraianpendapatanranwal->uraian) }}
                                                </td>
                                                <td>
                                                    @foreach ($indikator->lokasiranwal as $lokasi)
                                                        {{ ucwords($lokasi->lokasi->lokasi) }},
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                                        <a href="{{ route('rkaranwal.rkaranwal', [$opd->id, encrypt($subkegiatan->ranwal->id), encrypt($indikator->id)]) }}"
                                                            class="btn btn-primary btn-sm">RKA Belanja</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Modal Renja Rutin --}}
    @include('modalranwal.modaladdrutin')
    @include('modalranwal.modaldeleterenjarutin')
    @include('modalranwal.modaladdindikatorprogramrutin')
    @include('modalranwal.modaladdindikatorkegiatanrutin')
    @include('modalranwal.modaladdrutinsubrincian')
    @include('modalranwal.modaleditrutinsubrincian')
    @include('modalranwal.modaldeleterutinsubrincian')

    {{-- Modal Renja Bidang --}}
    @include('modalranwal.modaladdrenja')
    @include('modalranwal.modaldeleterenja')
    @include('modalranwal.modaladdindikatorprogram')
    @include('modalranwal.modaladdindikatorkegiatan')
    @include('modalranwal.modaladdsubrincian')
    @include('modalranwal.modaleditsubrincian')
    @include('modalranwal.modaldeletesubrincian')

    {{-- Script --}}
    @include('script.renjascript')
</x-app-layout>
