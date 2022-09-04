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

    <div class="row mb-4 mt-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark align-middle">
                    <tr>
                        <th>Kode</th>
                        <th>Uraian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bidangs as $bidang)
                        <tr>
                            <td>{{ $bidang->kode_unik_bidang }}</td>
                            <td>{{ $bidang->uraian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@include('script.homescript')
</x-app-layout>
