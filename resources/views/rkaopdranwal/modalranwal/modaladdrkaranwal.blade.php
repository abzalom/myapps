<!-- Modal -->
<div class="modal fade" id="addRkaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addRkaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="addRkaModalLabel">Form RKA : {{ $opd->rkaranwal->subrincianrka->rincian }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rkaranwal.rkaranwalstore') }}" method="post">
                <div class="modal-body">
                    <div id="modal-content-loading">
                        <div  class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="modal-content-show" style="display: none">
                        @csrf
                        <input type="hidden" name="opd" value="{{ $opd->id }}">
                        <input type="hidden" name="ranwal" value="{{ $opd->rkaranwal->id }}">
                        <input type="hidden" name="subkegiatan" value="{{ $opd->rkaranwal->subkegiatanrka->id }}">
                        <input type="hidden" name="subrincian" value="{{ $opd->rkaranwal->subrincianrka->id }}">
                        <div class="row">
                            <div class="mb-3">
                                <label for="rekening" class="form-label">Rekening Belanja</label>
                                <select class="form-select select2" name="rekening" id="rekening" data-placeholder="Pilih rekening">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="komponen" class="form-label">Komponen Barang</label>
                                <select class="form-select select2" name="komponen" id="komponen">
                                    <option value="0" selected>Pilih komponen</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                <textarea class="form-control" id="spesifikasi" disabled></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Satuan</label>
                                <input type="text" class="form-control" id="harga" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="volume" class="form-label">Volume</label>
                                <input type="text" name="volume" class="form-control" id="volume" placeholder="Volume" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" placeholder="0" disabled>
                            </div>
                            <div class="form-check form-switch m-3">
                                <input class="form-check-input" name="pajak" type="checkbox" role="switch" id="pajak">
                                <label class="form-check-label" for="pajak">Pajak 10%</label>
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
