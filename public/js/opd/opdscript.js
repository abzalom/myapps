$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var href = window.location.href;
    // var splitit = (href.split('#'))[1]; //split url to get twee name
    // console.log(splitit);
    // if (splitit !== "" & splitit !== undefined) {
    //     $('#' + splitit).css('background-color', 'rgb(239, 255, 235)');
    //     $('html, body').animate({
    //         scrollTop: $('#' + splitit).offset().top,
    //     }, 100);
    // }

    $('#table_opd').DataTable({

    });

    $('.get-opd-id').on('click', function () {
        checked = $(this).prop('checked');
        idopd = $(this).val()
        if (checked == true) {
            $('#test_add_id_opd').append('<input type="hidden" name="idopd[]" id="value_opd_by_id_' + idopd + '" value="' + idopd + '">')
            // alert(idopd)
        } else {
            $('#test_add_id_opd #value_opd_by_id_' + idopd).remove();
        }
    })

    $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
            maximumSelectionLength: 3,
            language: {
                maximumSelected: function (e) {
                    var t = "Satu OPD Hanya Bisa Menampung Maksimal Sebanyak " + e.maximum + " Bidang";
                    e.maximum != 1 && (t += "");
                    return t;
                }
            },
        });
    });

    $(document).on('select2:close', '.select2', function (e) {
        var evt = "scroll.select2"
        $(e.target).parents().off(evt)
        $(window).off(evt)
    });

    $('#tambahOpdModal #bidang1').on('change', function () {
        bid1 = $(this).val();
        $('#tambahOpdModal #bidang2').removeAttr('disabled');
        $.get("/nomen/api/bidang/" + bid1 + '/0',
            function (data, textStatus, jqXHR) {
                $('#tambahOpdModal #bidang2').html(data);
            },
        );
    });
    $('#tambahOpdModal #bidang2').on('change', function () {
        bid1 = $('#tambahOpdModal #bidang1').find(':selected').val();
        bid2 = $(this).val();
        $('#tambahOpdModal #bidang3').removeAttr('disabled');
        $.get("/nomen/api/bidang/" + bid1 + '/' + bid2,
            function (data, textStatus, jqXHR) {
                $('#tambahOpdModal #bidang3').html(data);
            },
        );
    });

    $('.edit-opd').on('click', function () {
        idopd = $(this).val();
        $('#editOpdModal #bidang1Edit').html('<option value="">Pilih bidang</option>')
        $('#editOpdModal #bidang2Edit').html('<option value="">Pilih bidang</option>')
        $('#editOpdModal #bidang3Edit').html('<option value="">Pilih bidang</option>')

        $('#editOpdModal #kelompok_bidangEdit').html('');
        $('#editOpdModal #kelompok_bidangEdit').html(
            '<option value="" selected>Pilih Kelompok Bidang</option>' +
            '<option value="1">BIDANG SOSBUD</option>' +
            '<option value="2">BIDANG EKONOMI</option>' +
            '<option value="3">BIDANG FISPRA</option>'
        );

        $.get("/perangkat/api/edit/" + idopd,
            function (data, textStatus, jqXHR) {
                if (data.opd.kelompok_bidang == '1') {
                    $('#editOpdModal #kelompok_bidangEdit').html(
                        '<option value="">Pilih Kelompok Bidang</option>' +
                        '<option value="1" selected>BIDANG SOSBUD</option>' +
                        '<option value="2">BIDANG EKONOMI</option>' +
                        '<option value="3">BIDANG FISPRA</option>'
                    );
                }

                if (data.opd.kelompok_bidang == '2') {
                    $('#editOpdModal #kelompok_bidangEdit').html(
                        '<option value="">Pilih Kelompok Bidang</option>' +
                        '<option value="1">BIDANG SOSBUD</option>' +
                        '<option value="2" selected>BIDANG EKONOMI</option>' +
                        '<option value="3">BIDANG FISPRA</option>'
                    );
                }

                if (data.opd.kelompok_bidang == '3') {
                    $('#editOpdModal #kelompok_bidangEdit').html(
                        '<option value="">Pilih Kelompok Bidang</option>' +
                        '<option value="1">BIDANG SOSBUD</option>' +
                        '<option value="2">BIDANG EKONOMI</option>' +
                        '<option value="3" selected>BIDANG FISPRA</option>'
                    );
                }

                if (data.tags.length == 1) {
                    tagbid1 = data.tags[0].a2_bidang_id;
                    tagbid2 = '';
                    tagbid3 = '';
                }
                if (data.tags.length == 2) {
                    tagbid1 = data.tags[0].a2_bidang_id;
                    tagbid2 = data.tags[1].a2_bidang_id;
                    tagbid3 = '';
                }
                if (data.tags.length == 3) {
                    tagbid1 = data.tags[0].a2_bidang_id;
                    tagbid2 = data.tags[1].a2_bidang_id;
                    tagbid3 = data.tags[2].a2_bidang_id;
                }
                $.each(data.bidangs, function (bidkey, bidval) {
                    if (bidval.id == tagbid1) {
                        $('#editOpdModal #bidang1Edit').append('<option value="' + bidval.id + '" selected>' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    } else {
                        $('#editOpdModal #bidang1Edit').append('<option value="' + bidval.id + '">' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    }
                    if (bidval.id == tagbid2) {
                        $('#editOpdModal #bidang2Edit').append('<option value="' + bidval.id + '" selected>' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    } else {
                        $('#editOpdModal #bidang2Edit').append('<option value="' + bidval.id + '">' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    }
                    if (bidval.id == tagbid3) {
                        $('#editOpdModal #bidang3Edit').append('<option value="' + bidval.id + '" selected>' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    } else {
                        $('#editOpdModal #bidang3Edit').append('<option value="' + bidval.id + '">' + bidval.kode_unik_bidang + ' - ' + bidval.uraian + '</option>');
                    }
                });
                $('#editOpdModal #opdEdit').val(data.opd.nama_perangkat);
                $('#editOpdModal #kodeEdit').val(data.opd.kode_urut);
                $('#editOpdModal #idopdEdit').val(data.opd.id);
            });
    });

    $('.add-kepala-opd').on('click', function () {
        idopd = $(this).val();
        namaopd = $(this).data('namaopd');
        $('#addKepalaOpdModal #idopdKepala').val(idopd);
        $('#addKepalaOpdModal #addKepalaOpdModalLabel').html(namaopd);
    });
});
