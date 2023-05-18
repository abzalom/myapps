<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="/vendors/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/RowGroup-1.2.0/css/rowGroup.dataTables.min.css"/>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="/vendors/fontawesome/css/all.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2-bootstrap-5-theme.css">
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2-bootstrap-5-theme.rtl.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Akun</th>
                <th>Kelompok</th>
                <th>Jenis</th>
                <th>Objek</th>
                <th>Rincian</th>
                <th>Sub Rincian</th>
                <th>Uraian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekenings as $akun)
                <tr class="fw-bold">
                    <td>{{ $akun->kode_akun }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $akun->uraian }}</td>
                </tr>
                @foreach ($akun->kelompok as $kelompok)
                    <tr class="fw-bold">
                        <td>{{ $kelompok->kode_akun }}</td>
                        <td>{{ $kelompok->kode_kelompok }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $kelompok->uraian }}</td>
                    </tr>
                    @foreach ($kelompok->jenis as $jenis)
                        <tr class="fw-bold">
                            <td>{{ $jenis->kode_akun }}</td>
                            <td>{{ $jenis->kode_kelompok }}</td>
                            <td>{{ $jenis->kode_jenis }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $jenis->uraian }}</td>
                        </tr>
                        @foreach ($jenis->objek as $objek)
                            <tr class="fw-bold">
                                <td>{{ $objek->kode_akun }}</td>
                                <td>{{ $objek->kode_kelompok }}</td>
                                <td>{{ $objek->kode_jenis }}</td>
                                <td>{{ $objek->kode_objek }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $objek->uraian }}</td>
                            </tr>
                            @foreach ($objek->rincian as $rincian)
                                <tr class="fw-bold">
                                    <td>{{ $rincian->kode_akun }}</td>
                                    <td>{{ $rincian->kode_kelompok }}</td>
                                    <td>{{ $rincian->kode_jenis }}</td>
                                    <td>{{ $rincian->kode_objek }}</td>
                                    <td>{{ $rincian->kode_rincian }}</td>
                                    <td></td>
                                    <td>{{ $rincian->uraian }}</td>
                                </tr>
                                @foreach ($rincian->subrincian as $subrincian)
                                    <tr>
                                        <td>{{ $subrincian->kode_akun }}</td>
                                        <td>{{ $subrincian->kode_kelompok }}</td>
                                        <td>{{ $subrincian->kode_jenis }}</td>
                                        <td>{{ $subrincian->kode_objek }}</td>
                                        <td>{{ $subrincian->kode_rincian }}</td>
                                        <td>{{ $subrincian->kode_subrincian }}</td>
                                        <td>{{ $subrincian->uraian }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
@include('script.homescript')
  </body>
</html>