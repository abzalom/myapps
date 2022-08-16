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

    <script>
        function firtWords (str) {
            // return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
            return (str + '').replace(/^\d+(\.\d+)?$/, function ($1) {
                return $1.toUpperCase();
            });
        }
        function numberFormat(val) {
            // remove sign if negative
            var sign = 1;
            if (val < 0) {
                sign = -1;
                val = -val;
            }
            // trim the number decimal point if it exists
            let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                result = '.' + result;
                }
                count++;
            }

            // add number after decimal point
            if (val.toString().includes('.')) {
                result = result + ',' + val.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : result;
        }
    </script>

    <title>{{ $title }}</title>

    </head>
    <body class="d-flex flex-column h-100">
        <div id="loadingpage" class="container mx-auto my-0 text-center">
            <div class="spinner-border text-primary" style="height: 10rem; width:10rem; margin-top:10rem;" role="status">
                <h1 class="visually-hidden">Loading...</h1>
            </div>
        </div>

        <div id="pagecontent" style="display: none">

            <x-navbar>

            </x-navbar>
            <!-- Begin page content -->
            <main class="flex-shrink-0">
                <div class="container mb-5">
                    {{ $slot }}
                </div>
            </main>
        </div>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="/vendors/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/vendors/datatables/datatables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('.datatables').DataTable();
            });
        </script>
    </body>
</html>
