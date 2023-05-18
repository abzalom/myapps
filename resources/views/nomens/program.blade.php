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
                <h6>: {{ $nomens->bidang[0]->uraian }}</h6>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="table-responsive">
            <table class="table table-hover table-stripped table-bordered datatables">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>URAIAN</th>
                        <th>KINERJA</th>
                        <th>INDIKATOR</th>
                        <th>SATUAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fw-bold">
                        <td>{{ $nomens->kode_urusan }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $nomens->uraian }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($nomens->bidang as $bidang)
                        <tr class="fw-bold">
                            <td>{{ $nomens->kode_urusan }}</td>
                            <td>{{ $bidang->kode_bidang }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $bidang->uraian }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($bidang->program as $program)
                            <tr class="fw-bold">
                                <td>{{ $program->kode_urusan }}</td>
                                <td>{{ $program->kode_bidang }}</td>
                                <td>{{ $program->kode_program }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a class="text-decoration-none" href="{{ route('nomens.kegiatan', [$program->a1_urusan_id, $program->a2_bidang_id,$program->id]) }}">
                                        {{ $program->uraian }}
                                    </a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach ($program->kegiatan as $kegiatan)
                                <tr class="fw-bold">
                                    <td>{{ $kegiatan->kode_urusan }}</td>
                                    <td>{{ $kegiatan->kode_bidang }}</td>
                                    <td>{{ $kegiatan->kode_program }}</td>
                                    <td>{{ $kegiatan->kode_kegiatan }}</td>
                                    <td></td>
                                    <td>
                                        {{ $kegiatan->uraian }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($kegiatan->subkegiatan as $subkegiatan)
                                    <tr>
                                        <td>{{ $subkegiatan->kode_urusan }}</td>
                                        <td>{{ $subkegiatan->kode_bidang }}</td>
                                        <td>{{ $subkegiatan->kode_program }}</td>
                                        <td>{{ $subkegiatan->kode_kegiatan }}</td>
                                        <td>{{ $subkegiatan->kode_subkegiatan }}</td>
                                        <td>
                                            {{ $subkegiatan->uraian }}
                                        </td>
                                        <td>{{ $subkegiatan->kinerja }}</td>
                                        <td>{{ $subkegiatan->indikator }}</td>
                                        <td>{{ $subkegiatan->satuan }}</td>
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