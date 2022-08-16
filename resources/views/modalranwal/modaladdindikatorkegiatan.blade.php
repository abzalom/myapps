<!-- Modal -->
<div class="modal fade" id="addIndikatorKegiatanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addIndikatorKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addIndikatorKegiatanModalLabel">Target Kinerja Kegiatan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('ranwal.indikatorkegiatanstore') }}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="f1_perangkat_id" id="idopd" value="{{ $opd->id }}">
                <input type="hidden" name="tahun" value="{{ $opd->tahun }}">
                <input type="hidden" name="a4_kegiatan_id" id="idkeg">
                <input type="hidden" name="kode_unik_kegiatan" id="kodekeg">
                <input type="hidden" name="idindikator" id="idindikator">

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="capaian" class="form-label">Capaian Kegiatan</label>
                            <textarea class="form-control" name="capaian" id="capaian" rows="2" placeholder="Apa yang akan dicapai dari kegiatan ini?"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="target_capaian" class="form-label">Target Capain</label>
                            <input type="text" class="form-control" name="target_capaian" id="target_capaian" placeholder="Target capaian">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="satuan_capaian" class="form-label">Satuan Capaian</label>
                            <input type="text" class="form-control" name="satuan_capaian" id="satuan_capaian" placeholder="Satuan capaian">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="keluaran" class="form-label">Outcome/Keluaran Kegiatan</label>
                            <textarea class="form-control" name="keluaran" id="keluaran" rows="2" placeholder="Apa otucome/keluaran dari kegiatan ini?"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="target_keluaran" class="form-label">Target Outcome</label>
                            <input type="text" class="form-control" name="target_keluaran" id="target_keluaran" placeholder="Target outcome">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="satuan_keluaran" class="form-label">Satuan Outcome</label>
                            <input type="text" class="form-control" name="satuan_keluaran" id="satuan_keluaran" placeholder="Satuan outcome">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="hasil" class="form-label">Hasil Kegiatan</label>
                            <textarea class="form-control" name="hasil" id="hasil" rows="2" placeholder="Apa hasil dari kegiatan ini?"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="target_hasil" class="form-label">Target Outcome</label>
                            <input type="text" class="form-control" name="target_hasil" id="target_hasil" placeholder="Target hasil">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="satuan_hasil" class="form-label">Satuan Outcome</label>
                            <input type="text" class="form-control" name="satuan_hasil" id="satuan_hasil" placeholder="Satuan hasil">
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
