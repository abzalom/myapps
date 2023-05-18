<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/vendors/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lampiran Perbup Standar Harga Tahun 2023</title>
</head>
<body>
    <div class="ms-5 me-4">
        <table class="mb-3" style="width: 40%">
            <tbody class="m-0 p-0">
                <tr class="m-0 p-0">
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>Peraturan Bupati Mamberamo Raya</td>
                </tr>
                <tr class="m-0 p-0">
                    <td>Nomor</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr class="m-0 p-0">
                    <td>Tanggal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr class="m-0 p-0">
                    <td>Tentang</td>
                    <td>:</td>
                    <td>Standar Satuan Harga Tahun 2023</td>
                </tr>
            </tbody>
        </table>

    
        <div class="row text-center mt-5">
            <h4 style="width: 60%" class="my-0 mx-auto">
                STANDAR HARGA SATUAN YANG BERFUNGSI SEBAGAI BATAS TERTINGGI DALAM PERENCANAAN DAN PELAKSANAAN ANGGARAN PENDAPATAN DAN BELANJA DAERAH KABUPATEN MAMBERAMO RAYA TAHUN ANGGARAN 2023
            </h4>
        </div>
        @foreach ($sshs as $key1 => $item)
            @if (count($item->komponen) !== 0)
                <div class="row mt-5">
                    <div class="col">
                        <h5>
                            {{ $key1+1 . '. '.$item->uraian }}
                        </h5>
                    </div>
                </div>
                <table class="table table-hover table-stripper table-bordered mb-5" style="font-size: 90%; width: 100%">
                    <thead class="align-middle table-dark">
                        {{-- <tr>
                            <th colspan="7">{{ $item->uraian }}</th>
                        </tr> --}}
                        <tr class=" align-middle text-center">
                            <th style="width: 10%">No</th>
                            <th>Kode</th>
                            <th>Rekening</th>
                            <th style="width: 40%">Uraian</th>
                            <th style="width: 10%">Satuan</th>
                            <th style="width: 10%">Zona <br>Rendah <br>(0%)</th>
                            <th style="width: 10%">Zona <br>Sedang <br>(50%)</th>
                            <th style="width: 10%">Zona <br>Tinggi <br>(100%)</th>
                            <th style="width: 10%">Kelompok</th>
                        </tr>
                        {{-- <tr>
                            <th colspan="7">{{ $item->uraian }}</th>
                        </tr> --}}
                    </thead>
                    <tbody class="align-middle">
                            @foreach ($item->komponen as $key2 => $komponen)
                            <tr>
                                <td class="text-center">{{ $key2+1 }}</td>
                                <td>{{ $item->kode_unik_subrincian }}</td>
                                <td>{{ $komponen->rekening_subrincian }}</td>
                                <td>{{ $komponen->uraian }}</td>
                                <td class="text-center">{{ $komponen->satuan }}</td>
                                <td class="text-end">
                                    {{ number_format($komponen->harga, 2, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    @if ($komponen->zonasi)
                                        {{ number_format($komponen->harga * $zonasis[1]->persentasi + $komponen->harga, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if ($komponen->zonasi)
                                        {{ number_format($komponen->harga * $zonasis[2]->persentasi + $komponen->harga, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $item->kategori_ssh }}
                                    @if (!$item->kategori_ssh)
                                        Non Kelompok
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
</body>
</html>