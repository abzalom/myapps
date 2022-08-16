  <!-- Modal -->
  <div class="modal fade" id="addRutinModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addRutinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRutinModalLabel">Tambah Renja pada {{ ucwords($opd->nama_perangkat) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ranwalrutin.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="idopdRutin" name="idopd" value="{{ $opd->id }}">
                    <div id="addRutinLoading">
                        <div  class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="addRutinShow" style="display: none">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="programRutin" class="form-label">Program</label>
                                    <select class="form-select select2" id="programRutin" aria-label="Default select example" data-placeholder="Pilih Program" disabled>
                                        <option value="1" selected>1.03.01 - PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</option>
                                    </select>
                                    <input type="hidden" name="program" value="1">
                                </div>
                                <div class="mb-3">
                                    <label for="kegiatanRutin" class="form-label">Kegiatan</label>
                                    <select class="form-select select2" name="kegiatan" id="kegiatanRutin" aria-label="Default select example" data-placeholder="Pilih Kegiatan">
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="subkegiatanRutin" class="form-label">Sub Kegiatan</label>
                                    <select class="form-select select2" name="subkegiatan" id="subkegiatanRutin" aria-label="Default select example" data-placeholder="Pilih Sub Kegiatan" disabled>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="prionasRutin" class="form-label">Mendukung Prioritas Pembangunan Nasional</label>
                                    <select class="form-select select2" name="prionas" id="prionasRutin" aria-label="Default select example" data-placeholder="Pilih Prioritas Nasional" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="prioprovRutin" class="form-label">Mendukung Prioritas Pembangunan Provinsi</label>
                                    <select class="form-select select2" name="prioprov" id="prioprovRutin" aria-label="Default select example" data-placeholder="Pilih Prioritas Provinsi" disabled>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="priodaRutin" class="form-label">Mendukung Prioritas Pembangunan Daerah</label>
                                    <select class="form-select select2" name="prioda" id="priodaRutin" aria-label="Default select example" data-placeholder="Pilih Prioritas Daerah" disabled>
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
