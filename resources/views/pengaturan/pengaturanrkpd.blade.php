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

    <div class="row">
        <div class="col-3">
            <form action="{{ route('pengaturan.tahapanlock') }}" class="mb-3" method="post">
                @csrf
                <button class="btn btn-sm btn-danger"><i class="fa fa-solid fa-lock fa-lg"></i></button> Kunci semua tahapan
            </form>
            <strong>Tahapan RKPD</strong>
            <table class="table table-bordered table-hove table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tahapan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($tahapans as $tahapan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                {{ $tahapan->uraian }}
                            </td>
                            <td>
                                @if ($tahapan->is_active == false)
                                <form action="{{ route('pengaturan.tahapan') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $tahapan->id }}">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-solid fa-lock fa-lg"></i> Aktifkan</button>
                                </form>
                                @else
                                <span class="badge bg-success badge-pill">
                                    <i class="fa fa-solid fa-unlock fa-lg"></i>
                                    Aktiv
                                </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tahun Anggaran --}}
        <div class="col-3">
                <br>
                <br>
            <strong>Tahun Anggaran</strong>
            <div class=" table-responsive-sm">
                <table class="table table-bordered table-hove table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th colspan="2">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($tahuns as $tahun)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    Tahun Anggaran {{ $tahun->tahun }}
                                </td>
                                <td>
                                    @if ($tahun->is_active == false)
                                    <a href="{{ route('pengaturan.tahun', $tahun->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-solid fa-check-circle"></i></a>
                                    @else
                                    Aktif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
<script>
    $(window).on('load', function () {
    $('#loadingpage').delay(400).fadeOut(400, function () {
        $('#pagecontent').fadeIn(400);
    });
})
</script>


</x-app-layout>
