<!-- Modal -->
<div class="modal fade" id="addSshModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSshModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSshModalLabel">Input Komponen SBU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sbu.sbustore') }}" method="post">
                <div class="modal-body">
                    <div id="addSshLoading">
                        <div  class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="addSshShow" style="display: none">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori Belanja</label>
                            <select class="form-select" name="kategori" id="kategori" data-placeholder="Pilih...">
                            </select>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="rekening" class="form-label">Rekening Belanja</label>
                            <select class="form-select select2" name="rekening" id="rekening" data-placeholder="Pilih..." disabled>
                            </select>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="uraian" class="form-label">Nama Komponen</label>
                            <input type="text" class="form-control" name="uraian" id="uraian" placeholder="Nama Komponen Barang" autocomplete="off" disabled>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="spesifikasi" class="form-label">Spesifikasi Komponen</label>
                            <textarea class="form-control" name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi Komponen Barang" rows="2" disabled></textarea>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Komponen</label>
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga Komponen Barang" autocomplete="off" disabled>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan Komponen</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan Komponen Barang" autocomplete="off" disabled>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Asal Produk</label>
                            <select class="form-select select2" name="jenis" id="jenis" data-placeholder="Pilih..." disabled>
                            </select>
                        </div>
                        <hr class="text-success border-1 opacity-30">

                        <div class="mb-3">
                            <label for="inflasi" class="form-label">Tingkat Komponen</label>
                            <input type="number" class="form-control" name="inflasi" id="inflasi" placeholder="Persentasi (%)" autocomplete="off" style="width: 40%" disabled>
                        </div>
                        <hr class="text-success border-1 opacity-30">
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
