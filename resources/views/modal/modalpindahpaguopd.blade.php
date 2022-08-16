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
                    <input type="hidden" name="idopd" id="idopd">
                    <input type="hidden" name="idpagu" id="idpagu">
                    <input type="hidden" name="status_pagu" id="statuspagu" value="5">
                    <input type="hidden" name="pagu_awal" id="paguAwal">
                    <input type="hidden" name="id_pedapatan_uraian" id="idpendapatanuraian">

                    <div id="informasi" class="mb-3" style="font-size: 90%">
                        <div class="row mb-2">
                            <div class="col-sm-3">OPD</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namaopd"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Bidang</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namabidang"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Sumber Dana</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namasumber"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Jumlah Dana</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="jumlahdana"></div>
                        </div>
                    </div>

                    <div class="alert alert-warning p-0">
                        <div class="row">
                            <div class="col-sm-2 text-center align-content-around">
                                <i class="fa-solid fa-exclamation-triangle fa-2xl"></i>
                            </div>
                            <div class="col-sm-10">
                                OPD yang ditujukan harus memiliki sumber yang sama!
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pindahjumlah">Jumlah pagu yang akan di pindahkan</label>
                        <input name="pagu_pindah" value="" type="number" class="form-control" id="pindahjumlah" placeholder="Rp. 000,00-">
                        <span class="badge bg-danger" id="paguOverAlert" style="display: none">Jumlah pagu yang akan dipndahkan melebih jumlah pagu sebelumnya</span>
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
                        <label class="form-label" for="pindahbidang">Pilih Bidang tujuan</label>
                        <select name="bidang_tujuan" class="form-select select2" id="pindahbidang" disabled>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pindahtujuan">Alasan pemindahan pagu</label>
                        <textarea name="tujuan_pindah" type="number" class="form-control" id="pindahtujuan" rows="3" placeholder="Apa alasan dipindahkannya pagu ini?"></textarea>
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
