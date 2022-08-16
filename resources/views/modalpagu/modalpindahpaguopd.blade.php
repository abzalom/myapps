<!-- Modal -->
<div class="modal fade" id="pindahPaguModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pindahPaguModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="pindahPaguModalLabel">
                    Pindahkan Anggaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengaturan.paguupdatepindah') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="idopd" id="opd">
                    <input type="hidden" name="idsumber" id="sumber">
                    <input type="hidden" name="status_pagu" id="statuspagu" value="5">
                    <input type="hidden" name="pagu_awal" id="paguAwal">
                    <input type="hidden" name="id_pedapatan_uraian" id="idpendapatanuraian">

                    <div class="mb-3">
                        <strong id="namasumberdana"></strong>
                    </div>
                    <div class="alert alert-warning p-0">
                        <div class="row">
                            <div class="col-sm-2 text-center align-content-around">
                                <i class="fa-solid fa-exclamation-triangle fa-2xl"></i>
                            </div>
                            <div class="col-sm-10">
                                OPD yang ditujukan harus memiliki pagu dari sumber yang sama!
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pindahjumlah">Jumlah pagu yang akan di pindahkan</label>
                        <input name="pagu_pindah" value="" type="number" class="form-control" id="pindahjumlah" placeholder="Rp. 000,00-">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pagusisa">Jumlah pagu yang tersisa</label>
                        <input value="" type="number" class="form-control" id="pagusisa" placeholder="Rp. 000,00-" disabled>
                        <input type="hidden" name="pagu_sisa" id="pagusisakirim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pindahopd">Pilih OPD tujuan</label>
                        <select name="opd_tujuan" class="form-select select2" id="pindahopd">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pindahtujuan">Alasan pemindahan pagu</label>
                        <textarea name="tujuan_pindah" type="number" class="form-control" id="pindahtujuan" rows="3" placeholder="Apa alasannya dilakukan perubahan pagu ini?"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark fa-xl"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk fa-xl"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
