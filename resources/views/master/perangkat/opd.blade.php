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
        <div class="col">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahOpdModal"><i class="fa fa-solid fa-plus-circle fa-lg"></i></a>
        </div>    
    </div>

    <table class="table table-bordered table-striped table-hover datatables">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama OPD</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-uppercase">
            @foreach ($opds as $opd)
                <tr>
                    <td>{{ $opd->kode_perangkat }}</td>
                    <td>{{ $opd->nama_perangkat }}</td>
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
