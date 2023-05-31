<!-- Modal -->
<div class="modal fade" id="uploadStandarHargaModal" tabindex="-1" aria-labelledby="uploadStandarHargaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Upload Standar Harga</h5>
                <p>Format file harus dalam bentuk *.xlxs atau *.csv</p>
                <form action="{{ route('standarharga.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" id="uploadStandarHarga" aria-describedby="uploadSshAddon04" aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="submit" id="uploadSshAddon04">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
