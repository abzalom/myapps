<x-app-layout title="{{ $title }}">
    <div class="row mb-4 mt-4">
        <h5>{{ $desc }}</h5>
    </div>

    {{-- @dump($rekenings->toArray()) --}}

    @if (session()->has('pesan'))
        <div class="row mt-4 mb-4">
            <div class="alert alert-info">
                {{ session()->get('pesan') }}
            </div>
        </div>
    @endif

    @php
        $inforek = '';
    @endphp

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="get">
                    <div class="row" id="belanjaTableSeacrhRow">
                        <div class="col-6">
                            <select name="subrincian" class="form-select" id="belanjaTableSeacrh" aria-label="Default select example">
                                <option selected value="">--Pilih Rekening Rincian--</option>
                                @foreach ($rincians as $rincian)
                                    @php
                                        if ($kode == $rincian->kode_unik_rincian) {
                                            $inforek = $rincian->kode_unik_rincian . ' - ' . $rincian->uraian;
                                        }
                                    @endphp
                                    <option value="{{ $rincian->kode_unik_rincian }}" {{ $kode == $rincian->kode_unik_rincian ? 'selected' : '' }}>{{ $rincian->kode_unik_rincian . ' - ' . $rincian->uraian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" value="{{ $inforek }}" readonly>
                        </div>
                    </div>
                    <form action="{{ route('neraca.autotagging.rekeningbelanja') }}" method="post">
                        @csrf
                        <div class="col-sm-3">
                            <input type="hidden" name="kode_belanja" value="{{ $kode }}">
                            <select name="rekening" class="form-select mb-2 @error('rekening') is-invalid @enderror">
                                <option value="">Pilih Rekening</option>
                                <option value="neraca">Neraca</option>
                                <option value="lo">LO</option>
                            </select>
                            <input type="text" name="kode_kategori" class="form-control mb-2 @error('kode_kategori') is-invalid @enderror" value="{{ old('kode_kategori') }}" placeholder="kode rincian kategori" autocomplete="off">
                            <button type="submit" class="btn btn-warning">Auto Tagging</button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-striped datatablesTagBelanja" style="width: 100%">
                        <thead class="table-dark">
                            <tr>
                                <th>Kode Belanja / Uraian</th>
                                <th>Kode</th>
                                <th>Uraian</th>
                                <th>Kelompok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekenings as $rek)
                                @if ($rek->kategori->count())
                                    @foreach ($rek->kategori as $kategori)
                                        <tr id="{{ $rek->kode_unik_subrincian }}">
                                            <td style="width:15%; text-align:center">
                                                <a href="#copy-kode" title="copy kode" onclick="copyToClipboard('kode_{{ $rek->id }}')"><i class="fas fa-copy fa-lg"></i></a> <span id="kode_{{ $rek->id }}">{{ $rek->kode_unik_subrincian }}</span> - <a href="#copy-uraian" title="copy uraian" onclick="copyToClipboard('uraian_{{ $rek->id }}')"> <i class="fas fa-copy fa-lg"></i></a>
                                                <span id="uraian_{{ $rek->id }}">{{ $rek->uraian }}</span>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-primary btn-sm btn-add-kode" value="{{ $rek->kode_unik_subrincian }}" data-uraian="{{ $rek->kode_unik_subrincian . ' - ' . $rek->uraian }}" data-bs-toggle="modal" data-bs-target="#katRekModal"><i class="fa fa-edit"></i></button>
                                                </div>
                                            </td>
                                            <td style="width:15%; text-align:center">{{ $kategori->kode_kategori }}</td>
                                            <td style="width:30%;">{{ $kategori->kategori_uraian }}</td>
                                            <td style="width:5%; text-align:center">{{ $kategori->kategori_ssh }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr id="{{ $rek->kode_unik_subrincian }}">
                                        <td style="width:15%; text-align:center">
                                            {{ $rek->kode_unik_subrincian }} - {{ $rek->uraian }}
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary btn-sm btn-add-kode" value="{{ $rek->kode_unik_subrincian }}" data-uraian="{{ $rek->kode_unik_subrincian . ' - ' . $rek->uraian }}" data-bs-toggle="modal" data-bs-target="#katRekModal"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </td>
                                        <td style="width:15%; text-align:center"></td>
                                        <td style="width:30%;"></td>
                                        <td style="width:15%; text-align:center"></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('rekening.modal.add-kategori-modal')
    @include('script.neracascript')
</x-app-layout>
