  <!-- Modal -->
  <div class="modal fade" id="tambahRenjaModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahRenjaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRenjaModalLabel">Tambah Renja pada {{ ucwords($opd->nama_perangkat) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ranwal.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="idopd" name="idopd" value="{{ $opd->id }}">
                    <div id="addRenjaLoading">
                        <div  class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="addRenjaShow" style="display: none">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="bidang" class="form-label">Bidang</label>
                                    <select class="form-select select2" name="bidang" id="bidang" aria-label="Default select example" data-placeholder="Pilih Bidang">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="program" class="form-label">Program</label>
                                    <select class="form-select select2" name="program" id="program" aria-label="Default select example" data-placeholder="Pilih Program" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <select class="form-select select2" name="kegiatan" id="kegiatan" aria-label="Default select example" data-placeholder="Pilih Kegiatan" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subkegiatan" class="form-label">Sub Kegiatan</label>
                                    <select class="form-select select2" name="subkegiatan" id="subkegiatan" aria-label="Default select example" data-placeholder="Pilih Sub Kegiatan" disabled>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="prionas" class="form-label">Mendukung Prioritas Pembangunan Nasional</label>
                                    <select class="form-select select2" name="prionas" id="prionas" aria-label="Default select example" data-placeholder="Pilih Prioritas Nasional" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="prioprov" class="form-label">Mendukung Prioritas Pembangunan Provinsi</label>
                                    <select class="form-select select2" name="prioprov" id="prioprov" aria-label="Default select example" data-placeholder="Pilih Prioritas Provinsi" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="prioda" class="form-label">Mendukung Prioritas Pembangunan Daerah</label>
                                    <select class="form-select select2" name="prioda" id="prioda" aria-label="Default select example" data-placeholder="Pilih Prioritas Daerah" disabled>
                                    </select>
                                </div>
                            </div>
                        </div>
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
