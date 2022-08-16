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
            <div class="table-responsive">
                <table class="table table-hover table-stripped table-bordered">
                    <thead class="table-dark">
                        <th>KODE</th>
                        <th>URUSAN PEMERINTAHAN</th>
                        <th>KETERANGAN</th>
                    </thead>
                    <tbody>
                        @foreach ($nomens as $urusan)
                            <tr>
                                <td>{{ $urusan->kode_unik_urusan }}</td>
                                <td>
                                    <a class="text-decoration-none" href="{{ route('nomens.bidang', $urusan->id) }}">
                                    {{ $urusan->uraian }}
                                    </a>
                                </td>
                                <td>{{ $urusan->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @include('script.homescript')
</x-app-layout>
