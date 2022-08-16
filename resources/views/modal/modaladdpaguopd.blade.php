<!-- Modal -->
<div class="modal fade" id="tambahPaguModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahPaguModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="tambahPaguModalLabel">
                    Tambah Pagu OPD
                </h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form action="{{ route('pengaturan.pagustore') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="idopd_baru" id="idopd_baru">
                    <input type="hidden" name="statuspagu" id="statusPagu" value="1">
                    <input type="hidden" name="urusan_baru_id" id="urusan_baru_id">
                    <input type="hidden" name="bidang_baru_id" id="bidang_baru_id">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="statusCheckBox" name="status">
                            <label class="form-check-label" for="statusCheckBox">
                                Ambil dari OPD Lain
                            </label>
                        </div>
                    </div>
                    <div id="pindahanPagu" style="display: none">
                        <div class="mb-3">
                            <label class="form-label" for="opd_pindahan">Pilih OPD Sebelumnya</label>
                            <select class="form-select select2" id="opd_pindahan">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="bidang_pindahan">Pilih Bidang</label>
                            <select class="form-select select2" id="bidang_pindahan" disabled>
                                <option value="">Pilih</option>
                            </select>
                        <input type="hidden" id="urusan_pindahan">
                        </div>
                        <div id="pindahanInputDiv">
                            <div class="mb-3">
                                <label class="form-label" id="sumberPidahanLabel" for="sumberPidahan">Sumber Dana</label>
                                <select class="form-select select2" id="sumberPidahan" disabled>
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" id="paguPindahanLabel" for="paguPindahan">Jumlah Pagu</label>
                                <input type="text" class="form-control" id="paguPindahan" placeholder="Rp. 000,00-">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" id="tujuanPindahLabel" for="tujuanPindah">Alasan Pemindahan Pagu</label>
                                <textarea class="form-control" id="tujuanPindah" rows="3" placeholder="Apa alasan pemindahan pagu?"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="baruInputDiv">
                        <div class="mb-3">
                            <label class="form-label" for="sumberBaru">Sumber Dana</label>
                            <select name="sumber_baru" class="form-select select2" id="sumberBaru">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="paguBaru">Jumlah Pagu</label>
                            <input name="pagu_baru" type="text" class="form-control" id="paguBaru" placeholder="Rp. 000,00-">
                        </div>
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
