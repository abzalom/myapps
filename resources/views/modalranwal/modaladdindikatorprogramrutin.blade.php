<!-- Modal -->
<div class="modal fade" id="addIndikatorProgramRutinModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addIndikatorProgramRutinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addIndikatorProgramRutinModalLabel">PROGRAM PENUNJANG URUSAN PEMERINTAHAN
                    DAERAH KABUPATEN/KOTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ranwalrutin.indikatorprogramstore') }}" method="post">
                <div class="modal-body">
                    <div id="addIndkatorProgramLoading">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="addIndkatorProgramShow" style="display: none">
                        @csrf
                        <input type="hidden" name="a6_program_rutin_id" value="1">
                        <input type="hidden" name="f1_perangkat_id" value="{{ $opd->id }}">
                        <input type="hidden" name="kode_unik_program" value="01">
                        <input type="hidden" name="tahun" value="{{ $opd->tahun }}">
                        <input type="hidden" name="idindikator" id="idIndikatorProgRutin">

                        <div class="mb-3">
                            <label for="sasaran" class="form-label">Sasaran</label>
                            <textarea class="form-control" name="sasaran" id="sasaranIndikatorProgRutin"
                                placeholder="Apa yang menjadi sasaran progam ini?"></textarea>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="capaian" class="form-label">Capaian</label>
                            <textarea class="form-control" name="capaian" id="capaianIndikatorProgRutin"
                                placeholder="Apa yang akan dicapai dari progam ini?"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3">
                                    <label for="target" class="form-label">Target</label>
                                    <input type="text" class="form-control" id="targetIndikatorProgRutin"
                                        name="target" placeholder="Target">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuanIndikatorProgRutin"
                                        name="satuan" placeholder="Satuan">
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
