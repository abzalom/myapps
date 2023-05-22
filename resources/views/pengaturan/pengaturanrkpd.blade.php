<x-app-layout title="{{ $title }}">
    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
        <span>Tahun aktif : {{ $tahuns->where('is_active', true)->first()->tahun }}</span>
    </div>

    @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            <div class="alert alert-info">
                {{ session()->get('pesan') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="row mt-4 mb-4">
            <div class="alert alert-info">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header row">
                    <h5 class="col-sm-8">
                        Tahapan RKPD
                    </h5>
                    <div class="col-sm-4 text-end">
                        <form action="{{ route('pengaturan.tahapanlock') }}" method="post">
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="fa fa-solid fa-lock fa-lg"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">

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
            </div>
        </div>

        {{-- Tahun Anggaran --}}
        <div class="col-4">
            <div class="card">
                <div class="card-header row">
                    <h5 class="col-sm-8">Tahun Anggaran</h5>
                    <div class="col-sm-4 text-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tahunAnggaranModal">
                            <i class="fas fa-plus-square fa-lg"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
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
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script>
        $(window).on('load', function() {
            $('#loadingpage').delay(400).fadeOut(400, function() {
                $('#pagecontent').fadeIn(400);
            });
        })
    </script>

    @include('pengaturan.modal.add-tahun-modal')

</x-app-layout>
