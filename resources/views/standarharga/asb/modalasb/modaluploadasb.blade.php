<!-- Modal -->
<div class="modal fade" id="uploadSshModal" tabindex="-1" aria-labelledby="uploadSshModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Upload SSH</h5>
                <p>Format file harus dalam bentuk *.xlxs atau *.csv</p>
                <form action="{{ route('ssh.sshupload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" id="uploadSshInput" aria-describedby="uploadSshAddon04" aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="submit" id="uploadSshAddon04">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
