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
        <div class="col-6 mb-5">
            @php
                $no = 1;
            @endphp
            <span class="fw-bold">Lokasi</span>
            <form action="{{ route('datadukung.storelokasi') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="lokasi-addon">Nama lokasi</span>
                    <input type="text" name="lokasi" class="form-control" placeholder="Input lokasi baru" aria-label="Lokasi" aria-describedby="lokasi-addon" autocomplete="off">
                    <button class="btn btn-outline-primary"><i class="fa fa-solid fa-floppy-disk fa-lg"></i></button>
                </div>
            </form>
            <table class="table table-bordered table-hover table-striped table-dukungan">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Uraian</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lokasis as $lokasi)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $lokasi->lokasi }}</td>
                            <td>
                                <a href="{{ route('datadukung.deletelokasi', $lokasi->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6 mb-5">
            @php
                $no = 1;
            @endphp
            <span class="fw-bold">Penerima Manfaat</span>
            <form action="{{ route('datadukung.storepenerimamanfaat') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="penerima-manfaat-addon">Penerima Manfaat</span>
                    <input type="text" name="uraian" class="form-control" placeholder="Input penerima manfaat baru" aria-label="penerima-manfaat" aria-describedby="penerima-manfaat-addon" autocomplete="off">
                    <button class="btn btn-outline-primary"><i class="fa fa-solid fa-floppy-disk fa-lg"></i></button>
                </div>
            </form>
            <table class="table table-bordered table-hover table-striped table-dukungan">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Uraian</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sasarans as $sasaran)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $sasaran->uraian }}</td>
                            <td>
                                <a href="{{ route('datadukung.deletepenerimamanfaat', $sasaran->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6 mb-5">
            @php
                $no = 1;
            @endphp
            <span class="fw-bold">Klasifikasi Anggaran</span>
            <form action="{{ route('datadukung.storeklasifikasi') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="klasifikasi-addon">Penerima Manfaat</span>
                    <input type="text" name="uraian" class="form-control" placeholder="Input klasifikasi anggaran baru" aria-label="penerima-manfaat" aria-describedby="klasifikasi-addon" autocomplete="off">
                    <button class="btn btn-outline-primary"><i class="fa fa-solid fa-floppy-disk fa-lg"></i></button>
                </div>
            </form>
            <table class="table table-bordered table-hover table-striped table-dukungan">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Uraian</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($klasifikasis as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->uraian }}</td>
                            <td>
                                <a href="{{ route('datadukung.deleteklasifikasi', $data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('script.pendukungscript')

</x-app-layout>
