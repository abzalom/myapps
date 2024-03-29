<!-- Modal -->
<div class="modal fade" id="editPaguModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPaguModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editPaguModalLabel">
                    Edit Pagu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengaturan.paguupdatereguler') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="idopd" id="idopd">
                    <input type="hidden" name="idpagu" id="idpagu">
                    <input type="hidden" name="status_pagu" id="statuspagu" value="2">
                    <input type="hidden" name="pagu_awal" id="paguAwal">

                    <div id="informasi" class="mb-3" style="font-size: 90%">
                        <div class="row mb-2">
                            <div class="col-sm-3">OPD</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namaopd">: </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Bidang</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namabidang">: </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Sumber Dana</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="namasumber">: </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-3">Jumlah Dana</div>
                            <div class="col-sm-1 p-0" style="width: 0%">:</div>
                            <div class="col-9" id="jumlahdana">: </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" value="true" id="editcheckbox" name="status">
                            <label class="form-check-label" for="editcheckbox">
                                Kurangi Pagu
                            </label>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3" id="tambahPaguShow">
                        <label class="form-label" for="tambahpagu">Jumlah Pagu yang akan ditambahkan</label>
                        <input value="" type="text" class="form-control" id="tambahpagu" placeholder="Rp. 000,00-">
                    </div>
                    <div class="mb-3" id="kurangPaguShow" style="display: none">
                        <label class="form-label" for="kurangPagu">Jumlah Pagu yang akan dikurangi</label>
                        <input value="" type="text" class="form-control" id="kurangPagu" placeholder="Rp. 000,00-">
                        <span class="badge bg-danger" id="paguOverAlert" style="display: none">Jumlah pagu yang akan dikurangi melebih jumlah pagu sebelumnya</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jumlahpagu">Jumlah Pagu menjadi</label>
                        <input type="text" class="form-control" id="jumlahpagu" placeholder="Rp. 000,00-" disabled>
                        <input name="jumlah_pagu" type="hidden" id="jumlahpagu">
                        <div class="badge bagde-danger bg-danger" id="melebihiPagu" style="display: none">Jumlah pagu yang ditambahkan sudah melebihi sebelumnya!</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" id="tujuanLabel" for="tujuan">Alasan Perubahan Pagu</label>
                        <textarea name="tujuan_edit_biasa" type="text" class="form-control" id="tujuan" rows="3" placeholder="Apa alasannya dilakukan perubahan pagu ini?"></textarea>
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
