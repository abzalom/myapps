<!-- Modal -->
<div class="modal fade" id="addSubRincianRutinModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSubRincianRutinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addSubRincianRutinModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('ranwalrutin.subrincianstore') }}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="f1_perangkat_id" value="{{ $opd->id }}">
                <input type="hidden" name="tahun" value="{{ $opd->tahun }}">
                <input type="hidden" name="a2_bidang_id" id="idbidangRutin">
                <input type="hidden" name="a6_program_rutin_id" id="idprogSubRutin">
                <input type="hidden" name="a7_kegiatan_rutin_id" id="idkegSubRutin">
                <input type="hidden" name="a8_subkegiatan_rutin_id" id="idsubkegSubRutin">
                <input type="hidden" name="i5_rutin_opd_ranwal_id" id="idranwalSubRutin">
                <input type="hidden" name="e_status_renja_id" value="1">
                <div id="loadformSubrincianRutin">
                    <div  class="d-flex justify-content-center">
                        <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="showformSubrincianRutin" style="display: none">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="rincianSubRutin" class="form-label">Rincian Pekerjaan* (singkat & jelas)</label>
                                <textarea class="form-control" name="rincian" id="rincianSubRutin" rows="2" placeholder="Apa yang akan dikerjakan?"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="indikatorSubRutin" class="form-label">Indikator</label>
                                <textarea class="form-control" id="indikatorSubRutin" name="indikator" rows="2" placeholder="Apa yang akan dikerjakan?" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="targetSubRutin" class="form-label">Target</label>
                                <input type="text" class="form-control" id="targetSubRutin" name="target" placeholder="Target">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="satuanSubRutin" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuanSubRutin" name="satuan" placeholder="Satuan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="anggaranSubRutin-addon1">Rp.</span>
                                <input type="text" class="form-control" id="anggaranSubRutin" name="anggaran" placeholder="Rp. 000,00-" aria-label="Anggaran" aria-describedby="anggaranSubRutin-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="sumberdanaSubRutin" class="form-label">Sumber Pendanaan</label>
                                <select class="form-select select2" id="sumberdanaSubRutin" name="h1_pagu_opd_ranwal_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="klasifikasiSubRutin" class="form-label">Klasifikasi Anggaran</label>
                                <select class="form-select select2" id="klasifikasiSubRutin" name="e_klasifikasi_id" aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                    <option selected>Administrasi Pemerintahan</option>
                                </select>
                                <input type="hidden" name="e_klasifikasi_id" value="6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="penerima_manfaatSubRutin" class="form-label">Penerima Manfaat</label>
                                <select class="form-select select2" id="penerima_manfaatSubRutin" aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                    <option>Aparatur</option>
                                </select>
                                <input type="hidden" name="e_penerima_manfaat_id" value="2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="jenisSubRutin" class="form-label">Jenis Pekerjaan</label>
                                <select class="form-select select2" id="jenisSubRutin" name="e_jenis_pekerjaan_id" aria-label="Default select example" data-placeholder="Pilih...">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="lokasiSubRutin" class="form-label">Lokasi</label>
                                <select class="form-select select2" id="lokasiSubRutin" name="lokasi[]" aria-label="Default select example" data-placeholder="Pilih..." multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <span class="mb-3">Waktu Pelaksanaan</span>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="mulaiSubRutin" class="form-label">Mulai</label>
                                <select class="form-select select2" id="mulaiSubRutin" name="mulai" aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                    <option selected>Januari</option>
                                </select>
                                <input type="hidden" name="mulai" value="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selesaiSubRutin" class="form-label">Selesai</label>
                                <select class="form-select select2" id="selesaiSubRutin" aria-label="Default select example" data-placeholder="Pilih..." disabled>
                                    <option selected>Desember</option>
                                </select>
                                <input type="hidden" name="selesai" value="12">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="keteranganSubRutin" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keteranganSubRutin" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika ada! (bisa dikosongkan)"></textarea>
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
