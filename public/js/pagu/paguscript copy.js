$(document).ready(function () {
    // console.clear();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
    });

    $('.tambah-pagu').on('click', function () {
        idopd = $(this).val();
        namaopd = $(this).data('namaopd');
        $('#tambahPaguModal #tambahPaguModalLabel').html('Tambah pagu pada OPD ' + namaopd);
        $('#tambahPaguModal #idopd_baru').val(idopd);
        $.get("/ajax/opd/except/" + idopd,
            function (data, textStatus, jqXHR) {
                $('#tambahPaguModal #pindahanPagu #opd_pindahan').html(data);
            },
        );
    });

    $('#statusCheckBox').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('#tambahPaguModal #statusPagu').val('5');
            $('#tambahPaguModal #pindahanPagu').show();
            $('#tambahPaguModal #paguBaru').hide();

            // Tambah Attribute Name Pagu Pindahan
            $('#tambahPaguModal #pindahanPagu #opd_pindahan').attr('name', 'opd_pindahan');
            $('#tambahPaguModal #pindahanPagu #sumberPidahan').attr('name', 'sumber_pidahan');
            $('#tambahPaguModal #pindahanPagu #paguPindahan').attr('name', 'pagu_pindahan');
            $('#tambahPaguModal #pindahanPagu #tujuanPindah').attr('name', 'tujuan_pindah');

            // Hapus Attribute Name Pagu Baru
            $('#tambahPaguModal #paguBaru #sumberBaru').removeAttr('name');
            $('#tambahPaguModal #paguBaru #paguBaru').removeAttr('name');
        } else {
            // Tambah Attribute Name Pagu Baru Jika False
            $('#tambahPaguModal #paguBaru #sumberBaru').attr('name', 'sumber_baru');
            $('#tambahPaguModal #paguBaru #paguBaru').attr('name', 'pagu_baru');

            // Hapus Attribute Name Pagu Pindahan Jika False
            $('#tambahPaguModal #pindahanPagu #opd_pindahan').removeAttr('name', 'opd_pindahan');
            $('#tambahPaguModal #pindahanPagu #sumberPidahan').removeAttr('name', 'sumber_pidahan');
            $('#tambahPaguModal #pindahanPagu #paguPindahan').removeAttr('name', 'pagu_pindahan');
            $('#tambahPaguModal #pindahanPagu #tujuanPindah').removeAttr('name', 'tujuan_pindah');

            $('#tambahPaguModal #statusPagu').val('1');
            $('#tambahPaguModal #pindahanPagu').hide();
            $('#tambahPaguModal #paguBaru').show();
        }
    });

    $('#tambahPaguModal #pindahanPagu #opd_pindahan').on('change', function () {
        idopdpindahan = $(this).val();
        $('#tambahPaguModal #pindahanPagu #sumberPidahan').html('');
        if (idopdpindahan !== '') {
            opdname = $(this).find(':selected').text();
            $('#tambahPaguModal #pindahanPagu #sumberPidahanDiv').show();
            $('#tambahPaguModal #pindahanPagu #paguPindahanDiv').show();
            $('#tambahPaguModal #pindahanPagu #tujuanPindahDiv').show();
            $('#tambahPaguModal #pindahanPagu #sumberPidahanDiv #sumberPidahanLabel').html('Sumber dana pada ' + opdname);
            $.get("/ajax/pagu/pindahan/opd/" + idopdpindahan,
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    $('#tambahPaguModal #pindahanPagu #sumberPidahan').html(data);
                },
            );
        } else {
            $('#tambahPaguModal #pindahanPagu #sumberPidahanDiv').hide();
            $('#tambahPaguModal #pindahanPagu #paguPindahanDiv').hide();
            $('#tambahPaguModal #pindahanPagu #tujuanPindahDiv').hide();
            $('#tambahPaguModal #pindahanPagu #sumberPidahanDiv #sumberPidahanLabel').html('');
        }
    });

    // Edit Pagu Modal
    $('.edit-pagu').on('click', function () {
        idopd = $(this).data('idopd');
        idpagu = $(this).data('idpagu');
        namaopd = $(this).data('namaopd');
        namasumberdana = $(this).data('namasumberdana');

        checkboxEdit = $('#editPaguModal #editcheckbox');
        $.get("/ajax/pagu/edit/biasa/" + idopd + "/" + idpagu,
            function (data, textStatus, jqXHR) {
                paguAwal = $('#editPaguModal #paguAwal').val(parseInt(data.pagu));

                nilaiPagu = parseFloat(data.pagu);
                tambahPagu = $('#editPaguModal #tambahpagu');
                kurangPagu = $('#editPaguModal #kurangPagu');
                jumlahPagu = $('#editPaguModal #jumlahpagu');
                statuspagu = $('#editPaguModal #statuspagu');

                tambahPagu.attr('name', 'tambah_pagu');

                jumlahPagu.val(nilaiPagu);
                tambahPagu.on('keyup', function () {
                    if (tambahPagu.val() == '' || tambahPagu.val() == 0) {
                        jumlahPagu.val(nilaiPagu);
                    } else {
                        jumlahPagu.val(nilaiPagu + parseFloat(tambahPagu.val()));
                    }
                });

                checkboxEdit.click(function () {
                    if ($(this).prop('checked') == true) {
                        $('#editPaguModal #tambahPaguShow').hide();
                        $('#editPaguModal #kurangPaguShow').show();
                        tambahPagu.val('');
                        tambahPagu.removeAttr('name');
                        kurangPagu.attr('name', 'kurang_pagu');
                        jumlahPagu.val(nilaiPagu);
                        statuspagu.val(3);
                    } else {
                        $('#editPaguModal #tambahPaguShow').show();
                        $('#editPaguModal #kurangPaguShow').hide();
                        kurangPagu.val('');
                        kurangPagu.removeAttr('name');
                        tambahPagu.attr('name', 'tambah_pagu');
                        jumlahPagu.val(nilaiPagu);
                        statuspagu.val(2);
                    }
                });

                kurangPagu.on('keyup', function () {
                    if (kurangPagu.val() == '' || kurangPagu.val() == 0) {
                        jumlahPagu.val(nilaiPagu);
                    } else {
                        jumlahPagu.val(nilaiPagu - parseFloat(kurangPagu.val()));
                    }
                    overPagu = nilaiPagu - $(this).val();
                    if (parseInt(overPagu) < 0) {
                        $('#paguOverAlert').show();
                    } else {
                        $('#paguOverAlert').hide();
                    }
                })

            },
            "JSON"
        );

        $('#editPaguModal #opd').val(idopd);
        $('#editPaguModal #sumber').val(idpagu);
        $('#editPaguModal #editPaguModalLabel').html(namaopd);
        $('#editPaguModal #namasumberdana').html(namasumberdana);

    })

    // Pindah pagu
    $('.pindah-pagu').on('click', function () {
        idopd = $(this).data('idopd');
        idpagu = $(this).data('idpagu');
        pendapatanuraian = $(this).data('pendapatanuraian');
        namaopd = $(this).data('namaopd');
        namasumberdana = $(this).data('namasumberdana');
        pagusebelumnya = $(this).data('pagusebelumnya');

        $.get("/ajax/pagu/pindah/bysumber/" + pendapatanuraian + '/' + idopd,
            function (data, textStatus, jqXHR) {
                console.log(data);
                $('#pindahPaguModal #pindahopd').html(data)
            },
        );

        $('#pindahPaguModal #pagusisa').val(pagusebelumnya);
        $('#pindahPaguModal #pindahjumlah').on('keyup', function () {
            $('#pindahPaguModal #pagusisa').val(pagusebelumnya - $(this).val());
            $('#pindahPaguModal #pagusisakirim').val(pagusebelumnya - $(this).val());
        });
        $('#pindahPaguModal #idpendapatanuraian').val(pendapatanuraian);
        $('#pindahPaguModal #opd').val(idopd);
        $('#pindahPaguModal #sumber').val(idpagu);
        $('#pindahPaguModal #editPaguModalLabel').html(namaopd);
        $('#pindahPaguModal #namasumberdana').html(namasumberdana);
        $('#pindahPaguModal #paguAwal').val(pagusebelumnya);

    });

});
