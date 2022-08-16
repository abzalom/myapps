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

    {{-- @dump($histories->toArray()) --}}

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle datatables" style="width: 180%">
            <thead class="table-dark">
                <tr>
                    <th style="width: 180px">Tanggal</th>
                    <th style="width: 300px">OPD</th>
                    <th style="width: 280px">Rekening</th>
                    <th style="width: 280px">Komponen Rekening</th>
                    <th style="width: 200px">Anggaran (Rp.)</th>
                    <th style="width: 280px">Keterangan</th>
                    <th style="width: 280px">Peruntukan</th>
                    <th style="width: 150px">Status Pagu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history)
                    <tr>
                        <td>{{ $history->created_at }}</td>
                        <td class="text-uppercase">{{ $history->opd->nama_perangkat }}</td>
                        <td>{{ $history->subrekening }}</td>
                        <td>{{ $history->sumber }}</td>
                        <td>{{ number_format($history->pagu, 2, ',', '.') }}</td>
                        <td>{{ $history->keterangan }}</td>
                        <td>{{ $history->peruntukan }}</td>
                        <td>{{ $history->status->uraian }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script src="/js/jquery.min.js"></script>

{{-- <script type="text/javascript" src="/vendors/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="/vendors/datatables/pdfmake-0.1.36/vfs_fonts.js"></script> --}}
<script src="/vendors/datatables/DataTables-1.12.0/js/jquery.dataTables.min.js"></script>
<script src="/vendors/datatables/datatables.min.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.0/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.js"></script> --}}

<script src="/vendors/fontawesome/js/all.js"></script>
<script src="/vendors/fontawesome/js/regular.js"></script>
<script src="/vendors/select2/dist/js/select2.full.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="/vendors/bootstrapselect2/dist/js/bootstrap-select.min.js"></script>
<script>
    $(window).on('load', function () {
    $('#loadingpage').delay(400).fadeOut(400, function () {
        $('#pagecontent').fadeIn(0);
    });
})
</script>

</x-app-layout>
