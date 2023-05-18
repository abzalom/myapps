<!-- Modal -->
<div class="modal fade" id="katRekModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="katRekModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="katRekModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/rekening/belanja" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="kode_belanja" id="kode-belanja">
                    <div class="mb-3">
                        <label for="modal-add-kode" class="form-label">Kategori</label>
                        <select name="kode_kategori[]" class="form-control modal-add-kode" id="get-kode-akun-kategori" data-placeholder="Cari kategori" multiple></select>
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
