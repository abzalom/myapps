$(document).ready(function () {
    $('.datatables').DataTable({
        lengthMenu: [
            [30, 50, 100, -1],
            [30, 50, 100, 'All']
        ],
        columnDefs: [{
            'targets': 2,
            'className': 'text-end',
        }, ],
        // deferRender: true,
        // scrollY: 600,
        // scrollCollapse: true,
        // scroller: true
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

    $('#tambahPendapatanModal #kelompok').on('change', function () {
        kelompok = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "/pendapatan/jenis/" + kelompok,
            dataType: "json",
            success: function (data) {
                $('#tambahPendapatanModal #jenis').html('<option value=""></option>');
                $('#tambahPendapatanModal #objek').html('<option value=""></option>');
                $('#tambahPendapatanModal #rincian').html('<option value=""></option>');
                $('#tambahPendapatanModal #subrincian').html('<option value=""></option>');
                $.each(data, function (i, v) {
                    $('#tambahPendapatanModal #jenis').append('<option value="' + v.id + '">' + v.kode_unik_jenis + ' - ' + v.uraian + '</option>');
                });
                $('#tambahPendapatanModal #jenis').removeAttr('disabled');
            }
        });
    });

    $('#tambahPendapatanModal #jenis').on('change', function () {
        jenis = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "/pendapatan/objek/" + jenis,
            dataType: "json",
            success: function (data) {
                $('#tambahPendapatanModal #objek').html('<option value=""></option>');
                $('#tambahPendapatanModal #rincian').html('<option value=""></option>');
                $('#tambahPendapatanModal #subrincian').html('<option value=""></option>');
                $.each(data, function (i, v) {
                    $('#tambahPendapatanModal #objek').append('<option value="' + v.id + '">' + v.kode_unik_objek + ' - ' + v.uraian + '</option>');
                });
                $('#tambahPendapatanModal #objek').removeAttr('disabled');
            }
        });
    });

    $('#tambahPendapatanModal #objek').on('change', function () {
        rincian = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "/pendapatan/rincian/" + rincian,
            dataType: "json",
            success: function (data) {
                $('#tambahPendapatanModal #rincian').html('<option value=""></option>');
                $('#tambahPendapatanModal #subrincian').html('<option value=""></option>');
                $.each(data, function (i, v) {
                    $('#tambahPendapatanModal #rincian').append('<option value="' + v.id + '">' + v.kode_unik_rincian + ' - ' + v.uraian + '</option>');
                });
                $('#tambahPendapatanModal #rincian').removeAttr('disabled');
            }
        });
    });

    $('#tambahPendapatanModal #rincian').on('change', function () {
        rincian = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "/pendapatan/subrincian/" + rincian,
            dataType: "json",
            success: function (data) {
                $('#tambahPendapatanModal #subrincian').html('<option value=""></option>');
                $.each(data, function (i, v) {
                    $('#tambahPendapatanModal #subrincian').append('<option value="' + v.id + '">' + v.kode_unik_subrincian + ' - ' + v.uraian + '</option>');
                });
                $('#tambahPendapatanModal #subrincian').removeAttr('disabled');
            }
        });
    });

    $('#tambahPendapatanModal #subrincian').on('change', function () {
        $('#tambahPendapatanModal #anggaran').removeAttr('disabled');
        $('#tambahPendapatanModal #uraian').removeAttr('disabled');
    });


});
