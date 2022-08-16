<!-- Modal -->
<div class="modal fade" id="deleteSshModal" tabindex="-1" aria-labelledby="deleteSshModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class=" text-center mb-4">
                    <h5 class="text-danger"><i class="fa-solid fa-exclamation-triangle fa-2xl"></i> PERINGATAN!</h5>
                    <h5 class="text-danger">Anda yakin ingin menghapus komponen ini?</h5>
                </div>
                <form action="{{ route('ssh.sshdelete') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idkomponen" id="idkomponenDelete">
                    <div class="row">
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">TIDAK</button>
                        </div>
                        <div class="col-6 text-center">
                            <button type="submit" class="btn btn-danger w-100">YA</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
