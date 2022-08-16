<x-app-layout title="{{ $title }}">
{{-- @dump($nomens->toArray()) --}}
    <div class="row mb-4 mt-4">
            <h5>{{ $desc }}</h5>
        </div>

        @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            {!! session()->get('pesan') !!}
        </div>
        @endif

        <div class="row mt-4 mb-4">
            <div class="col">
                <form action="{{ route('pengaturan.paguvalidasi') }}" method="post">
                    @csrf
                    @if ($tahapan->id == 1)
                    <input type="hidden" name="tahapan" value="{{ $tahapan->id }}">
                    <button class="btn btn-warning">
                        <i class="fa-solid fa-check-square fa-lg"></i> Validasi Ranwal
                    </button>
                    @endif
                </form>
            </div>
        </div>

        <div class=" table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle" id="tablePagu_" style="width: 105%">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10px">Kode</th>
                        <th style="width: 60%">Uraian</th>
                        <th style="width: 180px">Jumlah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nomens as $urusan)
                        <tr class="fw-bold text-uppercase">
                            <td>{{ $urusan->kode_unik_urusan }}</td>
                            <td>{{ $urusan->uraian }}</td>
                            <td style="width: auto"></td>
                            <td></td>
                        </tr>
                        @foreach ($urusan->bidang as $bidang)
                            <tr class="fw-bold text-uppercase">
                                <td>{{ $bidang->kode_unik_bidang }}</td>
                                <td>
                                    <div class="row">
                                        <div class="pl-3" style="padding-left: 25px">
                                            {{ $bidang->uraian }}
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($bidang->tags as $tag)
                                @foreach ($tag->opd as $opd)
                                    <tr class="text-uppercase">
                                    <td>{{ $bidang->kode_unik_bidang }}.{{ $opd->kode_urut }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="pl-3" style="padding-left: 40px">
                                                {{ $opd->nama_perangkat }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary tambah-pagu" data-idurusan="{{ $urusan->id }}" data-idbidang="{{ $bidang->id }}" data-idopd="{{ $opd->id }}" data-namaopd="{{ $opd->nama_perangkat }}" data-bs-toggle="modal" data-bs-target="#tambahPaguModal"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                                    </td>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($opd->paguopd as $paguopd)
                                    @if ($paguopd->a2_bidang_id == $bidang->id)
                                        <tr style="background-color: rgb(225, 212, 186)">
                                        <td>{{ $bidang->kode_unik_bidang }}.{{ $opd->kode_urut }}.{{ $no++ }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="pl-3" style="padding-left: 55px">
                                                    {{ $paguopd->pendapatan->uraian }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="row">
                                                <div class="col-2">
                                                    Rp.
                                                </div>
                                                <div class="col-10">
                                                    {{ number_format($paguopd->pagu, 2, ',', '.') }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-center">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-info btn-sm edit-pagu" title="Edit pagu" data-bs-toggle="modal" data-bs-target="#editPaguModal"  data-idopd="{{ $opd->id }}" data-namaopd="{{ strtoupper($opd->nama_perangkat) }}" data-idbidang="{{ $bidang->id }}" data-namabidang="{{ $bidang->uraian }}" data-idpagu="{{ $paguopd->id }}" data-namasumber="{{ $paguopd->pendapatan->uraian }}" data-jumlahpagu="{{ number_format($paguopd->pagu,2, ',','.') }}" data-jumlahpaguuntukedit="{{ $paguopd->pagu }}"><i class="fa-solid fa-pencil-square fa-lg text-indigo-100"></i></button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success btn-sm pindah-pagu" title="Pindahkan pagu ke OPD lain" data-bs-toggle="modal" data-bs-target="#pindahPaguModal" data-idopd="{{ $opd->id }}" data-namaopd="{{ strtoupper($opd->nama_perangkat) }}" data-idbidang="{{ $bidang->id }}" data-namabidang="{{ $bidang->uraian }}" data-idpagu="{{ $paguopd->id }}" data-namasumber="{{ $paguopd->pendapatan->uraian }}" data-jumlahpagu="{{ number_format($paguopd->pagu,2, ',','.') }}" data-jumlahpaguuntukedit="{{ $paguopd->pagu }}" data-g1pendapatanuraianid="{{ $paguopd->pendapatan->id }}"><i class="fa-solid fa-share-square text-indigo-100"></i></button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-danger btn-sm" title="Hapus pagu" data-bs-toggle="modal"><i class="fa-solid fa-trash fa-lg text-indigo-100"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- @dump($opds->toArray()) --}}

    @include('modal.modaladdpaguopd')
    @include('modal.modaleditpaguopd')
    @include('modal.modalpindahpaguopd')
    @include('script.paguscript')

</x-app-layout>
