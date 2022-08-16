<!-- Modal -->
<div class="modal fade" id="addPendapatanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPendapatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="addPendapatanModalLabel">
                    Tambah Pendapatan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pendapatan.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="c1_akun_lra_id" value="1">
                    <div class="mb-3">
                        <label class="form-label" for="kelompok">Kelompok</label>
                        <select name="c2_kelompok_lra_id" class="form-control select2" id="kelompok">
                            <option value="">Pilih..</option>
                            @foreach ($kelompoks as $kelompok)
                                <option value="{{ $kelompok->id }}">{{ $kelompok->kode_unik_kelompok }} - {{ $kelompok->uraian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis">Jenis</label>
                        <select name="c3_jenis_lra_id" class="form-control select2" id="jenis" disabled>
                            <option value="">Pilih..</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="objek">Objek</label>
                        <select name="c4_objek_lra_id" class="form-control select2" id="objek" disabled>
                            <option value="">Pilih..</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="rincian">Rincian</label>
                        <select name="c5_rincian_lra_id" class="form-control select2" id="rincian" disabled>
                            <option value="">Pilih..</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="subrincian">Subrincian</label>
                        <select name="c6_subrincian_lra_id" class="form-control select2" id="subrincian" disabled>
                            <option value="">Pilih..</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label" for="uraian">Uraian Komponen</label>
                        <textarea name="uraian" type="text" class="form-control" id="uraian" rows="3" placeholder="Uraian komponen pendapatan" disabled></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="anggaran">Jumlah Pendapatan</label>
                        <input name="anggaran" type="number" class="form-control" id="anggaran" placeholder="Rp. 000,00-" disabled>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark fa-xl"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk fa-xl"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
