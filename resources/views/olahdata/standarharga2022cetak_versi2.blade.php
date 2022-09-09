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
    <header>Test</header>
    <table class="table table-hover table-stripper table-bordered mb-5">
            @foreach ($sshs as $key1 => $item)
                {{-- <thead class="align-middle table-dark">
                    <tr>
                        <th></th>
                        <th style="width: 10%">No</th>
                        <th>Kode</th>
                        <th>Rekening</th>
                        <th style="width: 60%">Uraian</th>
                        <th style="width: 10%">Satuan</th>
                        <th style="width: 30%">Besaran</th>
                        <th style="width: 10%">Kelompok</th>
                    </tr>
                </thead> --}}
                <tbody class="align-middle">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="4">{{ $key1+1 }}. {{ $item->uraian }}</td>
                        {{-- <td>{{ $key1+1 }}. {{ $item->uraian }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> --}}
                        <td>{{ $key1+1 }}</td>
                    </tr>
                    <tr>
                        {{-- <td></td> --}}
                        <td>NO</td>
                        <td>KODE</td>
                        <td>REKENING</td>
                        <td>URAIAN</td>
                        <td>SATUAN</td>
                        <td>BESARAN</td>
                        <td>KELOMPOK</td>
                        <td>{{ $key1+1 }}</td>
                    </tr>

                    @foreach ($item->sshsikd2022 as $key2 => $sshsikd)
                        <tr>
                            {{-- <td></td> --}}
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
                            <td>{{ $key1+1 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
</body>
</html>