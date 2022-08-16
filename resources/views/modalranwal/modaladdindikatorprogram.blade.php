<!-- Modal -->
<div class="modal fade" id="addIndikatorProgamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addIndikatorProgamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addIndikatorProgamModalLabel">Sasaran Program</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('ranwal.indikatorprogramstore') }}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="f1_perangkat_id" id="idopd" value="{{ $opd->id }}">
                <input type="hidden" name="a3_program_id" id="idprog">
                <input type="hidden" name="kode_unik_program" id="kodeprog">
                <input type="hidden" name="idindikator" id="idindikator">
                <div class="mb-3">
                    <label for="sasaran" class="form-label">Sasaran Program</label>
                    <textarea class="form-control" name="sasaran" id="sasaran" rows="2" placeholder="Apa yang menjadi sasaran dari program ini?"></textarea>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="capaian" class="form-label">Capaian Program</label>
                    <textarea class="form-control" name="capaian" id="capaian" rows="2" placeholder="Apa yang akan dicapai dari program ini?"></textarea>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="target" class="form-label">Target Capaian</label>
                            <input type="text" class="form-control" name="target" id="target" placeholder="Target?" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan?" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
