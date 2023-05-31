<!-- Modal -->
<div class="modal fade" id="editSshModal" tabindex="-1" aria-labelledby="editSshModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSshModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('standarharga.update') }}" method="post">
                <div class="modal-body">
                    <div id="editSshLoading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="editSshShow" style="display:none">
                        @csrf
                        <input type="hidden" name="id" id="idkomponen">
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="kategoriEdit" class="form-label">Kategori</label>
                                <select name="kategori" class="form-select" id="kategoriEdit" data-placeholder="Pilih kategori">
                                </select>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="rekeningEdit" class="form-label">Rekening</label>
                                <select name="rekening" class="form-select" id="rekeningEdit" data-placeholder="Pilih Rekening">
                                </select>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="uraianEdit" class="form-label">Uraian</label>
                                <input name="uraian" type="text" class="form-control" id="uraianEdit" placeholder="Uraian">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="spekEdit" class="form-label">Spesifikasi</label>
                                <input name="spesifikasi" type="text" class="form-control" id="spekEdit" placeholder="Spesifikasi">
                            </div>
                            <div class="mb-3 col-sm-3">
                                <label for="satuanEdit" class="form-label">Satuan</label>
                                <input name="satuan" type="text" class="form-control" id="satuanEdit" placeholder="Satuan">
                            </div>
                            <div class="mb-3 col-sm-3">
                                <label for="zona1Edit" class="form-label">Harga Zona 1</label>
                                <input name="harga_zona_1" type="text" class="form-control" id="zona1Edit" placeholder="Harga Zona 1">
                            </div>
                            <div class="mb-3 col-sm-3">
                                <label for="zona2Edit" class="form-label">Harga Zona 2</label>
                                <input name="harga_zona_2" type="text" class="form-control" id="zona2Edit" placeholder="Harga Zona 2">
                            </div>
                            <div class="mb-3 col-sm-3">
                                <label for="zona3Edit" class="form-label">Harga Zona 3</label>
                                <input name="harga_zona_3" type="text" class="form-control" id="zona3Edit" placeholder="Harga Zona 3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
