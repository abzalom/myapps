<!-- Modal -->
<div class="modal fade" id="addKepalaOpdModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addKepalaOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKepalaOpdModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('opd.storekepalaopd') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="f1_perangkat_id" id="idopdKepala">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap :</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap Kepala OPD">
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP :</label>
                        <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Kepala OPD">
                    </div>
                    <div class="mb-3">
                        <label for="pangkat" class="form-label">Pangkat :</label>
                        <input type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Pangkat Kepala OPD">
                    </div>
                    <div class="mb-3">
                        <label for="golongan" class="form-label">Golongan :</label>
                        <input type="text" class="form-control" name="golongan" id="golongan" placeholder="Golongan Kepala OPD">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan :</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan Kepala OPD">
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