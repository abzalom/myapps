<!-- Modal -->
<div class="modal fade" id="arsipRkaModal" tabindex="-1" aria-labelledby="arsipRkaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="arsipRkaModalLabel">Komponen yang dihapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <thead>
                        <th>Rek</th>
                        <th>uraian</th>
                        <th>Harga</th>
                        <th>Vol</th>
                        <th>Pajak</th>
                        <th>Jumlah</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($arsip as $item)
                            @php
                                $jumlah = $item->harga * $item->volume;
                                $pajak = 0;
                                if($item->pajak == true){
                                    $pajak += $jumlah * 0.1;
                                }
                            @endphp
                            <tr>
                                <td>{{ $item->rekening->kode_unik_subrincian }}</td>
                                <td>{{ $item->uraian }}<br>{{ $item->id }}</td>
                                <td>{{ number_format($item->harga,2,',','.') }} / {{ $item->satuan }}</td>
                                <td>{{ number_format($item->volume,2,',','.') }} {{ $item->satuan }}</td>
                                <td>{{ number_format($pajak,2,',','.') }}</td>
                                <td>{{ number_format($pajak + $jumlah,2,',','.') }}</td>
                                <td>
                                    <a href="{{ route('rkarutin.rkarutinrestore', encrypt($item->id)) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-recycle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>