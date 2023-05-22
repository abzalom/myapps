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
            <a href="{{ route('standarharga.cetak', [$tahun]) }}" class="btn btn-info" target="_blank"><i class="fa fa-print"></i> Cetak</a>
            <a href="{{ route('ssh.sshexport', 1) }}" class="btn btn-success text-white me-4"><i class="fa-solid fa-file-excel fa-lg"></i> Export</a>
            <button class="btn btn-secondary" type="button" id="uploadStandarHarga" data-bs-toggle="modal" data-bs-target="#uploadStandarHargaModal"><i class="fa-solid fa-upload"></i> Upload</button>
        </div>
    </div>

    <div class="table-responsive mt-4 mb-4">
        <table class="table table-bordered table-hover table-striped datatablesTagBelanja" style="width: 130%">
            <thead class="table-dark align-middle">
                <tr>
                    <th></th>
                    <th>Kategori</th>
                    <th>Uraian</th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Zona 1</th>
                    <th>Zona 2</th>
                    <th>Zona 3</th>
                    <th>kel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($sshs as $ssh)
                    @foreach ($ssh->standarharga as $standarharga)
                        <tr>
                            <td>{{ $ssh->kode_unik_subrincian . ' - ' . $ssh->uraian }}</td>
                            <td>{{ $standarharga->kategori_subrincian }}</td>
                            <td>{{ $standarharga->uraian }}</td>
                            <td>{{ $standarharga->spesifikasi }}</td>
                            <td>{{ $standarharga->satuan }}</td>
                            <td>{{ number_format($standarharga->harga_zona_1, 2, ',', '.') }}</td>
                            <td>{{ number_format($standarharga->harga_zona_2, 2, ',', '.') }}</td>
                            <td>{{ number_format($standarharga->harga_zona_3, 2, ',', '.') }}</td>
                            <td>{{ $standarharga->nama_kelompok }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    @include('standarharga.all.modal-standar-harga.modal-upload-standar-harga')
    {{-- @include('standarharga.all.modal-standar-harga.modal-add-standar-harga')
    @include('standarharga.all.modal-standar-harga.modal-edit-standar-harga')
    @include('standarharga.all.modal-standar-harga.modal-delete-standar-harga') --}}
    @include('script.standarhargascript')
</x-app-layout>
