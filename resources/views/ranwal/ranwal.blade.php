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

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped datatables" style="width: 120%">
            <thead class="table-dark align-middle text-nowrap">
                <tr>
                    <th scope="col" rowspan="2">Kode</th>
                    <th scope="col" rowspan="2">OPD</th>
                    <th scope="col" colspan="6">Jumlah</th>
                </tr>
                <tr>
                    <th>Program</th>
                    <th>Kegiatan</th>
                    <th>Sub Kegiatan</th>
                    <th>Anggaran Renja</th>
                    <th>Pagu OPD</th>
                    <th>Selisih</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($opds as $opd)
                @php
                    $jumlahranwal = $opd->subrincianranwal_sum_anggaran + $opd->subrincianrutinranwal_sum_anggaran;
                @endphp
                <tr class="tr-hover">
                    <td scope="row" class="text-center">{{ $opd->kode_perangkat }}</td>
                    <td style="width: 40%">
                        <a href="{{ route('ranwal.ranwalopd', $opd->id) }}" class=" text-decoration-none text-dark">
                            {{ strtoupper($opd->nama_perangkat) }}
                        </a>
                    </td>
                    <td class="text-center">
                        @foreach ($ranwals as $key => $ranwal)
                            @foreach ($ranwalrutins as $keyrutin => $ranwalrutin)
                                @if ($opd->id == $key)
                                    @if ($opd->id == $keyrutin)
                                        {{ count($ranwal['program']) + count($ranwalrutin['program']) }}
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($ranwals as $key => $ranwal)
                            @foreach ($ranwalrutins as $keyrutin => $ranwalrutin)
                                @if ($opd->id == $key)
                                    @if ($opd->id == $keyrutin)
                                        {{ count($ranwal['kegiatan']) + count($ranwalrutin['kegiatan']) }}
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($ranwals as $key => $ranwal)
                            @foreach ($ranwalrutins as $keyrutin => $ranwalrutin)
                                @if ($opd->id == $key)
                                    @if ($opd->id == $keyrutin)
                                        {{ count($ranwal['subkegiatan']) + count($ranwalrutin['subkegiatan']) }}
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td class="text-nowrap" style="width: 17%">
                        <div class="row">
                            <div class="col-2 text-start">
                                Rp.
                            </div>
                            <div class="col-10 text-end">
                                {{ number_format($jumlahranwal, 2, ',', '.') }}
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap" style="width: 17%">
                        <div class="row">
                            <div class="col-2 text-start">
                                Rp.
                            </div>
                            <div class="col-10 text-end">
                                {{ number_format($opd->paguopdranwal_sum_pagu, 2, ',', '.') }}
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap" style="width: 17%">
                        <div class="row">
                            <div class="col-2 text-start">
                                Rp.
                            </div>
                            <div class="col-10 text-end">
                                {{ number_format($opd->paguopdranwal_sum_pagu - $jumlahranwal, 2, ',', '.') }}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@include('script.renjascript')
</x-app-layout>
