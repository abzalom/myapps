<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        @page {
            size: legal landscape;
        }

        #kop-lampiran tr td {
            padding: 1px !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row mb-3">
            <table class="table table-sm table-borderless" id="kop-lampiran">
                <tr>
                    <td style="width: 10%">Lampiran</td>
                    <td style="width: 1%">:</td>
                    <td>Peraturan Bupati Mamberamo Raya</td>
                </tr>
                <tr>
                    <td style="width: 10%">Nomor</td>
                    <td style="width: 1%">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width: 10%">Tanggal</td>
                    <td style="width: 1%">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width: 10%">Tentang</td>
                    <td style="width: 1%">:</td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="row mb-4">
            <h5 class="col-8 mx-auto text-center mb-5">{{ $desc }}</h5>
        </div>

        @foreach ($kategoris as $kategori)
            <div class="row">
                <h5>{{ $no++ }}. {{ str($kategori->uraian)->title() }}</h5>
                <table class="table table-bordered table-stripped" style="font-size: 14px">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>Kode</th>
                            <th>Rekening</th>
                            <th>Uraian</th>
                            <th>Spesifikasi</th>
                            <th>Satuan</th>
                            <th>Zona 1</th>
                            <th>Zona 2</th>
                            <th>Zona 3</th>
                            <th>Kelompok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori->standarharga as $ssh)
                            <tr>
                                <td>{{ $ssh->kategori_subrincian }}</td>
                                <td>{{ $ssh->rekening_subrincian }}</td>
                                <td>{{ $ssh->uraian }}</td>
                                <td>{{ $ssh->spesifikasi }}</td>
                                <td>{{ $ssh->satuan }}</td>
                                <td>{{ number_format($ssh->harga_zona_1, 2, ',', '.') }}</td>
                                <td>{{ number_format($ssh->harga_zona_2, 2, ',', '.') }}</td>
                                <td>{{ number_format($ssh->harga_zona_3, 2, ',', '.') }}</td>
                                <td>{{ $ssh->nama_kelompok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach


        {{-- <div class="row mt-4 float-end text-bold">
            <div class="col-12 text-center">
                <strong>Burmeso, {{ now()->format('d M Y') }}</strong>
                <br>
                <strong>Bupati Mamberamo Raya</strong>
                <br>
                <br>
                <br>
                <strong>JOHN TABO</strong>
            </div>
        </div> --}}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
