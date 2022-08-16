<x-app-layout title="{{ $title }}">
{{-- @dump($opds->toArray()) --}}
    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
    </div>

    @if (session()->has('pesan'))
    <div class="row mt-4 mb-4">
            {!! session()->get('pesan') !!}
    </div>
    @endif

    <div class=" table-responsive">
        <table class="table table-bordered table-hover" style="width: auto">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th colspan="2">Nama OPD</th>
                    <th>Jumlah</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opds as $opd)
                    <tr class="fw-bold">
                        <td>{{ $opd->kode_perangkat }}</td>
                        <td colspan="2" class="text-uppercase">{{ $opd->nama_perangkat }}</td>
                        <td class="text-nowrap text-end">
                            <div class="row">
                                <div class="col-sm-2">
                                    Rp.
                                </div>
                                <div class="col-sm-9">
                                    {{ number_format($opd->paguopd_sum_pagu, 2, ',', '.') }}
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="col">
                                <button class="btn btn-primary btn-sm tambah-pagu" value="{{ $opd->id }}" data-namaopd="{{ ucwords($opd->nama_perangkat) }}" data-bs-toggle="modal" data-bs-target="#tambahPaguModal"><i class="fa fa-solid fa-plus-square fa-lg"></i></button>
                            </div>
                        </td>
                    </tr>
                    @foreach ($opd->paguopd as $pagu)
                        <tr style="background-color: rgb(246, 255, 216)">
                            <td></td>
                            <td style="width: 10px"></td>
                            <td>{{ $pagu->pendapatan->kode_unik }} - {{ $pagu->pendapatan->uraian }}</td>
                            <td class="text-end">
                                <div class="row" style="width: 220px">
                                    <div class="col-sm-2">
                                        Rp.
                                    </div>
                                    <div class="col-sm-9">
                                        {{ number_format($pagu->pagu, 2, ',', '.') }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap text-center" style="width: 18%">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-info btn-sm edit-pagu" title="Edit pagu" data-idopd="{{ $opd->id }}" data-idpagu="{{ $pagu->id }}" data-namaopd="{{ ucwords($opd->nama_perangkat) }}" data-namasumberdana="{{ $pagu->pendapatan->uraian }}" data-bs-toggle="modal" data-bs-target="#editPaguModal"><i class="fa fa-solid fa-pencil-square text-white"></i></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-success btn-sm pindah-pagu" title="Pindahkan pagu ke OPD Lain" data-pagusebelumnya="{{ (int) $pagu->pagu }}" data-pendapatanuraian="{{ $pagu->g1_pendapatan_uraian_id }}" data-idopd="{{ $opd->id }}" data-idpagu="{{ $pagu->id }}" data-namaopd="{{ ucwords($opd->nama_perangkat) }}" data-namasumberdana="{{ $pagu->pendapatan->uraian }}" data-bs-toggle="modal" data-bs-target="#pindahPaguModal"><i class="fa fa-solid fa-share text-white"></i></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm ambil-pagu" title="Tambahkan pagu dari OPD lain" data-idopd="{{ $opd->id }}" data-idpagu="{{ $pagu->id }}" data-namaopd="{{ ucwords($opd->nama_perangkat) }}" data-namasumberdana="{{ $pagu->pendapatan->uraian }}" data-bs-toggle="modal" data-bs-target="#editPaguModal"><i class="fa fa-solid fa-arrow-alt-circle-down text-white"></i></button>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm hapus-pagu" title="Hapus pagu"><i class="fa fa-solid fa-trash text-white"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if (count($opd->paguopd) !== 0)
                    <tr style="background-color: rgb(229, 251, 255)">
                        <td colspan="5"></td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- @dump($opds->toArray()) --}}

    @include('modal.modaladdpaguopd')
    @include('modal.modaleditpaguopd')
    @include('modal.modalpindahpaguopd')
    @include('script.paguscript')

</x-app-layout>
