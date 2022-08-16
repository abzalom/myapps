$(document).ready(function () {
    // console.clear();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var select2 = $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
    });

    $('.select2-editsub').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $('#editSubRincianModal'), // fix select2 search input focus bug
    });

    $('#tambahRenjaModal').on('hidden.bs.modal', function () {
        $('#addRenjaLoading').show();
        $('#addRenjaShow').hide();
        $('#tambahRenjaModal #bidang').html('')
        $('#tambahRenjaModal #program').html('')
        $('#tambahRenjaModal #kegiatan').html('')
        $('#tambahRenjaModal #subkegiatan').html('')
        $('#tambahRenjaModal #program').prop('disabled', true)
        $('#tambahRenjaModal #kegiatan').prop('disabled', true)
        $('#tambahRenjaModal #subkegiatan').prop('disabled', true)
    })
    $('#tambahRenjaModal').on('shown.bs.modal', function () {
        idopd = $('#tambahRenjaModal #idopd').val();
        $('#tambahRenjaModal #bidang').html('<option value="" selected>Pilih Bidang</option>')
        $.ajax({
            type: "get",
            url: "/api/renja/add/bidang/" + idopd,
            beforeSend: function () {
                $('#addRenjaLoading').show();
                $('#addRenjaShow').hide();
            },
            complete: function () {
                $('#addRenjaLoading').hide();
                $('#addRenjaShow').show();
            },
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (key, val) {
                    $('#tambahRenjaModal #bidang').append('<option value="' + val.id + '">' + val.kode_unik_bidang + ' - ' + val.uraian + '</option>')
                });
            }
        });
    });

    $('#tambahRenjaModal #bidang').on('change', function () {
        idbid = $(this).val();
        $('#tambahRenjaModal #program').removeAttr('disabled');
        $('#tambahRenjaModal #program').html('<option value="" selected>Pilih Program</option>');
        $('#tambahRenjaModal #kegiatan').html('')
        $('#tambahRenjaModal #subkegiatan').html('')
        $('#tambahRenjaModal #kegiatan').prop('disabled', true)
        $('#tambahRenjaModal #subkegiatan').prop('disabled', true)
        $.ajax({
            type: "get",
            url: "/api/renja/add/program/" + idbid,
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (key, val) {
                    $('#tambahRenjaModal #program').append('<option value="' + val.id + '">' + val.kode_unik_program + ' - ' + val.uraian + '</option>')
                });
            }
        });
    })
    $('#tambahRenjaModal #program').on('change', function () {
        idprog = $(this).val();
        $('#tambahRenjaModal #kegiatan').removeAttr('disabled');
        $('#tambahRenjaModal #kegiatan').html('<option value="" selected>Pilih kegiatan</option>');
        $('#tambahRenjaModal #subkegiatan').html('')
        $('#tambahRenjaModal #subkegiatan').prop('disabled', true)
        $.ajax({
            type: "get",
            url: "/api/renja/add/kegiatan/" + idprog,
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (key, val) {
                    $('#tambahRenjaModal #kegiatan').append('<option value="' + val.id + '">' + val.kode_unik_kegiatan + ' - ' + val.uraian + '</option>')
                });
            }
        });
    })
    $('#tambahRenjaModal #kegiatan').on('change', function () {
        idkeg = $(this).val();
        idopd = $('#tambahRenjaModal #idopd').val();
        $('#tambahRenjaModal #subkegiatan').removeAttr('disabled');
        $('#tambahRenjaModal #subkegiatan').html('<option value="" selected>Pilih Sub Kegiatan</option>');
        $.ajax({
            type: "get",
            url: "/api/renja/add/subkegiatan/" + idkeg + "/opd/" + idopd,
            dataType: "JSON",
            success: function (data) {
                $.each(data, function (key, val) {
                    $('#tambahRenjaModal #subkegiatan').append('<option value="' + val.id + '">' + val.kode_unik_subkegiatan + ' - ' + val.uraian + '</option>')
                });
            }
        });
    })
    $('#tambahRenjaModal #subkegiatan').on('change', function () {
        idkeg = $(this).val();
        $('#tambahRenjaModal #prionas').removeAttr('disabled');
        $('#tambahRenjaModal #prionas').html('<option value="" selected>Pilih Prioritas Nasional</option>');
        $('#tambahRenjaModal #prioprov').removeAttr('disabled');
        $('#tambahRenjaModal #prioprov').html('<option value="" selected>Pilih Prioritas Provinsi</option>');
        $('#tambahRenjaModal #prioda').removeAttr('disabled');
        $('#tambahRenjaModal #prioda').html('<option value="" selected>Pilih Prioritas Daerah</option>');
        $.ajax({
            type: "get",
            url: "/api/renja/add/prioritas",
            dataType: "JSON",
            success: function (data) {
                if (data.nasional !== null) {
                    $.each(data.nasional, function (key, val) {
                        $('#tambahRenjaModal #prionas').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
                if (data.provinsi !== null) {
                    $.each(data.provinsi, function (key, val) {
                        $('#tambahRenjaModal #prioprov').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
                if (data.daerah !== null) {
                    $.each(data.daerah, function (key, val) {
                        $('#tambahRenjaModal #prioda').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
            }
        });
    });

    $('.indikator-program').on('click', function () {
        idprog = $(this).data('idprog');
        kodeprog = $(this).data('kodeprog');
        idopd = $(this).data('idopd');
        prog = $(this).data('prog');

        $('#addIndikatorProgamModal #idprog').val(idprog);
        $('#addIndikatorProgamModal #kodeprog').val(kodeprog);
        $('#addIndikatorProgamModal #addIndikatorProgamModalLabel').html(prog);

        $.ajax({
            type: "get",
            url: "/api/renja/get/prioritas/prog/" + idprog + "/opd/" + idopd + "",
            dataType: "JSON",
            success: function (data) {
                if (data.status == 'success') {
                    $('#addIndikatorProgamModal #idindikator').val(data.data.id);
                } else {
                    $('#addIndikatorProgamModal #idindikator').val(null);
                }
                $('#addIndikatorProgamModal #sasaran').val(data.data.sasaran);
                $('#addIndikatorProgamModal #capaian').val(data.data.capaian);
                $('#addIndikatorProgamModal #target').val(data.data.target);
                $('#addIndikatorProgamModal #satuan').val(data.data.satuan);
            },
        });
    });

    $('#addIndikatorProgamModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#addIndikatorProgamModal #idindikator').val('');
    });

    $('.indikator-kegiatan').on('click', function () {
        idopd = $(this).data('idopd');
        idkeg = $(this).data('idkeg');
        kodekeg = $(this).data('kodekeg');
        keg = $(this).data('keg');

        $('#addIndikatorKegiatanModal #idkeg').val(idkeg);
        $('#addIndikatorKegiatanModal #kodekeg').val(kodekeg);
        $('#addIndikatorKegiatanModal #addIndikatorKegiatanModalLabel').html(keg)

        $.ajax({
            type: "get",
            url: "/api/renja/get/prioritas/keg/" + idkeg + "/opd/" + idopd + "",
            dataType: "JSON",
            success: function (data) {
                if (data.status == 'success') {
                    $('#addIndikatorKegiatanModal #idindikator').val(data.data.id);
                } else {
                    $('#addIndikatorKegiatanModal #idindikator').val(null);
                }
                $('#addIndikatorKegiatanModal #capaian').val(data.data.capaian)
                $('#addIndikatorKegiatanModal #target_capaian').val(data.data.target_capaian)
                $('#addIndikatorKegiatanModal #satuan_capaian').val(data.data.satuan_capaian)
                $('#addIndikatorKegiatanModal #keluaran').val(data.data.keluaran)
                $('#addIndikatorKegiatanModal #target_keluaran').val(data.data.target_keluaran)
                $('#addIndikatorKegiatanModal #satuan_keluaran').val(data.data.satuan_keluaran)
                $('#addIndikatorKegiatanModal #hasil').val(data.data.hasil)
                $('#addIndikatorKegiatanModal #target_hasil').val(data.data.target_hasil)
                $('#addIndikatorKegiatanModal #satuan_hasil').val(data.data.satuan_hasil)
            }
        });
    });

    $('#addIndikatorKegiatanModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#addIndikatorKegiatanModal #idindikator').val('');
    });

    $('.indikator-subkegiatan').on('click', function () {
        idsubkeg = $(this).val();
        idranwal = $(this).data('idranwal');
        idopd = $(this).data('idopd');
        idbid = $(this).data('idbid');

        $('#addSubRincianModal #sumberdana').html('<option value="0" selected>Pilih...</option>');
        $('#addSubRincianModal #klasifikasi').html('<option value="0" selected>Pilih...</option>');
        $('#addSubRincianModal #penerima_manfaat').html('<option value="0" selected>Pilih...</option>');
        $('#addSubRincianModal #lokasi').html('');
        $('#addSubRincianModal #jenis').html('<option value="0" selected>Pilih...</option>');
        $('#addSubRincianModal #mulai').html('<option value="0" selected>Pilih...</option>');
        $('#addSubRincianModal #selesai').html('<option value="0" selected>Pilih...</option>');

        $.getJSON("/nomen/api/subkegiatan/" + idsubkeg,
            function (data) {
                console.log(data.satuan);
                $('#addSubRincianModal #idurusan').val(data.a1_urusan_id);
                $('#addSubRincianModal #idbid').val(data.a2_bidang_id);
                $('#addSubRincianModal #idprog').val(data.a3_program_id);
                $('#addSubRincianModal #idkeg').val(data.a4_kegiatan_id);
                $('#addSubRincianModal #idsubkeg').val(data.id);
                $('#addSubRincianModal #idranwal').val(idranwal);
                $('#addSubRincianModal #idopd').val(idopd);
                $('#addSubRincianModal #addSubRincianModalLabel').html(data.kode_unik_subkegiatan + ' - ' + data.uraian);
                $('#addSubRincianModal #indikatorShow').val(data.indikator);
                $('#addSubRincianModal #indikator').val(data.indikator);
                $('#addSubRincianModal #satuanShow').val(data.satuan);
                $('#addSubRincianModal #satuan').val(data.satuan);
            }
        );

        $.getJSON("/api/renja/sumberdana/opd/" + idopd + '/bidang/' + idbid,
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianModal #sumberdana').append('<option value="' + val.id + '">' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                });
            }
        );
        $.getJSON("/api/data/get/klasifikasi",
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianModal #klasifikasi').append('<option value="' + val.id + '">' + firtWords(val.uraian) + '</option>');
                });
            }
        );
        $.getJSON("/api/data/get/penerimamanfaat",
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianModal #penerima_manfaat').append('<option value="' + val.id + '">' + firtWords(val.uraian) + '</option>');
                });
            }
        );
        $.getJSON("/api/data/get/kalender",
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianModal #mulai').append('<option value="' + val.id + '">' + firtWords(val.bulan) + '</option>');
                    $('#addSubRincianModal #selesai').append('<option value="' + val.id + '">' + firtWords(val.bulan) + '</option>');
                });
            }
        );
        $.getJSON("/api/data/get/lokasi",
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianModal #lokasi').append('<option value="' + val.id + '">' + firtWords(val.lokasi) + '</option>');
                });
            }
        );
        $('#addSubRincianModal #jenis').append('<option value="1">Fisik</option><option value="2">Non Fisik</option>');
    });

    $('#addSubRincianModal').on('shown.bs.modal', function () {
        // $(this).on('load', function () {
        $('#addSubRincianModal #loadform').delay(400).fadeOut(400, function () {
            $('#addSubRincianModal #showform').fadeIn(400);
        })
        // })
    });
    $('#addSubRincianModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#addSubRincianModal #loadform').show();
        $('#addSubRincianModal #showform').hide();
        $('#addSubRincianModal #sumberdana').html('');
        $('#addSubRincianModal #klasifikasi').html('');
        $('#addSubRincianModal #penerima_manfaat').html('');
        $('#addSubRincianModal #lokasi').html('');
        $('#addSubRincianModal #jenis').html('');
        $('#addSubRincianModal #mulai').html('');
        $('#addSubRincianModal #selesai').html('');
    });

    // return;

    // Edit Sub Rincian
    $('.edit-indikator-subkegiatan').on('click', function () {
        idindikator = $(this).val();

        $('#editSubRincianModal #sumberdanaEdit').html('<option value="0" selected>Pilih...</option>');
        $('#editSubRincianModal #klasifikasiEdit').html('<option value="0" selected>Pilih...</option>');
        $('#editSubRincianModal #penerima_manfaatEdit').html('<option value="0" selected>Pilih...</option>');
        $('#editSubRincianModal #lokasiEdit').html('');
        $('#editSubRincianModal #jenisEdit').html('<option value="0" selected>Pilih...</option>');
        $('#editSubRincianModal #mulaiEdit').html('<option value="0" selected>Pilih...</option>');
        $('#editSubRincianModal #selesaiEdit').html('<option value="0" selected>Pilih...</option>');

        $.getJSON("/api/renja/indikatorsubkeg/" + idindikator,
            function (response) {
                indikator = response.data;
                $('#editSubRincianModal #idindikatorEdit').val(indikator.id);
                $('#editSubRincianModal #editSubRincianModalLabel').html(indikator.rincian);
                $('#editSubRincianModal #rincianEdit').val(indikator.rincian);
                $('#editSubRincianModal #indikatorEdit').val(indikator.indikator);
                $('#editSubRincianModal #targetEdit').val(indikator.target);
                $('#editSubRincianModal #satuanEdit').val(indikator.satuan);
                $('#editSubRincianModal #anggaranEdit').val(parseInt(indikator.anggaran));
                $('#editSubRincianModal #tahunEdit').val(indikator.tahun);
                $('#editSubRincianModal #keteranganEdit').val(indikator.keterangan);

                $.getJSON("/api/renja/sumberdana/opd/" + indikator.f1_perangkat_id + '/bidang/' + indikator.a2_bidang_id,
                    function (data) {
                        $.each(data, function (key, val) {
                            if (val.id == indikator.sumberdanaranwal.id) {
                                $('#editSubRincianModal #sumberdanaEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                            } else {
                                $('#editSubRincianModal #sumberdanaEdit').append('<option value="' + val.id + '">' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                            }
                        });
                    }
                );
                $.getJSON("/api/data/get/klasifikasi",
                    function (data) {
                        $.each(data, function (key, val) {
                            if (val.id == indikator.e_klasifikasi_id) {
                                $('#editSubRincianModal #klasifikasiEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.uraian) + '</option>');
                            } else {
                                $('#editSubRincianModal #klasifikasiEdit').append('<option value="' + val.id + '">' + firtWords(val.uraian) + '</option>');
                            }
                        });
                    }
                );
                $.getJSON("/api/data/get/penerimamanfaat",
                    function (data) {
                        $.each(data, function (key, val) {
                            if (val.id == indikator.e_penerima_manfaat_id) {
                                $('#editSubRincianModal #penerima_manfaatEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.uraian) + '</option>');
                            } else {
                                $('#editSubRincianModal #penerima_manfaatEdit').append('<option value="' + val.id + '">' + firtWords(val.uraian) + '</option>');
                            }
                        });
                    }
                );
                $.getJSON("/api/data/get/kalender",
                    function (data) {
                        $.each(data, function (key, val) {
                            if (val.id == indikator.mulai) {
                                $('#editSubRincianModal #mulaiEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.bulan) + '</option>');
                            } else {
                                $('#editSubRincianModal #mulaiEdit').append('<option value="' + val.id + '">' + firtWords(val.bulan) + '</option>');
                            }
                            if (val.id == indikator.selesai) {
                                $('#editSubRincianModal #selesaiEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.bulan) + '</option>');
                            } else {
                                $('#editSubRincianModal #selesaiEdit').append('<option value="' + val.id + '">' + firtWords(val.bulan) + '</option>');
                            }
                        });
                    }
                );
                $.getJSON("/api/data/get/lokasi",
                    function (data) {
                        arr_lokasi = [];
                        $.each(indikator.lokasiranwal, function (lokkey, lokval) {
                            arr_lokasi.push(lokval.e_lokasi_id);
                        });
                        $.each(data, function (key, val) {
                            if (arr_lokasi.includes(val.id)) {
                                console.log(arr_lokasi);
                                console.log(val.id);
                                $('#editSubRincianModal #lokasiEdit').append('<option value="' + val.id + '" selected>' + firtWords(val.lokasi) + '</option>');
                            } else {
                                $('#editSubRincianModal #lokasiEdit').append('<option value="' + val.id + '">' + firtWords(val.lokasi) + '</option>');
                            }
                        });
                    }
                );
                if (indikator.e_jenis_pekerjaan_id == 1) {
                    $('#editSubRincianModal #jenisEdit').html('<option value="0">Pilih...</option><option value="1" selected>Fisik</option><option value="2">Non Fisik</option>');
                } else {
                    $('#editSubRincianModal #jenisEdit').html('<option value="0">Pilih...</option><option value="1">Fisik</option><option value="2" selected>Non Fisik</option>');
                }
            }
        );
    });


    $('#editSubRincianModal').on('shown.bs.modal', function () {
        $('#editSubRincianModal #loadform').delay(600).fadeOut(600, function () {
            $('#editSubRincianModal #showform').fadeIn(600);
        })
    });
    $('#editSubRincianModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $('#editSubRincianModal #loadform').show();
        $('#editSubRincianModal #showform').hide();
        $('#editSubRincianModal #sumberdanaEdit').html('');
        $('#editSubRincianModal #klasifikasiEdit').html('');
        $('#editSubRincianModal #penerima_manfaatEdit').html('');
        $('#editSubRincianModal #jenisEdit').html('');
        $('#editSubRincianModal #lokasiEdit').html('');
        $('#editSubRincianModal #mulaiEdit').html('');
        $('#editSubRincianModal #selesaiEdit').html('');
    });

    $('.delete-indikator-subkegiatan').on('click', function () {
        idindikator = $(this).val();
        rincian = $(this).data('rincian');
        $('#deleteSubRincianModal #idindikatorDelete').val(idindikator);
        $('#deleteSubRincianModal #rincianDelete').html(rincian);
    });

    $('.delete-renja').on('click', function () {
        idranwal = $(this).val();
        subkeguraian = $(this).data('subkeguraian');
        $('#deleteRenjaModal #idranwalDelete').val(idranwal);
        $('#deleteRenjaModal #ranwalDelete').html(subkeguraian);
    });


    /**
     *
     * Rutin Script
     *
     *  */
    $('#addRutinModal').on('shown.bs.modal', function () {
        idopd = $('#addRutinModal #idopdRutin').val();
        $('#addRutinModal #kegiatanRutin').html('<option value="0" selected>Pilih...</option>');
        $('#addRutinModal #addRutinLoading').delay(600).fadeOut(600, function () {
            $('#addRutinModal #addRutinShow').fadeIn(600);
        });

        $.getJSON("/api/rutin/kegiatan/",
            function (data, textStatus, jqXHR) {
                $.each(data, function (rutinkegkey, rutinkegval) {
                    $('#addRutinModal #kegiatanRutin').append('<option value="' + rutinkegval.id + '" data-idopd="' + idopd + '">' + rutinkegval.kode_unik_kegiatan + ' - ' + rutinkegval.uraian + '</option>');
                });
            }
        );
    });
    $('#addRutinModal #kegiatanRutin').on('change', function () {
        idkeg = $(this).val();
        idopd = $(this).find(':selected').data('idopd');
        $('#addRutinModal #subkegiatanRutin').attr('disabled', false);
        $('#addRutinModal #subkegiatanRutin').html('<option value="0" selected>Pilih...</option>');
        $('#addRutinModal #prionasRutin').attr('disabled', true);
        $('#addRutinModal #prioprovRutin').attr('disabled', true);
        $('#addRutinModal #priodaRutin').attr('disabled', true);
        $('#addRutinModal #prionasRutin').html('');
        $('#addRutinModal #prioprovRutin').html('');
        $('#addRutinModal #priodaRutin').html('');
        $.getJSON("/api/rutin/subkegiatan/" + idkeg + "/opd/" + idopd,
            function (data, textStatus, jqXHR) {
                $.each(data, function (subkegrutinkey, subkegrutinval) {
                    $('#addRutinModal #subkegiatanRutin').append('<option value="' + subkegrutinval.id + '">' + subkegrutinval.kode_unik_subkegiatan + ' - ' + subkegrutinval.uraian + '</option>');
                });
            }
        );
    });

    $('#addRutinModal #subkegiatanRutin').on('change', function () {
        $('#addRutinModal #prionasRutin').attr('disabled', false);
        $('#addRutinModal #prioprovRutin').attr('disabled', false);
        $('#addRutinModal #priodaRutin').attr('disabled', false);
        $('#addRutinModal #prionasRutin').html('<option value="" selected>Pilih Prioritas Nasional</option>');
        $('#addRutinModal #prioprovRutin').html('<option value="" selected>Pilih Prioritas Provinsi</option>');
        $('#addRutinModal #priodaRutin').html('<option value="" selected>Pilih Prioritas Daerah</option>');
        $.ajax({
            type: "get",
            url: "/api/renja/add/prioritas",
            dataType: "JSON",
            success: function (data) {
                if (data.nasional !== null) {
                    $.each(data.nasional, function (key, val) {
                        $('#addRutinModal #prionasRutin').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
                if (data.provinsi !== null) {
                    $.each(data.provinsi, function (key, val) {
                        $('#addRutinModal #prioprovRutin').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
                if (data.daerah !== null) {
                    $.each(data.daerah, function (key, val) {
                        $('#addRutinModal #priodaRutin').append('<option value="' + val.id + '">' + val.kode + '. ' + val.uraian + '</option>')
                    });
                }
            }
        });
    });

    $('#addRutinModal').on('hidden.bs.modal', function () {
        $('#addRutinModal #addRutinLoading').show();
        $('#addRutinModal #addRutinShow').hide();
        $('#addRutinModal #kegiatanRutin').html('');
        $('#addRutinModal #subkegiatanRutin').html('');
        $('#addRutinModal #subkegiatanRutin').attr('disabled', true);
        $('#addRutinModal #prionasRutin').attr('disabled', true);
        $('#addRutinModal #prioprovRutin').attr('disabled', true);
        $('#addRutinModal #priodaRutin').attr('disabled', true);
        $('#addRutinModal #prionasRutin').html('');
        $('#addRutinModal #prioprovRutin').html('');
        $('#addRutinModal #priodaRutin').html('');
    });

    $('.delete-subkegiatan-rutin').on('click', function () {
        idranwalrutin = $(this).data('idranwalrutin');
        ranwalrutin = $(this).data('ranwalrutin');
        $('#deleteRenjaRutinModal #idranwalRutinDelete').val(idranwalrutin);
        $('#deleteRenjaRutinModal #ranwalRutinDelete').html(ranwalrutin);
    })


    /**
     * Sub Rincian Rutin OPD
     */

    $('#addSubRincianRutinModal').on('shown.bs.modal', function () {
        $('#addSubRincianRutinModal #loadformSubrincianRutin').delay(600).fadeOut(600, function () {
            $('#addSubRincianRutinModal #showformSubrincianRutin').fadeIn(600);
        });
    });

    $('.add-subrincian-rutin').on('click', function () {
        idsubkeg = $(this).data('idsubkeg');
        idranwalrutin = $(this).data('idranwalrutin');
        idopd = $(this).data('idopd');
        idbidang = $(this).data('idbidang');

        $('#addSubRincianRutinModal #idranwalSubRutin').val(idranwalrutin);
        $('#addSubRincianRutinModal #idsubkegSubRutin').val(idsubkeg);
        $('#addSubRincianRutinModal #idbidangRutin').val(idbidang);
        $.get("/api/rutin/subkegiatan/" + idsubkeg,
            function (data, textStatus, jqXHR) {
                $('#addSubRincianRutinModal #addSubRincianRutinModalLabel').html('X.XX.' + data.kode_unik_subkegiatan + ' - ' + data.uraian);
                $('#addSubRincianRutinModal #indikatorSubRutin').val(data.indikator);
                $('#addSubRincianRutinModal #satuanSubRutin').val(data.satuan);
                $('#addSubRincianRutinModal #idprogSubRutin').val(data.a6_program_rutin_id);
                $('#addSubRincianRutinModal #idkegSubRutin').val(data.a7_kegiatan_rutin_id);
            },
            "JSON"
        );
        $.getJSON("/api/renja/sumberdana/opd/" + idopd + '/bidang/' + idbidang,
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianRutinModal #sumberdanaSubRutin').append('<option value="' + val.id + '">' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                });
            }
        );
        $.getJSON("/api/data/get/lokasi",
            function (data) {
                $.each(data, function (key, val) {
                    $('#addSubRincianRutinModal #lokasiSubRutin').append('<option value="' + val.id + '">' + firtWords(val.lokasi) + '</option>');
                });
            }
        );
        $('#addSubRincianRutinModal #jenisSubRutin').html('<option value="1">Fisik</option><option value="2">Non Fisik</option>');
    });

    $('#addSubRincianRutinModal').on('hidden.bs.modal', function () {
        $('#addSubRincianRutinModal #loadformSubrincianRutin').show();
        $('#addSubRincianRutinModal #showformSubrincianRutin').hide();
        $('#addSubRincianRutinModal #addSubRincianRutinModalLabel').html('');
        $('#addSubRincianRutinModal #indikatorSubRutin').val('');
        $('#addSubRincianRutinModal #satuanSubRutin').val('');
        $('#addSubRincianRutinModal #sumberdanaSubRutin').html('');
        $('#addSubRincianRutinModal #lokasiSubRutin').html('');
        $('#addSubRincianRutinModal #jenisSubRutin').html('');
    });

    /**
     *
     * Edit sub rincian rutin
     *
     */

    $('#editSubRincianRutinModal').on('shown.bs.modal', function () {
        $('#editSubRincianRutinModal #loadformEditSubrincianRutin').delay(600).fadeOut(600, function () {
            $('#editSubRincianRutinModal #showformEditSubrincianRutin').fadeIn(600);
        });
    });

    $('.edit-subrincian-rutin').on('click', function () {
        idsubrincian = $(this).val();

        $.ajax({
            type: "get",
            url: "/api/rutin/subrincian/" + idsubrincian,
            dataType: "JSON",
            success: function (subrincian) {
                console.log(subrincian);
                $('#editSubRincianRutinModal #editSubRincianRutinModalLabel').html(subrincian.rincian);

                $('#editSubRincianRutinModal #idranwalEditSubRutin').val(subrincian.id);
                $('#editSubRincianRutinModal #rincianEditSubRutin').val(subrincian.rincian);
                $('#editSubRincianRutinModal #indikatorEditSubRutin').val(subrincian.subkegiatan.indikator);
                $('#editSubRincianRutinModal #satuanEditSubRutin').val(subrincian.subkegiatan.satuan);
                $('#editSubRincianRutinModal #targetEditSubRutin').val(subrincian.target);
                $('#editSubRincianRutinModal #anggaranEditSubRutin').val(parseInt(subrincian.anggaran));
                $('#editSubRincianRutinModal #keteranganEditSubRutin').val(subrincian.keterangan);

                // Sumber Dana
                $.getJSON("/api/renja/sumberdana/opd/" + subrincian.f1_perangkat_id + '/bidang/' + subrincian.a2_bidang_id,
                    function (data) {
                        $.each(data, function (key, val) {
                            if (val.id == subrincian.sumberdana.id) {
                                $('#editSubRincianRutinModal #sumberdanaEditSubRutin').append('<option value="' + val.id + '" selected>' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                            } else {
                                $('#editSubRincianRutinModal #sumberdanaEditSubRutin').append('<option value="' + val.id + '">' + firtWords(val.uraianpendapatanranwal.uraian) + '</option>');
                            }
                        });
                    }
                );

                // Lokasi
                $.getJSON("/api/data/get/lokasi",
                    function (data) {
                        arr_lokasi = [];
                        $.each(subrincian.lokasi, function (lokkey, lokval) {
                            arr_lokasi.push(lokval.e_lokasi_id);
                        });
                        $.each(data, function (key, val) {
                            if (arr_lokasi.includes(val.id)) {
                                $('#editSubRincianRutinModal #lokasiEditSubRutin').append('<option value="' + val.id + '" selected>' + firtWords(val.lokasi) + '</option>');
                            } else {
                                $('#editSubRincianRutinModal #lokasiEditSubRutin').append('<option value="' + val.id + '">' + firtWords(val.lokasi) + '</option>');
                            }
                        });
                    }
                );

                // Jenis Pekerjaan
                if (subrincian.e_jenis_pekerjaan_id == 1) {
                    $('#editSubRincianRutinModal #jenisEditSubRutin').html('<option value="1" selected>Fisik</option><option value="2">Non Fisik</option>');
                } else {
                    $('#editSubRincianRutinModal #jenisEditSubRutin').html('<option value="1">Fisik</option><option value="2" selected>Non Fisik</option>');
                }
            }
        });
    })

    $('#editSubRincianRutinModal').on('hidden.bs.modal', function () {
        $('#editSubRincianRutinModal #loadformEditSubrincianRutin').hide();
        $('#editSubRincianRutinModal #showformEditSubrincianRutin').show();
        $('#editSubRincianRutinModal #editSubRincianRutinModalLabel').html('');

        $('#editSubRincianRutinModal #idbidangEditSubRutin').val('');
        $('#editSubRincianRutinModal #idprogEditSubRutin').val('');
        $('#editSubRincianRutinModal #idkegEditSubRutin').val('');
        $('#editSubRincianRutinModal #idsubkegEditSubRutin').val('');
        $('#editSubRincianRutinModal #idranwalEditSubRutin').val('');

        $('#editSubRincianRutinModal #indikatorEditSubRutin').val('');
        $('#editSubRincianRutinModal #satuanEditSubRutin').val('');
        $('#editSubRincianRutinModal #targetEditSubRutin').val('');
        $('#editSubRincianRutinModal #keteranganEditSubRutin').val('');
        $('#editSubRincianRutinModal #anggaranEditSubRutin').val('');

        $('#editSubRincianRutinModal #sumberdanaEditSubRutin').html('');
        $('#editSubRincianRutinModal #lokasiEditSubRutin').html('');
        $('#editSubRincianRutinModal #jenisEditSubRutin').html('');
    });

    $('.delete-subrincian-rutin').on('click', function () {
        idranwalrutin = $(this).val();
        rincian = $(this).data('rincian');
        $('#deleteSubRincianRutinModal #rincianRutinDelete').html(firtWords(rincian));
        $('#deleteSubRincianRutinModal #idsubrincianrutinDelete').val(idranwalrutin);
    });

    $('#addIndikatorProgramRutinModal').on('shown.bs.modal', function () {
        $('#addIndikatorProgramRutinModal #addIndkatorProgramLoading').delay(600).fadeOut(600, function () {
            $('#addIndikatorProgramRutinModal #addIndkatorProgramShow').fadeIn(600);
        });
    });

    $('.indikator-program-rutin').on('click', function () {
        idindikator = $(this).val();
        if (idindikator !== '') {
            $.getJSON("/api/indikator/program/rutin/" + idindikator,
                function (data, textStatus, jqXHR) {
                    if (data !== null) {
                        $('#addIndikatorProgramRutinModal #idIndikatorProgRutin').val(data.id);
                        $('#addIndikatorProgramRutinModal #sasaranIndikatorProgRutin').val(data.sasaran);
                        $('#addIndikatorProgramRutinModal #capaianIndikatorProgRutin').val(data.capaian);
                        $('#addIndikatorProgramRutinModal #targetIndikatorProgRutin').val(data.target);
                        $('#addIndikatorProgramRutinModal #satuanIndikatorProgRutin').val(data.satuan);
                    }
                }
            );
        }
    })

    $('.indikator-kegiatan-rutin').on('click', function () {
        idkegiatan = $(this).val();
        kodekeg = $(this).data('kodekeg');
        namakeg = $(this).data('namakeg');
        idindikator = $(this).data('idindikator');
        $('#addIndikatorKegiatanRutinModal #idKegIndikatorKegRutin').val(idkegiatan);
        $('#addIndikatorKegiatanRutinModal #KodeUnikKegIndikatorKegRutin').val(kodekeg);
        $('#addIndikatorKegiatanRutinModal #addIndikatorKegiatanRutinModalLabel').html('X.XX.' + kodekeg + ' - ' + namakeg);

        if (idindikator !== "") {
            $.getJSON("/api/indikator/kegiatan/rutin/" + idindikator,
                function (data, textStatus, jqXHR) {
                    $('#addIndikatorKegiatanRutinModal #idIndikatorKegRutin').val(data.id)
                    $('#addIndikatorKegiatanRutinModal #capaianIndikatorKegRutin').val(data.capaian)
                    $('#addIndikatorKegiatanRutinModal #target_capaianIndikatorKegRutin').val(data.target_capaian)
                    $('#addIndikatorKegiatanRutinModal #satuan_capaianIndikatorKegRutin').val(data.satuan_capaian)
                    $('#addIndikatorKegiatanRutinModal #keluaranIndikatorKegRutin').val(data.keluaran)
                    $('#addIndikatorKegiatanRutinModal #target_keluaranIndikatorKegRutin').val(data.target_keluaran)
                    $('#addIndikatorKegiatanRutinModal #satuan_keluaranIndikatorKegRutin').val(data.satuan_keluaran)
                    $('#addIndikatorKegiatanRutinModal #hasilIndikatorKegRutin').val(data.hasil)
                    $('#addIndikatorKegiatanRutinModal #target_hasilIndikatorKegRutin').val(data.target_hasil)
                    $('#addIndikatorKegiatanRutinModal #satuan_hasilIndikatorKegRutin').val(data.satuan_hasil)
                }
            );
        }
    })

    $('#addIndikatorKegiatanRutinModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })
});
