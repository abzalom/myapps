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
            <div class="col-4">
                <form action="{{ route('rutin.subkegiatanimport') }}" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        @csrf
                        <input type="file" name="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Uraian</th>
                        <th>Kinerja</th>
                        <th>Indikator</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rutins->kegiatanrutin as $kegiatan)
                        <tr class="fw-bold">
                            <td>X.XX.{{ $kegiatan->kode_unik_kegiatan }}</td>
                            <td>{{ $kegiatan->uraian }}</td>
                            <td>{{ $kegiatan->kinerja }}</td>
                            <td>{{ $kegiatan->indikator }}</td>
                            <td>{{ $kegiatan->satuan }}</td>
                        </tr>
                        @if ($kegiatan->keterangan !== null)
                        <tr class="fst-italic">
                            <td></td>
                            <td>{{ $kegiatan->keterangan }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                        @foreach ($kegiatan->subkegiatanrutin as $subkegiatan)
                            <tr>
                                <td>X.XX.{{ $subkegiatan->kode_unik_subkegiatan }}</td>
                                <td>{{ $subkegiatan->uraian }}</td>
                                <td>{{ $subkegiatan->kinerja }}</td>
                                <td>{{ $subkegiatan->indikator }}</td>
                                <td>{{ $subkegiatan->satuan }}</td>
                            </tr>
                            @if ($subkegiatan->keterangan !== null)
                            <tr class="fst-italic">
                                <td></td>
                                <td>{{ $subkegiatan->keterangan }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @include('script.homescript')
</x-app-layout>
