<x-app-layout title="{{ $title }}">
        <div class="row mb-4 mt-4">
            <h5><a href="{{ route('ranwal.ranwalopd', $opd->id) }}" class="text-decoration-none">{{ $desc }}</a></h5>
        </div>

        @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            {!! session()->get('pesan') !!}
        </div>
        @endif

        <div class="row mb-4 mt-4">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr class="0-0">
                            <td class="pt-0 pb-0 pe-0" style="width: 120px">Program</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: x.xx.{{ $opd->ranwalrutinrka->programrka->kode_unik_program }} - {{ $opd->ranwalrutinrka->programrka->uraian }}</td>
                            <td class="pt-0 pb-0">

                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0 pe-0">Kegiatan</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: x.xx.{{ $opd->ranwalrutinrka->kegiatanrka->kode_unik_kegiatan }} - {{ $opd->ranwalrutinrka->kegiatanrka->uraian }}</td>
                            <td class="pt-0 pb-0">

                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0 pe-0">Sub Kegiatan</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: x.xx.{{ $opd->ranwalrutinrka->subkegiatanrka->kode_unik_subkegiatan }} - {{ $opd->ranwalrutinrka->subkegiatanrka->uraian }}</td>
                            <td class="pt-0 pb-0">

                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0 pe-0">Rincian</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: {{ ucwords($opd->ranwalrutinrka->subrincianrka->rincian) }}</td>
                            <td class="pt-0 pb-0">

                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0 pe-0">Anggaran</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: Rp. {{ number_format($opd->ranwalrutinrka->subrincianrka->anggaran, 2, ',', '.') }}</td>
                            <td class="pt-0 pb-0">

                            </td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0 pe-0">Target</td>
                            <td class="pt-0 pb-0 pe-0 ps-0">: {{ $opd->ranwalrutinrka->subrincianrka->target }} {{ $opd->ranwalrutinrka->subkegiatanrka->satuan }}</td>
                            <td class="pt-0 pb-0">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mb-1 mt-4 justify-content-end">
            <div class="col-3 p-0 m-1" style="width: 18%">
                <div class="card text-white bg-secondary mb-3" style="max-width:100%; height:auto">
                    <div class="card-body p-2 m-0">
                        <h5 class="card-title p-0 m-0"><i class="fa-solid fa-money-bill-1-wave"></i> RENJA :</h5>
                        <p class="p-0 m-0 fw-bold">Rp. {{ number_format($opd->ranwalrutinrka->subrincianrka->anggaran, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3 p-0 m-1" style="width: 18%">
                <div class="card text-white bg-primary mb-3" style="max-width:100%; height:auto">
                    <div class="card-body p-2 m-0">
                        <h5 class="card-title p-0 m-0"><i class="fa-solid fa-money-bill-1-wave"></i> RKA :</h5>
                        <p class="p-0 m-0 fw-bold">
                            Rp. {{ number_format($totalrka, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-3 p-0 m-1" style="width: 18%">
                <div class="card text-white bg-success mb-3" style="max-width:100%; height:auto">
                    <div class="card-body p-2 m-0">
                        <h5 class="card-title p-0 m-0"><i class="fa-solid fa-money-bill-1-wave"></i> SELISIH :</h5>
                        <p class="p-0 m-0 fw-bold">Rp. {{ number_format($opd->ranwalrutinrka->subrincianrka->anggaran - $totalrka, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 mt-1">
            <div class="col-6">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRkaModal"><i class="fa-solid fa-plus-square fa-lg"></i> Belanja</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#arsipRkaModal"><i class="fa-solid fa-folder-open fa-lg text-white"></i> Arsip</button>
            </div>
        </div>
        <div class="row mb-4 mt-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle" style="font-size: 95%">
                    <thead class="text-center align-middle table-dark">
                        <tr>
                            <th rowspan="2">Kode Rekening</th>
                            <th rowspan="2">Uraian</th>
                            <th colspan="4">Koefisien</th>
                            <th rowspan="2">Jumlah</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>PPN 10%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rkas as $objek)
                            <tr class="fw-bold">
                                <td>{{ $objek->kode_unik_objek }}</td>
                                <td>{{ $objek->uraian }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($objek->rincian as $rincian)
                                <tr class="fw-bold">
                                    <td>{{ $rincian->kode_unik_rincian }}</td>
                                    <td>{{ $rincian->uraian }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($rincian->subrincian as $subrincian)
                                    <tr class="fw-bold">
                                        <td>{{ $subrincian->kode_unik_subrincian }}</td>
                                        <td>{{ $subrincian->uraian }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($subrincian->rkaranwalrutinkomponen as $komponen)
                                    @php
                                        $pajak = 0;
                                        if($komponen->pajak == true){
                                            $jumlah = $komponen->volume * $komponen->harga;
                                            $pajak = $jumlah * 0.1;
                                        }
                                    @endphp
                                        <tr>
                                            <td>{{ $subrincian->kode_unik_subrincian }}.{{ $komponen->kode_urut_komponen }}</td>
                                            <td>
                                                {{ $komponen->uraian }}
                                                <br>
                                                <div class="fst-italic border-top">
                                                    spesifikasi : {{ $komponen->spesifikasi }}
                                                </div>
                                            </td>
                                            <td>{{ number_format($komponen->volume, 2, ',', '.') }}</td>
                                            <td>{{ $komponen->satuan }}</td>
                                            <td>{{ number_format($komponen->harga, 2, ',', '.') }}</td>
                                            <td>
                                                {{ number_format($pajak, 2, ',', '.') }}
                                            </td>
                                            <td>{{ number_format($komponen->volume * $komponen->harga + $pajak, 2, ',', '.') }}</td>
                                            <td>
                                                <div class="d-grid gap-2 d-md-flex justify-content-center">
                                                    <button type="button" class="btn btn-sm btn-warning me-md-1 edit-rka-rutin" data-bs-toggle="modal" data-bs-target="#editRkaModal" value="{{ encrypt($komponen->id) }}"><i class="fa-solid fa-pencil-square fa-lg"></i></button>
                                                    <a href="{{ route('rkarutin.rkarutindelete', encrypt($komponen->id)) }}" class="btn btn-sm btn-danger delete-rka-rutin"><i class="fa-solid fa-trash fa-lg"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @include('script.rkarutinranwalscript')
    @include('rkaopdranwal.modalrutin.modaladdrkarutin')
    @include('rkaopdranwal.modalrutin.modaleditrkarutin')
    @include('rkaopdranwal.modalrutin.modalarsiprkarutin')
</x-app-layout>
