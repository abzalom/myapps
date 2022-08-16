<x-app-layout title="{{ $title }}">

    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
    </div>

    <div class="row mb-4 mt-4">
        <div class="col-6">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPendapatanModal"><i class="fa fa-solid fa-plus-circle fa-lg"></i> Tambah</button>
        </div>
        <div class="col-6 text-end">
            @if ($tahapan->id == 1)
            <a href="{{ route('pendapatan.validasiranwal',) }}" class="btn btn-warning"><i class="fa fa-solid fa-check-circle fa-lg"></i> Validasi Pendapatan {{ $tahapan->uraian }} RKPD</a>
            @endif
        </div>
    </div>

    @if (session()->has('pesan'))
    <div class="row mt-4 mb-4">
        <div class="alert alert-success">
            {!! session()->get('pesan') !!}
        </div>
    </div>
    @endif

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 120px">Kode</th>
                <th colspan="7">uraian</th>
                <th>Jumlah</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reks as $akun)
                <tr class="fw-bold">
                    <td>{{ $akun->kode_unik_akun }}</td>
                    <td colspan="7">{{ $akun->uraian }}</td>
                    <td class="text-nowrap">Rp. {{ number_format($akun->komponen_sum_anggaran, 2, ',', '.') }}</td>
                    <td></td>
                </tr>
                @foreach ($akun->kelompok as $kelompok)
                    <tr class="fw-bold">
                        <td>{{ $kelompok->kode_unik_kelompok }}</td>
                        <td style="width: 10px"></td>
                        <td colspan="6">{{ $kelompok->uraian }}</td>
                        <td>Rp. {{ number_format($kelompok->komponen_sum_anggaran, 2, ',', '.') }}</td>
                        <td></td>
                    </tr>
                    @foreach ($kelompok->jenis as $jenis)
                        <tr class="fw-bold">
                            <td>{{ $jenis->kode_unik_jenis }}</td>
                            <td style="width: 1px"></td>
                            <td style="width: 1px"></td>
                            <td colspan="5">{{ $jenis->uraian }}</td>
                            <td>Rp. {{ number_format($jenis->komponen_sum_anggaran, 2, ',', '.') }}</td>
                            <td></td>
                        </tr>
                        @foreach ($jenis->objek as $objek)
                            <tr class="fw-bold">
                                <td>{{ $objek->kode_unik_objek }}</td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td style="width: 1px"></td>
                                <td colspan="4">{{ $objek->uraian }}</td>
                                <td>Rp. {{ number_format($objek->komponen_sum_anggaran, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            @foreach ($objek->rincian as $rincian)
                                <tr class="fw-bold">
                                    <td>{{ $rincian->kode_unik_rincian }}</td>
                                    <td style="width: 1px"></td>
                                    <td style="width: 1px"></td>
                                    <td style="width: 1px"></td>
                                    <td style="width: 1px"></td>
                                    <td colspan="3">{{ $rincian->uraian }}</td>
                                    <td>Rp. {{ number_format($rincian->komponen_sum_anggaran, 2, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                                @foreach ($rincian->subrincian as $subrincian)
                                    <tr>
                                        <td>{{ $subrincian->kode_unik_subrincian }}</td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 1px"></td>
                                        <td colspan="2">{{ $subrincian->uraian }}</td>
                                        <td>Rp. {{ number_format($subrincian->komponen_sum_anggaran, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm tambah-komponen" value="{{ $subrincian->id }}" style="background-color: rgb(154, 138, 255)" data-bs-toggle="modal" data-bs-target="#addRincianPendatanModal"><i class="fa fa-solid fa-plus-square fa-lg" style="color: rgb(255, 255, 255)"></i></button>
                                        </td>
                                    </tr>
                                    @foreach ($subrincian->komponen as $komponen)
                                        <tr class="fst-italic" style="background-color: rgb(223, 255, 230)">
                                            <td>{{ $komponen->kode_unik }}</td>
                                            <td style="width: 1px"></td>
                                            <td style="width: 1px"></td>
                                            <td style="width: 1px"></td>
                                            <td style="width: 1px"></td>
                                            <td style="width: 1px"></td>
                                            <td style="width: 1px"></td>
                                            <td>{{ $komponen->uraian }}</td>
                                            <td>Rp. {{ number_format($komponen->anggaran, 2, ',', '.') }}</td>
                                            <td>
                                                <button class="btn btn-sm edit-komponen" value="{{ $komponen->id }}" style="background-color: rgb(110, 148, 44)" data-bs-toggle="modal" data-bs-target="#editRincianPendatanModal"><i class="fa fa-solid fa-pencil-square fa-lg" style="color: rgb(255, 255, 255)"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>

@include('modal.modaladdpendapatan')
@include('modal.modaladdrincianpendapatan')
@include('modal.modalaeditrincianpendapatan')
@include('script.pendapatanscript')

</x-app-layout>
