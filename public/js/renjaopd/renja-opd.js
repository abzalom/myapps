$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //fix modal force focus
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
        var that = this;
        $(document).on('focusin.modal', function (e) {
            if ($(e.target).hasClass('select2')) {
                return true;
            }

            if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
                that.$element.focus();
            }
        });
    };


    $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
    });

    $('#renjaTambahModal #addBidang').on('change', function () {
        $('#renjaTambahModal #addProgram').html('<option value="" selected>Pilih program</option>');
        $('#renjaTambahModal #addUrusan').val($(this).find(':selected').data('urusan'));
        idBid = $(this).val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/program/api/renja/" + idBid,
            dataType: "json",
            success: function (data) {
                $('#renjaTambahModal #addProgram').removeAttr('disabled');
                $.each(data, function (progkey, program) {
                    $('#renjaTambahModal #addProgram').append('<option value="' + program.id + '">' + program.kode_unik_program + ' - ' + program.uraian_program + '</option>');
                });
            }
        });
    });

    $('#renjaTambahModal #addProgram').on('change', function () {
        $('#renjaTambahModal #addKegiatan').html('<option value="" selected>Pilih kegiatan</option>');
        idProg = $(this).val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/kegiatan/api/renja/" + idProg,
            dataType: "json",
            success: function (data) {
                $('#renjaTambahModal #addKegiatan').removeAttr('disabled');
                $.each(data, function (kegKey, kegiatan) {
                    $('#renjaTambahModal #addKegiatan').append('<option value="' + kegiatan.id + '">' + kegiatan.kode_unik_kegiatan + ' - ' + kegiatan.uraian_kegiatan + '</option>');
                });
            }
        });
    });

    $('#renjaTambahModal #addKegiatan').on('change', function () {
        $('#renjaTambahModal #addSubkegiatan').html('');
        idKeg = $(this).val();
        idOpd = $('#renjaTambahModal #addOpd').val();

        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/subkegiatan/api/renja/" + idKeg + '/opd/' + idOpd,
            dataType: "json",
            success: function (data) {
                $('#renjaTambahModal #addSubkegiatan').removeAttr('disabled');
                $.each(data, function (subkegKey, subkeg) {
                    $('#renjaTambahModal #addSubkegiatan').append('<option value="' + subkeg.id + '">' + subkeg.kode_unik_sub_kegiatan + ' - ' + subkeg.uraian_sub_kegiatan + '</option>');
                });
            }
        });
    });

    $('.subindikator').on('click', function () {
        subkeg = $(this).val();
        renja = $(this).data('renja');
        $('#addRrincianSubModal #subkegiatan').val(subkeg);
        $('#addRrincianSubModal #renja').val(renja);
    });

    $('.edit-subindikator').on('click', function () {
        id = $(this).val();
        $('#editSubIndikatorModal #editSumberdana').find(':selected').removeAttr('selected');
        $('#editSubIndikatorModal #editPenerimaManfaat').find(':selected').removeAttr('selected');
        $('#editSubIndikatorModal #editLokasi').find(':selected').removeAttr('selected');
        $('#editSubIndikatorModal #editKlasifikasi').find(':selected').removeAttr('selected');
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/indikator/api/" + id,
            dataType: "json",
            success: function (data) {
                $('#editSubIndikatorModal #id').val(id);
                $('#editSubIndikatorModal #editUrusan').val(data.a_urusan_id);
                $('#editSubIndikatorModal #editBidang').val(data.b_bidang_id);
                $('#editSubIndikatorModal #editProgram').val(data.c_program_id);
                $('#editSubIndikatorModal #editKegiatan').val(data.d_kegiatan_id);
                $('#editSubIndikatorModal #editSubkegiatan').val(data.e_sub_kegiatan_id);
                $('#editSubIndikatorModal #editRenja').val(data.i_renja_id);
                $('#editSubIndikatorModal #editRincian').val(data.rincian);
                $('#editSubIndikatorModal #editIndikator').val(data.indikator);
                $('#editSubIndikatorModal #editTarget').val(data.target);
                $('#editSubIndikatorModal #editSatuan').val(data.satuan);
                $('#editSubIndikatorModal #editAnggaran').val(data.anggaran);
                $('#editSubIndikatorModal #editSumberdana option').each(function () {
                    $(this).removeAttr('selected')
                    if (data.j_sumberdana_id == $(this).val()) {
                        $(this).removeAttr('selected')
                        $(this).attr('selected', 'selected')
                    }
                });
                $('#editSubIndikatorModal #editPenerimaManfaat option').each(function () {
                    $(this).removeAttr('selected')
                    if (data.j_penerima_manfaat_id == $(this).val()) {
                        $(this).removeAttr('selected')
                        $(this).attr('selected', 'selected')
                    }
                });
                $.each(data.lokasi, function (indexlok, lokasi) {
                    $('#editSubIndikatorModal #editLokasi option').each(function () {
                        if (lokasi.id == $(this).val()) {
                            $(this).attr('selected', 'selected')
                        }
                    });
                });
                $('#editSubIndikatorModal #editMulai option').each(function () {
                    $(this).removeAttr('selected')
                    if (data.mulai == $(this).val()) {
                        $(this).removeAttr('selected')
                        $(this).attr('selected', 'selected')
                    }
                });
                $('#editSubIndikatorModal #editSelesai option').each(function () {
                    $(this).removeAttr('selected')
                    if (data.selesai == $(this).val()) {
                        $(this).removeAttr('selected')
                        $(this).attr('selected', 'selected')
                    }
                });
                $('#editSubIndikatorModal #editKlasifikasi option').each(function () {
                    $(this).removeAttr('selected')
                    if (data.j_klasigikasi_id == $(this).val()) {
                        $(this).removeAttr('selected')
                        $(this).attr('selected', 'selected')
                    }
                });
                $('#editSubIndikatorModal #editKeterangan').val(data.keterangan);

                $('.select2-container').remove();
                $('.select2').each(function () {
                    $(this).select2({
                        theme: "bootstrap-5",
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        dropdownParent: $(this).parent(), // fix select2 search input focus bug
                    });
                });
            }
        });
    });

    $('.edit-renja').on('click', function () {
        renja = $(this).val();
        $('#idRenja').val(renja);
        $.get("/renja/edit/" + renja,
            function (data, textStatus, jqXHR) {
                $('#editRenjaModalLabel').html(data.subkegiatan.uraian_sub_kegiatan);
                $('#editRenjaModal #prioritasNasional option').each(function () {
                    $(this).removeAttr('selected')
                    if ($(this).val() == data.prioritas_nasional_id) {
                        $(this).removeAttr('selected');
                        $(this).attr('selected', 'selected');
                    };
                });
                $('.select2-container').remove();
                $('.select2').each(function () {
                    $(this).select2({
                        theme: "bootstrap-5",
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        dropdownParent: $(this).parent(), // fix select2 search input focus bug
                    });
                });
            },
            "JSON"
        );
    });

    $('.edit-kegiatan').on('click', function () {
        renja = $(this).data('renja');
        kegUnik = $(this).data('kegiatan');
        $('#editKinerjaKegiatanModal #idRenja').val(renja);
        $('#editKinerjaKegiatanModal #kegiatan').val(kegUnik);
        $.post("/kinerja/api/kegiatan/", {
                "kode": kegUnik
            },
            function (data, textStatus, jqXHR) {
                if (data !== "") {
                    $('#editKinerjaKegiatanModal #capaian').val(data.capaian);
                    $('#editKinerjaKegiatanModal #target_capaian').val(data.target_capaian);
                    $('#editKinerjaKegiatanModal #satuan_capaian').val(data.satuan_capaian);
                    $('#editKinerjaKegiatanModal #keluaran').val(data.keluaran);
                    $('#editKinerjaKegiatanModal #target_keluaran').val(data.target_keluaran);
                    $('#editKinerjaKegiatanModal #satuan_keluaran').val(data.satuan_keluaran);
                    $('#editKinerjaKegiatanModal #hasil').val(data.hasil);
                    $('#editKinerjaKegiatanModal #target_hasil').val(data.target_hasil);
                    $('#editKinerjaKegiatanModal #satuan_hasil').val(data.satuan_hasil);
                }
                if (data == "") {
                    $('#editKinerjaKegiatanModal #capaian').val('');
                    $('#editKinerjaKegiatanModal #target_capaian').val('');
                    $('#editKinerjaKegiatanModal #satuan_capaian').val('');
                    $('#editKinerjaKegiatanModal #keluaran').val('');
                    $('#editKinerjaKegiatanModal #target_keluaran').val('');
                    $('#editKinerjaKegiatanModal #satuan_keluaran').val('');
                    $('#editKinerjaKegiatanModal #hasil').val('');
                    $('#editKinerjaKegiatanModal #target_hasil').val('');
                    $('#editKinerjaKegiatanModal #satuan_hasil').val('');
                }
            },
        );
    });

    $('.edit-program').on('click', function () {
        renja = $(this).data('renja');
        progUnik = $(this).data('program');
        $('#editKinerjaProgramModal #idRenja').val(renja);
        $('#editKinerjaProgramModal #program').val(progUnik);

        $.post("/kinerja/api/program/", {
                'kode': progUnik
            },
            function (data, textStatus, jqXHR) {
                console.log(data);
                if (data !== "") {
                    $('#editKinerjaProgramModal #sasaran').val(data.sasaran);
                    $('#editKinerjaProgramModal #capaian').val(data.capaian);
                    $('#editKinerjaProgramModal #target').val(data.target);
                    $('#editKinerjaProgramModal #satuan').val(data.satuan);
                }
                if (data == "") {
                    $('#editKinerjaProgramModal #sasaran').val('');
                    $('#editKinerjaProgramModal #capaian').val('');
                    $('#editKinerjaProgramModal #target').val('');
                    $('#editKinerjaProgramModal #satuan').val('');
                }
            },
        );
    });

    $('.renja-status').on('click', function () {
        indikator = $(this).val();
        $('#renjaStatusModalLabel').html($(this).data('uraian'));
        $('#indikatorId').val(indikator);
    });

});
