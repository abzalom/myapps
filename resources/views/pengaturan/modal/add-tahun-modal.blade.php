<!-- Modal -->
<div class="modal fade" id="tahunAnggaranModal" tabindex="-1" aria-labelledby="tahunAnggaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tahunAnggaranModalLabel">Tahun Anggaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengaturan.rkpd.store.tahun') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="add-tahun-anggaran" class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" id="add-tahun-anggaran" placeholder="Tahun">
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
