<x-app-layout title="{{ $title }}">
        <div class="row mb-4 mt-4">
            <h5>{{ $desc }}</h5>
        </div>

        @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            {!! session()->get('pesan') !!}
        </div>
        @endif

        <div class="row mt-4 mb-4">
            <div class="col-6">
                <button class="btn btn-primary" type="button" id="addAkunSsh" data-bs-toggle="modal" data-bs-target="#addSshModal">
                    <i class="fa-solid fa-plus"></i> Belanja
                </button>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('ssh.sshexport', 2) }}" class="btn btn-success text-white"><i class="fa-solid fa-file-excel fa-lg"></i> Export</a>
                <button class="btn btn-secondary" type="button" id="uploadSsh" data-bs-toggle="modal" data-bs-target="#uploadSshModal"><i class="fa-solid fa-upload"></i> Upload SSH</button>
            </div>
        </div>

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
                    @foreach ($ssh as $item)
                        @foreach ($item->komponen as $komponen)
                        @php
                            $inflasi = $komponen->harga / 100 * $komponen->inflasi;
                        @endphp
                            <tr>
                                <td>{{ $item->kode_unik_subrincian }} - {{ $item->uraian }}</td>
                                <td>{{ $item->kode_unik_subrincian }}.{{ $komponen->kode_urut_komponen }}</td>
                                <td>{{ $komponen->rekening_subrincian }}</td>
                                <td>{{ $komponen->uraian }}</td>
                                <td>{{ $komponen->spesifikasi }}</td>
                                <td>{{ $komponen->satuan }}</td>
                                <td class="text-end">{{ number_format($komponen->harga, 2, ',','.') }}</td>
                                <td class="text-end">{{ number_format($inflasi, 2, ',','.') }}</td>
                                @if ($komponen->zonasi)
                                @foreach ($zonasis as $zonasi)
                                    <td class="text-end">
                                        {{ number_format($komponen->harga * $zonasi->persentasi + $komponen->harga, 2, ',','.') }}
                                    </td>
                                @endforeach
                                @else
                                <td class="text-end">{{ number_format($inflasi + $komponen->harga, 2, ',','.') }}</td>
                                <td class="text-end">0,00</td>
                                <td class="text-end">0,00</td>
                                @endif
                                <td>{{ $komponen->kategori_name }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-warning me-md-1 edit-komponen-ssh" data-bs-toggle="modal" data-bs-target="#editSshModal" value="{{ $komponen->id }}"><i class="fa-solid fa-pencil-square fa-lg"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger delete-komponen-ssh" data-bs-toggle="modal" data-bs-target="#deleteSshModal" value="{{ $komponen->id }}"><i class="fa-solid fa-trash fa-lg"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

    @include('script.hspkscript')
    @include('standarharga.hspk.modalhspk.modaladdhspk')
    @include('standarharga.hspk.modalhspk.modaledithspk')
    @include('standarharga.hspk.modalhspk.modaluploadhspk')
    @include('standarharga.hspk.modalhspk.modaldeletehspk')
</x-app-layout>
