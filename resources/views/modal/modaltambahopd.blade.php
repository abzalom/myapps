<!-- Modal -->
<div class="modal fade" id="tambahOpdModal" tabindex="-1" aria-labelledby="tambahOpdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="tambahOpdModalLabel">
                    Tambah OPD
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('opd.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="bidang1">Bidang Urusan Pemerintahan 1</label>
                        <select name="bidang1" class="form-control select2" id="bidang1" data-placeholder="Pilih bidang">
                            <option value=""></option>
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->id }}">{{ $bidang->kode_unik_bidang }} - {{ $bidang->uraian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="bidang2">Bidang Urusan Pemerintahan 2</label>
                        <select name="bidang2" class="form-control select2" id="bidang2" data-placeholder="Pilih bidang" disabled>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="bidang3">Bidang Urusan Pemerintahan 3</label>
                        <select name="bidang3" class="form-control select2" id="bidang3" data-placeholder="Pilih bidang" disabled>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="opd">Nama OPD</label>
                        <input type="text" name="opd" class="form-control" id="opd" placeholder="Nama OPD" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kode">Kode OPD</label>
                        <input type="number" name="kode" class="form-control" id="kode" placeholder="Kode OPD" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kelompok_bidang">Kelompok Bidang</label>
                        <select name="kelompok_bidang" class="form-control select2" id="kelompok_bidang">
                            <option value="">Pilih Bidang</option>
                            @foreach ($kelbidangs as $kelbid)
                                <option value="{{ $kelbid->id }}">BIDANG {{ strtoupper($kelbid->uraian) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark fa-xl"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk fa-xl"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
