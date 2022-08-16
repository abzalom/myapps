<!-- Modal -->
<div class="modal fade" id="addSubRincianModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addSubRincianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubRincianModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ranwal.indikatorsubkegiatanstore') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="f1_perangkat_id" value="{{ $opd->id }}">
                    <input type="hidden" name="a1_urusan_id" id="idurusan">
                    <input type="hidden" name="a2_bidang_id" id="idbid">
                    <input type="hidden" name="a3_program_id" id="idprog">
                    <input type="hidden" name="a4_kegiatan_id" id="idkeg">
                    <input type="hidden" name="a5_subkegiatan_id" id="idsubkeg">
                    <input type="hidden" name="i2_renja_opd_ranwal_id" id="idranwal">
                    <input type="hidden" name="e_status_renja_id" value="1">
                    <input type="hidden" name="tahun" value="{{ $opd->tahun }}">
                    <div id="loadform">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="showform" style="display: none">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="rincian" class="form-label">Rincian Pekerjaan* (singkat &
                                        jelas)</label>
                                    <textarea class="form-control" name="rincian" id="rincian" rows="2" placeholder="Apa yang akan dikerjakan?"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="indikator" class="form-label">Indikator</label>
                                    <textarea class="form-control" id="indikatorShow" rows="2" disabled></textarea>
                                    <input type="hidden" id="indikator" name="indikator"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="target" class="form-label">Target</label>
                                    <input type="text" class="form-control" id="target" name="target"
                                        placeholder="Target" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuanShow" placeholder="Satuan"
                                        disabled>
                                    <input type="hidden" id="satuan" name="satuan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="anggaran-addon1">Rp.</span>
                                    <input type="number" class="form-control" id="anggaran" name="anggaran"
                                        placeholder="Rp. 000,00-" aria-label="Anggaran"
                                        aria-describedby="anggaran-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="sumberdana" class="form-label">Sumber Pendanaan</label>
                                    <select class="form-select select2" id="sumberdana" name="h1_pagu_opd_ranwal_id"
                                        aria-label="Default select example" data-placeholder="Pilih..." required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="klasifikasi" class="form-label">Klasifikasi Anggaran</label>
                                    <select class="form-select select2" id="klasifikasi" name="e_klasifikasi_id"
                                        aria-label="Default select example" data-placeholder="Pilih..." required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="penerima_manfaat" class="form-label">Penerima Manfaat</label>
                                    <select class="form-select select2" id="penerima_manfaat"
                                        name="e_penerima_manfaat_id" aria-label="Default select example"
                                        data-placeholder="Pilih..." required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis Pekerjaan</label>
                                    <select class="form-select select2" id="jenis" name="e_jenis_pekerjaan_id"
                                        aria-label="Default select example" data-placeholder="Pilih..." required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <select class="form-select select2" id="lokasi" name="lokasi[]"
                                        aria-label="Default select example" data-placeholder="Pilih..." multiple
                                        required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <span class="mb-3">Waktu Pelaksanaan</span>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="mulai" class="form-label">Mulai</label>
                                    <select class="form-select select2" id="mulai" name="mulai"
                                        aria-label="Default select example" data-placeholder="Pilih...">
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="selesai" class="form-label">Selesai</label>
                                    <select class="form-select select2" id="selesai" name="selesai"
                                        aria-label="Default select example" data-placeholder="Pilih...">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
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
