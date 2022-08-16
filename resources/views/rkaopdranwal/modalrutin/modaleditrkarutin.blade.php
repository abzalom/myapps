<!-- Modal -->
<div class="modal fade" id="editRkaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editRkaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="editRkaModalLabel">Form RKA : {{ $opd->ranwalrutinrka->subrincianrka->rincian }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rkarutin.rkarutinupdate') }}" method="post">
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
                        {{-- <input type="hidden" name="opd" value="{{ $opd->id }}">
                        <input type="hidden" name="ranwal" value="{{ $opd->ranwalrutinrka->id }}">
                        <input type="hidden" name="subkegiatan" value="{{ $opd->ranwalrutinrka->subkegiatanrka->id }}">
                        <input type="hidden" name="subrincian" value="{{ $opd->ranwalrutinrka->subrincianrka->id }}"> --}}
                        <input type="hidden" name="idkomponen" id="idkomponen">
                        <div class="row">
                            <div class="mb-3">
                                <label for="rekening" class="form-label">Rekening Belanja</label>
                                <input type="text" class="form-control" id="rekeningEdit" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="komponen" class="form-label">Komponen Barang</label>
                                <input type="text" class="form-control" id="komponenEdit" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                <textarea class="form-control" id="spesifikasiEdit" disabled></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Satuan</label>
                                <input type="text" class="form-control" id="hargaEdit" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuanEdit" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="volume" class="form-label">Volume</label>
                                <input type="text" name="volume" class="form-control" id="volumeEdit" placeholder="Volume" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="jumlahEdit" placeholder="0" disabled>
                            </div>
                            <div class="form-check form-switch m-3">
                                <input class="form-check-input" name="pajak" type="checkbox" role="switch" id="pajakEdit">
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
