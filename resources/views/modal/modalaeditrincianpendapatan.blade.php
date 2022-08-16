<!-- Modal -->
<div class="modal fade" id="editRincianPendatanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editRincianPendatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="editRincianPendatanModalLabel">
                    Tambah Komponen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pendapatan.updateuraian') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="komponen" id="idkomponen">
                    <div class="mb-3">
                        <label class="form-label" for="uraian">Uraian Komponen</label>
                        <textarea name="uraian" type="text" class="form-control" id="uraian" rows="3" placeholder="Uraian komponen pendapatan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="anggaran">Jumlah Pendapatan</label>
                        <input name="anggaran" type="number" class="form-control" id="anggaran" placeholder="Rp. 000,00-">
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
