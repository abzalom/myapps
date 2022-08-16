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
        <ul class="list-group list-group-flush">
            @foreach ($akuns as $akun)
                <li class="list-group-item">
                    <div class="row align-items-center mb-2">
                        <div class="col-1" style="width: 7%">
                            <button class="btn btn-primary btn-sm akun" type="button" value="{{ $akun->id }}" data-bs-toggle="collapse" data-bs-target="#akun{{ $akun->id }}" aria-expanded="false" aria-controls="akun{{ $akun->id }}"><i class="fa-solid fa-plus-square fa-lg"></i></button>
                        </div>
                        <div class="col-11">
                            <div class="row">
                                <div class="col-12">
                                    {{ $akun->kode_unik_akun }} - {{ $akun->uraian }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="akun{{ $akun->id }}">
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

@include('script.loscript')
</x-app-layout>
