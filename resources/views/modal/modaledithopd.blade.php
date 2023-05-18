<!-- Modal -->
<div class="modal fade" id="editOpdModal" tabindex="-1" aria-labelledby="editOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editOpdModalLabel">
                    Tambah OPD
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('opd.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="idopd" id="idopdEdit">
                    <div class="mb-3">
                        <label class="form-label" for="bidang1Edit">Bidang Urusan Pemerintahan 1</label>
                        <select name="bidang1" class="form-control select2" id="bidang1Edit">
                            <option value="">Pilih bidang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="bidang2Edit">Bidang Urusan Pemerintahan 2</label>
                        <select name="bidang2" class="form-control select2" id="bidang2Edit">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="bidang3Edit">Bidang Urusan Pemerintahan 3</label>
                        <select name="bidang3" class="form-control select2" id="bidang3Edit">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="opdEdit">Nama OPD</label>
                        <input type="text" name="opd" class="form-control" id="opdEdit" placeholder="Nama OPD" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kodeEdit">Kode OPD</label>
                        <input type="number" name="kode" class="form-control" id="kodeEdit" placeholder="Kode OPD" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kelompok_bidangEdit">Kelompok Bidang</label>
                        <select name="kelompok_bidang" class="form-control select2" id="kelompok_bidangEdit">
                            <option value="">Pilih Kelompok Bidang</option>
                            @foreach ($kelbidangs as $kelbid)
                                <option value="{{ $kelbid->id }}">BIDANG {{ strtoupper($kelbid->uraian) }}</option>
                            @endforeach
                        </select>
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
