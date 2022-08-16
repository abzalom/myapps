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
            <table class="table table-hover table-stripped table-bordered">
                <thead class="table-dark">
                    <th>KODE</th>
                    <th>PROGRAM</th>
                    <th>KETERANGAN</th>
                </thead>
                <tbody>
                    @foreach ($nomens->bidang as $bidang)
                        @foreach ($bidang->program as $program)
                            <tr>
                                <td>{{ $program->kode_unik_program }}</td>
                                <td>
                                    <a class="text-decoration-none" href="{{ route('nomens.kegiatan', [$program->a1_urusan_id, $program->a2_bidang_id,$program->id]) }}">
                                    {{ $program->uraian }}
                                    </a>
                                </td>
                                <td>{{ $program->keterangan }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('script.homescript')
</x-app-layout>
