<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/vendors/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SSH 2022</title>
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
                    <td>Standar Satuan Harga Tahun 2022</td>
                </tr>
            </tbody>
        </table>

    
        <div class="row text-center mt-5">
            <h4 style="width: 60%" class="my-0 mx-auto">
                STANDAR HARGA SATUAN YANG BERFUNGSI SEBAGAI BATAS TERTINGGI DALAM PERENCANAAN DAN PELAKSANAAN ANGGARAN PENDAPATAN DAN BELANJA DAERAH KABUPATEN MAMBERAMO RAYA
            </h4>
        </div>
        @foreach ($sshs as $key1 => $item)
        <div class="row mt-5">
            <div class="col">
                <h5>
                    {{ $key1+1 . '. '.$item->uraian }}
                </h5>
            </div>
        </div>
        <table class="table table-hover table-stripper table-bordered mb-5">
            <thead class="align-middle table-dark">
                {{-- <tr>
                    <th colspan="7">{{ $item->uraian }}</th>
                </tr> --}}
                <tr>
                    <th style="width: 10%">No</th>
                    <th>Kode</th>
                    <th>Rekening</th>
                    <th style="width: 60%">Uraian</th>
                    <th style="width: 10%">Satuan</th>
                    <th style="width: 30%">Besaran</th>
                    <th style="width: 10%">Kelompok</th>
                </tr>
                {{-- <tr>
                    <th colspan="7">{{ $item->uraian }}</th>
                </tr> --}}
            </thead>
            <tbody class="align-middle">
                    @foreach ($item->sshsikd2022 as $key2 => $sshsikd)
                    <tr>
                        <td class="text-center">{{ $key2+1 }}</td>
                        <td>{{ $item->kode_unik_subrincian }}</td>
                        <td>{{ $sshsikd->rekening_subrincian }}</td>
                        <td>{{ $sshsikd->uraian }}</td>
                        <td class="text-center">{{ $sshsikd->satuan }}</td>
                        <td class="text-end">{{ number_format($sshsikd->harga, 2, ',', '.') }}</td>
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
        @endforeach
    </div>
</body>
</html>