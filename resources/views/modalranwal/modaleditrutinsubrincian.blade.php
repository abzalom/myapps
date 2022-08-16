<!-- Modal -->
<div class="modal fade" id="editSubRincianRutinModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editSubRincianRutinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubRincianRutinModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ranwalrutin.subrincianupdate') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="idsubrincian" id="idranwalEditSubRutin">
                    <div id="loadformEditSubrincianRutin">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="showformEditSubrincianRutin" style="display: none">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="rincianEditSubRutin" class="form-label">Rincian Pekerjaan* (singkat &
                                        jelas)</label>
                                    <textarea class="form-control" name="rincian" id="rincianEditSubRutin" rows="2"
                                        placeholder="Apa yang akan dikerjakan?"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="indikatorEditSubRutin" class="form-label">Indikator</label>
                                    <textarea class="form-control" id="indikatorEditSubRutin" rows="2" placeholder="Apa yang akan dikerjakan?"
                                        disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="targetEditSubRutin" class="form-label">Target</label>
                                    <input type="text" name="target" class="form-control" id="targetEditSubRutin"
                                        name="target" placeholder="Target">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="satuanEditSubRutin" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuanEditSubRutin"
                                        placeholder="Satuan" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="anggaranEditSubRutin-addon1">Rp.</span>
                                    <input type="text" class="form-control" id="anggaranEditSubRutin" name="anggaran"
                                        placeholder="Rp. 000,00-" aria-label="Anggaran"
                                        aria-describedby="anggaranEditSubRutin-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="sumberdanaEditSubRutin" class="form-label">Sumber Pendanaan</label>
                                    <select class="form-select select2" id="sumberdanaEditSubRutin"
                                        name="h1_pagu_opd_ranwal_id" aria-label="Default select example"
                                        data-placeholder="Pilih...">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="klasifikasiEditSubRutin" class="form-label">Klasifikasi Anggaran</label>
                                    <select class="form-select select2" id="klasifikasiEditSubRutin"
                                        aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                        <option selected>Administrasi Pemerintahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="penerima_manfaatEditSubRutin" class="form-label">Penerima
                                        Manfaat</label>
                                    <select class="form-select select2" id="penerima_manfaatEditSubRutin"
                                        aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                        <option>Aparatur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="jenisEditSubRutin" class="form-label">Jenis Pekerjaan</label>
                                    <select class="form-select select2" id="jenisEditSubRutin"
                                        name="e_jenis_pekerjaan_id" aria-label="Default select example"
                                        data-placeholder="Pilih...">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="lokasiEditSubRutin" class="form-label">Lokasi</label>
                                    <select class="form-select select2" id="lokasiEditSubRutin" name="lokasi[]"
                                        aria-label="Default select example" data-placeholder="Pilih..." multiple>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <span class="mb-3">Waktu Pelaksanaan</span>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="mulaiEditSubRutin" class="form-label">Mulai</label>
                                    <select class="form-select select2" id="mulaiEditSubRutin"
                                        aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                        <option selected>Januari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="selesaiEditSubRutin" class="form-label">Selesai</label>
                                    <select class="form-select select2" id="selesaiEditSubRutin"
                                        aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                        <option selected>Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="keteranganEditSubRutin" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keteranganEditSubRutin" name="keterangan" rows="2"
                                        placeholder="Tambahkan keterangan jika ada! (bisa dikosongkan)"></textarea>
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
