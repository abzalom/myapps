{{-- <x-app-layout title="{{ $title }}">
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

        <div class="row mt-4 mb-4"> --}}
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>a6_program_rutin_id</th>
                        <th>a7_kegiatan_rutin_id</th>
                        <th>a8_subkegiatan_rutin_id</th>
                        <th>kode_program</th>
                        <th>kode_kegiatan</th>
                        <th>kode_subkegiatan</th>
                        <th>kode_unik_program</th>
                        <th>kode_unik_kegiatan</th>
                        <th>kode_unik_subkegiatan</th>
                        <th>uraian</th>
                        <th>kinerja</th>
                        <th>indikator</th>
                        <th>satuan</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rutins as $program)
                        <tr>
                            <td>{{ $program->id }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $program->kode_program }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $program->kode_unik_program }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $program->uraian }}</td>
                            <td>{{ $program->kinerja }}</td>
                            <td>{{ $program->indikator }}</td>
                            <td>{{ $program->satuan }}</td>
                            <td>{{ $program->keterangan }}</td>
                        </tr>
                        @foreach ($program->kegiatanrutin as $kegiatan)
                            <tr>
                                <td>{{ $program->id }}</td>
                                <td>{{ $kegiatan->id }}</td>
                                <td></td>
                                <td>{{ $program->kode_program }}</td>
                                <td>{{ $kegiatan->kode_kegiatan }}</td>
                                <td></td>
                                <td>{{ $kegiatan->kode_unik_program }}</td>
                                <td>{{ $kegiatan->kode_unik_kegiatan }}</td>
                                <td></td>
                                <td>{{ $kegiatan->uraian }}</td>
                                <td>{{ $kegiatan->kinerja }}</td>
                                <td>{{ $kegiatan->indikator }}</td>
                                <td>{{ $kegiatan->satuan }}</td>
                                <td>{{ $kegiatan->keterangan }}</td>                            </tr>
                            @foreach ($kegiatan->subkegiatanrutin as $subkegiatan)
                                <tr>
                                    <td>{{ $program->id }}</td>
                                    <td>{{ $kegiatan->id }}</td>
                                    <td>{{ $subkegiatan->id }}</td>
                                    <td>{{ $program->kode_program }}</td>
                                    <td>{{ $kegiatan->kode_kegiatan }}</td>
                                    <td>{{ $subkegiatan->kode_subkegiatan }}</td>
                                    <td>{{ $kegiatan->kode_unik_program }}</td>
                                    <td>{{ $kegiatan->kode_unik_kegiatan }}</td>
                                    <td>{{ $subkegiatan->kode_unik_subkegiatan }}</td>
                                    <td>{{ $subkegiatan->uraian }}</td>
                                    <td>{{ $subkegiatan->kinerja }}</td>
                                    <td>{{ $subkegiatan->indikator }}</td>
                                    <td>{{ $subkegiatan->satuan }}</td>
                                    <td>{{ $subkegiatan->keterangan }}</td>                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        {{-- </div>
    @include('script.homescript')
</x-app-layout> --}}
