<!-- Modal -->
<div class="modal fade" id="editSubRincianModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSubRincianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editSubRincianModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('ranwal.indikatorsubkegiatanupdate') }}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="idindikator" id="idindikatorEdit">
                <input type="hidden" name="tahun" id="tahunEdit">
                <div id="loadform">
                    <div  class="d-flex justify-content-center">
                        <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="showform" style="display: none">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="rincian" class="form-label">Rincian Pekerjaan* (singkat & jelas)</label>
                                <textarea class="form-control" name="rincian" id="rincianEdit" rows="2" placeholder="Apa yang akan dikerjakan?"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="indikator" class="form-label">Indikator</label>
                                <textarea class="form-control" id="indikatorEdit" name="indikator" rows="2" placeholder="Apa yang akan dikerjakan?"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="target" class="form-label">Target</label>
                                <input type="text" class="form-control" id="targetEdit" name="target" placeholder="Target">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuanEdit" name="satuan" placeholder="Satuan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="anggaran-addon1">Rp.</span>
                                <input type="number" class="form-control" id="anggaranEdit" name="anggaran" placeholder="Rp. 000,00-" aria-label="Anggaran" aria-describedby="anggaran-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="sumberdana" class="form-label">Sumber Pendanaan</label>
                                <select class="form-select select2" id="sumberdanaEdit" name="h1_pagu_opd_ranwal_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="klasifikasi" class="form-label">Klasifikasi Anggaran</label>
                                <select class="form-select select2" id="klasifikasiEdit" name="e_klasifikasi_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="penerima_manfaat" class="form-label">Penerima Manfaat</label>
                                <select class="form-select select2" id="penerima_manfaatEdit" name="e_penerima_manfaat_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="jenisEdit" class="form-label">Jenis Pekerjaan</label>
                                <select class="form-select select2" id="jenisEdit" name="e_jenis_pekerjaan_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <select class="form-select select2" id="lokasiEdit" name="lokasi[]" aria-label="Default select example" data-placeholder="Pilih..." multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <span class="mb-3">Waktu Pelaksanaan</span>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="mulai" class="form-label">Mulai</label>
                                <select class="form-select select2" id="mulaiEdit" name="mulai" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selesai" class="form-label">Selesai</label>
                                <select class="form-select select2" id="selesaiEdit" name="selesai" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keteranganEdit" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika ada! (bisa dikosongkan)"></textarea>
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
