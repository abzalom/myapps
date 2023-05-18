<x-app-layout title="{{ $title }}">

    @if (session()->has('pesan'))
    <div class="row mt-4 mb-4">
        <div class="alert alert-info">
            {{ session()->get('pesan') }}
        </div>
    </div>
    @endif

    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
    </div>    

    <div class="row mb-4 mt-4">
        <div class="col-6">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahOpdModal"><i class="fa fa-solid fa-plus-circle fa-lg"></i> Input OPD</a>
        </div>    
        <div class="col-6">
            <form action="{{ route('opd.updatekelompokbidang') }}" method="post">
                @csrf
                <div id="test_add_id_opd">
                    {{-- <input type="hidden" name="idopd[]"> --}}
                </div>
                <div class="row">
                    <div class="col-6">
                        <select class="form-select" name="kelompok_bidang" aria-label="Default select example">
                            <option value="">Pilih Kelompok Bidang</option>
                            @foreach ($kelbidangs as $kelbid)
                                <option value="{{ $kelbid->id }}">BIDANG {{ strtoupper($kelbid->uraian) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-secondary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover" id="_table_opd">
        <thead class="table-dark">
            <tr>
                <th></th>
                <th>Kode</th>
                <th>Nama OPD</th>
                <th>Kelompok Bidang</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-uppercase">
            @foreach ($opds as $opd)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input get-opd-id" type="checkbox" value="{{ $opd->id }}">
                        </div>
                    </td>
                    <td>{{ $opd->kode_perangkat }}</td>
                    <td>{{ $opd->nama_perangkat }}</td>
                    <td>
                        @if ($opd->kel_bidang)
                        {{ $opd->kel_bidang->uraian }}
                        @endif
                    </td>
                    <td>
                        <div class="row text-center">
                            <div class="col-6">
                                <button class="btn btn-primary edit-opd" value="{{ $opd->id }}" data-bs-toggle="modal" data-bs-target="#editOpdModal"><i class="fa fa-solid fa-pencil-square fa-lg"></i></button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary add-kepala-opd" value="{{ $opd->id }}" data-namaopd="{{ $opd->nama_perangkat }}" data-bs-toggle="modal" data-bs-target="#addKepalaOpdModal">
                                    Kepala
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('modal.modaltambahopd')
    @include('modal.modaledithopd')
    @include('modal.modaladdkepalaopd')
    @include('script.opdscript')

</x-app-layout>
