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

    $('#tablePagu').dataTable({
        lengthMenu: [
            [20, 50, -1],
            [20, 50, 'All']
        ],
    });

    $('.tambah-pagu').on('click', function () {
        idopd = $(this).data('idopd');
        namaopd = $(this).data('namaopd');
        idurusan = $(this).data('idurusan');
        idbidang = $(this).data('idbidang');
        $('#tambahPaguModal #tambahPaguModalLabel').html('Tambah pagu pada OPD ' + namaopd);
        $('#tambahPaguModal #idopd_baru').val(idopd);
        $('#tambahPaguModal #urusan_baru_id').val(idurusan);
        $('#tambahPaguModal #bidang_baru_id').val(idbidang);

        $('#tambahPaguModal #sumberBaru').html('<option value="">Pilih</option>');

        $.get("/api/pagu/add/opd/" + idopd + '/bidang/' + idbidang,
            function (data, textStatus, jqXHR) {
                $.each(data, function (pagkey, paguval) {
                    $('#tambahPaguModal #sumberBaru').append(
                        '<option value="' + paguval.id + '">' + paguval.uraian + '</option>'
                    );
                });
            },
            "JSON"
        );
        $.get("/ajax/opd/except/" + idopd,
            function (data, textStatus, jqXHR) {
                $('#tambahPaguModal #pindahanPagu #opd_pindahan').html(data);
            },
        );
    });

    // Checkbox on check
    $('#tambahPaguModal #statusCheckBox').on('click', function () {
        check = $(this).prop('checked');
        if (check == true) {
            $('#tambahPaguModal #statusPagu').val('5');
            $('#tambahPaguModal #pindahanPagu').show();
            $('#tambahPaguModal #baruInputDiv').hide();
            // Hapus Attribute pagu baru
            $('#tambahPaguModal #sumberBaru').removeAttr('name');
            $('#tambahPaguModal #paguBaru').removeAttr('name');
            // Tambahkan Attribute pagu pindahan
            $('#tambahPaguModal #opd_pindahan').attr('name', 'opd_pindahan');
            $('#tambahPaguModal #sumberPidahan').attr('name', 'sumber_pidahan');
            $('#tambahPaguModal #paguPindahan').attr('name', 'pagu_pindahan');
            $('#tambahPaguModal #tujuanPindah').attr('name', 'tujuan_pindah');
            $('#tambahPaguModal #bidang_pindahan').attr('name', 'bidang_pindahan');
            $('#tambahPaguModal #urusan_pindahan').attr('name', 'urusan_pindahan');
        } else {
            $('#tambahPaguModal #statusPagu').val('1');
            $('#tambahPaguModal #pindahanPagu').hide();
            $('#tambahPaguModal #baruInputDiv').show();
            // Tambahkan Attribute pagu baru
            $('#tambahPaguModal #sumberBaru').attr('name', 'sumber_baru');
            $('#tambahPaguModal #paguBaru').attr('name', 'pagu_baru');
            // Hapus Attribute pagu pindahan
            $('#tambahPaguModal #opd_pindahan').removeAttr('name');
            $('#tambahPaguModal #sumberPidahan').removeAttr('name');
            $('#tambahPaguModal #sumberPidahan').html('<option value="">Pilih Sumber Dana</option>');
            $('#tambahPaguModal #paguPindahan').removeAttr('name');
            $('#tambahPaguModal #paguPindahan').attr('disabled', true);
            $('#tambahPaguModal #paguPindahan').val('');
            $('#tambahPaguModal #tujuanPindah').removeAttr('name');
            $('#tambahPaguModal #tujuanPindah').attr('disabled', true);
            $('#tambahPaguModal #tujuanPindah').val('');
            $('#tambahPaguModal #bidang_pindahan').removeAttr('name');
            $('#tambahPaguModal #bidang_pindahan').html('<option value="">Pilih Bidang</option>');
            $('#tambahPaguModal #urusan_pindahan').removeAttr('name');

        }
    });

    //Pindah OPD Dengan Sumber Dana
    $('#tambahPaguModal #opd_pindahan').on('change', function () {
        idopdpindahan = $(this).val();
        $('#tambahPaguModal #bidang_pindahan').removeAttr('disabled');
        $('#tambahPaguModal #sumberPidahan').attr('disabled', true);
        $('#tambahPaguModal #bidang_pindahan').html('<option value="">Pilih Bidang</option>');
        $('#tambahPaguModal #sumberPidahan').html('<option value="">Pilih Sumber Dana</option>');
        $('#tambahPaguModal #paguPindahan').attr('disabled', true);
        $('#tambahPaguModal #tujuanPindah').attr('disabled', true);
        $('#tambahPaguModal #paguPindahan').val('');
        $('#tambahPaguModal #tujuanPindah').val('');
        if ($(this).val() !== '') {
            $('#tambahPaguModal #pindahanInputDiv').show();
            $.get("/ajax/bidang/pindah/" + idopdpindahan,
                function (data, textStatus, jqXHR) {
                    $('#tambahPaguModal #bidang_pindahan').html(data);
                },
            );

            $('#tambahPaguModal #bidang_pindahan').on('change', function () {
                idbidangpindah = $(this).val();
                idurusanpindah = $(this).find(':selected').data('urusan');
                $('#tambahPaguModal #sumberPidahan').removeAttr('disabled');
                $('#tambahPaguModal #paguPindahan').attr('disabled', true);
                $('#tambahPaguModal #tujuanPindah').attr('disabled', true);
                $('#tambahPaguModal #paguPindahan').val('');
                $('#tambahPaguModal #tujuanPindah').val('');
                $('#tambahPaguModal #urusan_pindahan').val(idurusanpindah);
                $.get("/ajax/pagu/pindahan/opd/" + idopdpindahan + '/bidang/' + idbidangpindah,
                    function (data, textStatus, jqXHR) {
                        $('#tambahPaguModal #pindahanPagu #sumberPidahan').html(data);
                    },
                );
            });

        } else {
            $('#tambahPaguModal #pindahanInputDiv').hide();
            $('#tambahPaguModal #sumberPidahan').val('');
            $('#tambahPaguModal #paguPindahan').val('');
            $('#tambahPaguModal #tujuanPindah').val('');
            $('#tambahPaguModal #bidang_pindahan').html('');
            $('#tambahPaguModal #urusan_pindahan').val('');

            $('#tambahPaguModal #bidang_pindahan').attr('disabled', true);
            $('#tambahPaguModal #sumberPidahan').attr('disabled', true);
            $('#tambahPaguModal #bidang_pindahan').html('<option value="">Pilih Bidang</option>');
            $('#tambahPaguModal #sumberPidahan').html('<option value="">Pilih Sumber Dana</option>');

            $('#tambahPaguModal #paguPindahan').attr('disabled', true);
            $('#tambahPaguModal #tujuanPindah').attr('disabled', true);
            $('#tambahPaguModal #paguPindahan').val('');
            $('#tambahPaguModal #tujuanPindah').val('');
        }
    });

    $('#tambahPaguModal #sumberPidahan').on('change', function () {
        $('#tambahPaguModal #paguPindahan').removeAttr('disabled', true);
        $('#tambahPaguModal #tujuanPindah').removeAttr('disabled', true);
        $('#tambahPaguModal #paguPindahan').val('');
        $('#tambahPaguModal #tujuanPindah').val('');
    });

    $('#tambahPaguModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#tambahPaguModal #idopd_baru').val('');
        $('#tambahPaguModal #statusPagu').val('1');
        $('#tambahPaguModal #urusan_baru_id').val('');
        $('#tambahPaguModal #bidang_baru_id').val('');
        $('#tambahPaguModal #bidang_baru_id').val('');
        $('#tambahPaguModal #statusCheckBox').prop('checked', false);

        $('#tambahPaguModal #pindahanPagu').hide();
        $('#tambahPaguModal #pindahanInputDiv').hide();

        $('#tambahPaguModal #bidang_pindahan').attr('disabled', true);
        $('#tambahPaguModal #sumberPidahan').attr('disabled', true);
        $('#tambahPaguModal #bidang_pindahan').html('<option value="">Pilih Bidang</option>');
        $('#tambahPaguModal #urusan_pindahan').val('');
        $('#tambahPaguModal #sumberPidahan').html('<option value="">Pilih Sumber Dana</option>');
        $('#tambahPaguModal #opd_pindahan').removeAttr('name');
        $('#tambahPaguModal #sumberPidahan').removeAttr('name');
        $('#tambahPaguModal #paguPindahan').removeAttr('name');
        $('#tambahPaguModal #tujuanPindah').removeAttr('name');
        $('#tambahPaguModal #bidang_pindahan').removeAttr('name');
        $('#tambahPaguModal #urusan_pindahan').removeAttr('name');

        $('#tambahPaguModal #paguPindahan').removeAttr('disabled', true);
        $('#tambahPaguModal #tujuanPindah').removeAttr('disabled', true);
        $('#tambahPaguModal #paguPindahan').val('');
        $('#tambahPaguModal #tujuanPindah').val('');

        $('#tambahPaguModal #baruInputDiv').show();
        $('#tambahPaguModal #sumberBaru').attr('name', 'sumber_baru');
        $('#tambahPaguModal #paguBaru').attr('name', 'pagu_baru');
        $('#tambahPaguModal #sumberBaru').val('');
        $('#tambahPaguModal #paguBaru').val('');
    });






    // Edit Pagu
    $('.edit-pagu').on('click', function () {
        idopd = $(this).data('idopd');
        idpagu = $(this).data('idpagu');
        namaopd = $(this).data('namaopd');
        idbidang = $(this).data('idbidang');
        jumlahpagu = $(this).data('jumlahpagu');
        namabidang = $(this).data('namabidang');
        namasumber = $(this).data('namasumber');
        jumlahpaguuntukedit = parseInt($(this).data('jumlahpaguuntukedit'));
        $('#editPaguModal #idopd').val(idopd);
        $('#editPaguModal #informasi #namaopd').html(namaopd)
        $('#editPaguModal #informasi #namabidang').html(namabidang)
        $('#editPaguModal #informasi #namasumber').html(namasumber)
        $('#editPaguModal #informasi #jumlahdana').html('Rp. ' + jumlahpagu)

        $('#editPaguModal #idpagu').val(idpagu);
        $('#editPaguModal #paguAwal').val(jumlahpaguuntukedit);
        // Form Edit Pagu
        $('#editPaguModal #jumlahpagu').val(jumlahpaguuntukedit);
        $('#editPaguModal #tambahpagu').attr('name', 'tambah_pagu');
        $('#editPaguModal #tambahpagu').on('keyup', function () {
            tambahpagu = $(this).val();
            if (tambahpagu == '') {
                tambahpagu = 0;
            }
            $('#editPaguModal #jumlahpagu').val(jumlahpaguuntukedit + parseInt(tambahpagu));
        })
        $('#editPaguModal #editcheckbox').on('click', function () {
            if ($(this).prop('checked') == true) {
                $('#editPaguModal #statuspagu').val('3');
                $('#editPaguModal #kurangPagu').attr('name', 'kurang_pagu');
                $('#editPaguModal #tambahpagu').removeAttr('name');
                $('#editPaguModal #tambahPaguShow').hide();
                $('#editPaguModal #kurangPaguShow').show();
            } else {
                $('#editPaguModal #statuspagu').val('2');
                $('#editPaguModal #tambahPaguShow').show();
                $('#editPaguModal #kurangPaguShow').hide();
                $('#editPaguModal #kurangPagu').removeAttr('name');
                $('#editPaguModal #tambahpagu').attr('name', 'tambah_pagu');
            }
        });

        $('#editPaguModal #kurangPagu').on('keyup', function () {
            kurangpagu = $(this).val();
            if (kurangpagu == '') {
                kurangpagu = 0;
            }
            $('#editPaguModal #jumlahpagu').val(jumlahpaguuntukedit - parseInt(kurangpagu));
            overPagu = jumlahpaguuntukedit - parseInt(kurangpagu);
            if (parseInt(overPagu) < 0) {
                $('#editPaguModal #paguOverAlert').show();
            } else {
                $('#editPaguModal #paguOverAlert').hide();
            }
        })
    })




    // Pindah pagu dengan sumber dana yang sama
    $('.pindah-pagu').on('click', function () {
        idopd = $(this).data('idopd');
        idpagu = $(this).data('idpagu');
        namaopd = $(this).data('namaopd');
        idbidang = $(this).data('idbidang');
        jumlahpagu = $(this).data('jumlahpagu');
        namabidang = $(this).data('namabidang');
        namasumber = $(this).data('namasumber');
        g1pendapatanuraianid = $(this).data('g1pendapatanuraianid');
        jumlahpaguuntukedit = parseInt($(this).data('jumlahpaguuntukedit'));
        $('#pindahPaguModal #idopd').val(idopd);
        $('#pindahPaguModal #informasi #namaopd').html(namaopd)
        $('#pindahPaguModal #informasi #namabidang').html(namabidang)
        $('#pindahPaguModal #informasi #namasumber').html(namasumber)
        $('#pindahPaguModal #informasi #jumlahdana').html('Rp. ' + jumlahpagu)

        $('#pindahPaguModal #idpagu').val(idpagu);
        $('#pindahPaguModal #paguAwal').val(jumlahpaguuntukedit);
        $('#pindahPaguModal #idpendapatanuraian').val(g1pendapatanuraianid);

        $.get("/ajax/pagu/pindah/bysumber/" + g1pendapatanuraianid + '/' + idopd,
            function (data, textStatus, jqXHR) {
                $('#pindahPaguModal #pindahopd').html(data)
            },
        );

        $('#pindahPaguModal #pagusisa').val(jumlahpaguuntukedit);
        $('#pindahPaguModal #pindahjumlah').on('keyup', function () {
            overPagu = jumlahpaguuntukedit - parseInt($(this).val());
            if (overPagu < 0) {
                $('#pindahPaguModal #paguOverAlert').show();
            } else {
                $('#pindahPaguModal #paguOverAlert').hide();
            }
            $('#pindahPaguModal #pagusisa').val(jumlahpaguuntukedit - $(this).val());
            $('#pindahPaguModal #pagusisakirim').val(jumlahpaguuntukedit - $(this).val());
        });
        $('#pindahPaguModal #pindahbidang').html('<option value="">Pilih</option>');
    });

    $('#pindahPaguModal #pindahopd').on('change', function () {
        idopd = $(this).val();
        $('#pindahPaguModal #pindahbidang').removeAttr('disabled');
        if (idopd == 0) {
            $('#pindahPaguModal #pindahbidang').html('<option value="">Pilih</option>');
        }
        $.get("/ajax/pagu/pindah/bidangbyopd/" + idopd,
            function (data, textStatus, jqXHR) {
                $('#pindahPaguModal #pindahbidang').html(data);
            },
        );
    });

});
