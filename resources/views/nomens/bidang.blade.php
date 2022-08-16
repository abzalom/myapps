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

    <div class="row mt-4 mb-4">
        <div class="col-1 m-0">
            <h6>{{ $nomens->kode_unik_urusan }}</h6>
        </div>
        <div class="col-11">
            <h6>: {{ $nomens->uraian }}</h6>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="table-responsive">
            <table class="table table-hover table-stripped table-bordered">
                <thead class="table-dark">
                    <th>KODE</th>
                    <th>BIDANG URUSAN PEMERINTAHAN</th>
                    <th>KETERANGAN</th>
                </thead>
                <tbody>
                    @foreach ($nomens->bidang as $bidang)
                        <tr>
                            <td>{{ $bidang->kode_unik_bidang }}</td>
                            <td>
                                <a class="text-decoration-none" href="{{ route('nomens.program', [$bidang->a1_urusan_id, $bidang->id]) }}">
                                {{ $bidang->uraian }}
                                </a>
                            </td>
                            <td>{{ $bidang->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('script.homescript')
</x-app-layout>
