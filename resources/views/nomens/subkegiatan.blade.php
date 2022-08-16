{{-- @dd($nomens->toArray()) --}}
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

    <div class="mt-4 mb-4">
        <div class="row">
            <div class="col-1">
                <h6>{{ $nomens->kode_unik_urusan }}</h6>
            </div>
            <div class="col-11">
                <h6>:
                    <a href="{{ route('nomens.bidang', [$nomens->id]) }}" class="text-decoration-none">
                        {{ $nomens->uraian }}
                    </a>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <h6>{{ $nomens->bidang[0]->kode_unik_bidang }}</h6>
            </div>
            <div class="col-11">
                <h6>:
                    <a href="{{ route('nomens.program', [$nomens->id, $nomens->bidang[0]->id]) }}" class="text-decoration-none">
                        {{ $nomens->bidang[0]->uraian }}
                    </a>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <h6>{{ $nomens->bidang[0]->program[0]->kode_unik_program }}</h6>
            </div>
            <div class="col-11">
                <h6>:
                    <a href="{{ route('nomens.kegiatan', [$nomens->id, $nomens->bidang[0]->id, $nomens->bidang[0]->program[0]->id]) }}" class="text-decoration-none">
                        {{ $nomens->bidang[0]->program[0]->uraian }}
                    </a>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-1">
                <h6>{{ $nomens->bidang[0]->program[0]->kegiatan[0]->kode_unik_kegiatan }}</h6>
            </div>
            <div class="col-11">
                <h6>: {{ $nomens->bidang[0]->program[0]->kegiatan[0]->uraian }}</h6>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="table-responsive">
            <table class="table table-hover table-stripped table-bordered">
                <thead class="table-dark">
                    <th>KODE</th>
                    <th>SUB KEGIATAN</th>
                    <th>KINERJA</th>
                    <th>INDIKATOR</th>
                    <th>SATUAN</th>
                    <th>KETERANGAN</th>
                </thead>
                <tbody>
                    @foreach ($nomens->bidang as $bidang)
                        @foreach ($bidang->program as $program)
                            @foreach ($program->kegiatan as $kegiatan)
                                @foreach ($kegiatan->subkegiatan as $subkegiatan)
                                    <tr>
                                        <td>{{ $subkegiatan->kode_unik_subkegiatan }}</td>
                                        <td>{{ $subkegiatan->uraian }}</td>
                                        <td>{{ $subkegiatan->kinerja }}</td>
                                        <td>{{ $subkegiatan->indikator }}</td>
                                        <td>{{ $subkegiatan->satuan }}</td>
                                        <td>{{ $subkegiatan->keterangan }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('script.homescript')
</x-app-layout>
