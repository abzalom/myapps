<!-- Modal -->
<div class="modal fade" id="addIndikatorKegiatanRutinModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addIndikatorKegiatanRutinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addIndikatorKegiatanRutinModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formIndikatorKegRutin" action="{{ route('ranwalrutin.indikatorkegiatanstore') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="a7_kegiatan_rutin_id" id="idKegIndikatorKegRutin">
                    <input type="hidden" name="f1_perangkat_id" value="{{ $opd->id }}">
                    <input type="hidden" name="kode_unik_kegiatan" id="KodeUnikKegIndikatorKegRutin">
                    <input type="hidden" name="tahun" value="{{ $opd->tahun }}">
                    <input type="hidden" name="idindikator" id="idIndikatorKegRutin">
                    <div class="mb-3">
                        <label for="capaian" class="form-label">Capaian</label>
                        <textarea name="capaian" class="form-control" id="capaianIndikatorKegRutin" rows="3"
                            placeholder="Apa yang akan dicapai dari kegiatan ini?"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="target_capaian" class="form-label">Target Capaian</label>
                                <input name="target_capaian" type="text" class="form-control"
                                    id="target_capaianIndikatorKegRutin" placeholder="Target Capaian">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="satuan_capaian" class="form-label">Satuan Cpaian</label>
                                <input name="satuan_capaian" type="text" class="form-control"
                                    id="satuan_capaianIndikatorKegRutin" placeholder="Satuan Capaian">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label for="keluaran" class="form-label">Outcome / Keluaran Kegiatan</label>
                        <textarea name="keluaran" class="form-control" id="keluaranIndikatorKegRutin" rows="3"
                            placeholder="Apa Outcome dari kegiatan ini?"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="target_keluaran" class="form-label">Target Outcome</label>
                                <input name="target_keluaran" type="text" class="form-control"
                                    id="target_keluaranIndikatorKegRutin" placeholder="Target Outcome">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="satuan_keluaran" class="form-label">Satuan Outcome</label>
                                <input name="satuan_keluaran" type="text" class="form-control"
                                    id="satuan_keluaranIndikatorKegRutin" placeholder="Satuan Outcome">
                            </div>
                        </div>
                    </div>

                    <div id="addIndikatorHasilKegiatanRutin">
                        <hr>
                        <div class="mb-3">
                            <label for="hasil" class="form-label">Hasil Kegiatan</label>
                            <input type="text" name="hasil" class="form-control" id="hasilIndikatorKegRutin"
                                rows="3" placeholder="Apa yang akan dihasilkan dari kegiatan ini?">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="target_hasil" class="form-label">Target Hasil</label>
                                    <input name="target_hasil" type="text" class="form-control"
                                        id="target_hasilIndikatorKegRutin" placeholder="Target hasil">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="satuan_hasil" class="form-label">Satuan Hasil</label>
                                    <input name="satuan_hasil" type="text" class="form-control"
                                        id="satuan_hasilIndikatorKegRutin" placeholder="Satuan hasil">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <button class="btn btn-info"><i class="fa-solid fa-plus-square fa-lg"></i> Tambah
                                Indikator Hasil</button>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
