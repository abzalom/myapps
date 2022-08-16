<!-- Modal -->
<div class="modal fade" id="deleteSubRincianModal" tabindex="-1" aria-labelledby="deleteSubRincianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form action="{{ route('ranwal.indikatorsubkegiatandelete') }}" class="d-flex m-0" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="idindikator" id="idindikatorDelete">
                <div class="row mb-3">
                    <div class="col text-center">
                        <h5>
                            Apakah anda yakin ingin menghapus rincian :
                        </h5>
                        <h5 id="rincianDelete"></h5>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="row">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="row">
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-triangle-exclamation fa-lg"></i> Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
