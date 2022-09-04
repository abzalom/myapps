<x-app-layout title="{{ $title }}">
    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
    </div>

    @if (session()->has('pesan'))
    <div class="row mt-4 mb-4">
        <div class="alert alert-info">
            {{ session()->get('pesan') }}
        </div>
    </div>
    @endif

    {{-- <div class="row mb-4 mt-4">
        <div class="col">
            <a href="{{ route('olahdata.standarharga_2022salin') }}" class="btn btn-primary"><i class="fa-solid fa-copy fa-lg"></i> Salin</a>
        </div>
    </div> --}}

    <div class="row mb-4 mt-4">
        <div class="table-responsive mt-4 mb-4">
            <table class="table table-bordered table-hover table-striped datatables-sshsbu" style="width: 150%">
                <thead class="table-dark align-middle">
                    <tr>
                        <th></th>
                        <th>Kategori</th>
                        <th>rekening</th>
                        <th>Uraian</th>
                        <th>Spesifikasi</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Harga Inflasi</th>
                        <th>Zona 1</th>
                        <th>Zona 2</th>
                        <th>Zona 3</th>
                        <th>kel</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($sshs as $item)
                        @foreach ($item->sshsikd as $sshsikd)
                            <tr>
                                <td>{{ $item->kode_unik_subrincian }} - {{ $item->uraian }}</td>
                                <td>{{ $item->kode_unik_subrincian }}.{{ $sshsikd->kode_urut_sshsikd }}</td>
                                <td>{{ $sshsikd->rekening_subrincian }}</td>
                                <td>{{ $sshsikd->uraian }}</td>
                                <td>{{ $sshsikd->spesifikasi }}</td>
                                <td>{{ $sshsikd->satuan }}</td>
                                <td>{{ number_format($sshsikd->harga, 2, ',','.') }}</td>
                                <td>{{ number_format($sshsikd->harga / 100 * $sshsikd->inflasi + $sshsikd->harga, 2, ',','.') }}</td>
                                @foreach ($zonasis as $zona)
                                    <td>
                                        {{ number_format($sshsikd->harga / 100 * $zona->persentasi + $sshsikd->harga / 100 * $sshsikd->inflasi + $sshsikd->harga, 2, ',','.') }}
                                    </td>
                                @endforeach
                                <td>{{ $sshsikd->kategori_name }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-warning me-md-1 edit-komponen-ssh" data-bs-toggle="modal" data-bs-target="#editSshModal" value="{{ $sshsikd->id }}"><i class="fa-solid fa-pencil-square fa-lg"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger delete-komponen-ssh" data-bs-toggle="modal" data-bs-target="#deleteSshModal" value="{{ $sshsikd->id }}"><i class="fa-solid fa-trash fa-lg"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('script.sshscript')
</x-app-layout>
