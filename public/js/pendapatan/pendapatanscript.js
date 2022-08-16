$(document).ready(function () {
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

    $('#addPendapatanModal #kelompok').on('change', function () {
        $('#addPendapatanModal #jenis').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #jenis').removeAttr('disabled');

        $('#addPendapatanModal #objek').attr('disabled', true);
        $('#addPendapatanModal #rincian').attr('disabled', true);
        $('#addPendapatanModal #subrincian').attr('disabled', true);
        $('#addPendapatanModal #uraian').attr('disabled', true);
        $('#addPendapatanModal #anggaran').attr('disabled', true);


        $('#addPendapatanModal #objek').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #rincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #subrincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #uraian').val('');
        $('#addPendapatanModal #anggaran').val('');


        kelompok = $(this).val();
        $.get("/rekening/lra/api/jenis/" + kelompok,
            function (data, textStatus, jqXHR) {
                $('#addPendapatanModal #jenis').append(data);
            },
        );
    });

    $('#addPendapatanModal #jenis').on('change', function () {
        $('#addPendapatanModal #objek').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #objek').removeAttr('disabled');

        $('#addPendapatanModal #rincian').attr('disabled', true);
        $('#addPendapatanModal #subrincian').attr('disabled', true);
        $('#addPendapatanModal #uraian').attr('disabled', true);
        $('#addPendapatanModal #anggaran').attr('disabled', true);


        $('#addPendapatanModal #rincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #subrincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #uraian').val('');
        $('#addPendapatanModal #anggaran').val('');
        jenis = $(this).val();
        $.get("/rekening/lra/api/objek/" + jenis,
            function (data, textStatus, jqXHR) {
                $('#addPendapatanModal #objek').append(data);
            },
        );
    });

    $('#addPendapatanModal #objek').on('change', function () {
        $('#addPendapatanModal #rincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #rincian').removeAttr('disabled');

        $('#addPendapatanModal #subrincian').attr('disabled', true);
        $('#addPendapatanModal #uraian').attr('disabled', true);
        $('#addPendapatanModal #anggaran').attr('disabled', true);


        $('#addPendapatanModal #subrincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #uraian').val('');
        $('#addPendapatanModal #anggaran').val('');
        objek = $(this).val();
        $.get("/rekening/lra/api/rincian/" + objek,
            function (data, textStatus, jqXHR) {
                $('#addPendapatanModal #rincian').append(data);
            },
        );
    });

    $('#addPendapatanModal #rincian').on('change', function () {
        $('#addPendapatanModal #subrincian').html('<option value="">Pilih..</option>');
        $('#addPendapatanModal #subrincian').removeAttr('disabled');
        $('#addPendapatanModal #uraian').attr('disabled', true);
        $('#addPendapatanModal #anggaran').attr('disabled', true);

        $('#addPendapatanModal #uraian').val('');
        $('#addPendapatanModal #anggaran').val('');
        rincian = $(this).val();
        $.get("/rekening/lra/api/subrincian/" + rincian,
            function (data, textStatus, jqXHR) {
                $('#addPendapatanModal #subrincian').append(data);
            },
        );
    });

    $('#addPendapatanModal #subrincian').on('change', function () {
        $('#addPendapatanModal #uraian').removeAttr('disabled');
        $('#addPendapatanModal #anggaran').removeAttr('disabled');
        $('#addPendapatanModal #uraian').val('');
        $('#addPendapatanModal #anggaran').val('');
    });

    $('.edit-komponen').on('click', function () {
        idkomponen = $(this).val();
        $('#editRincianPendatanModal #idkomponen').val(idkomponen);
        $.get("/api/pendapatan/komponen/" + idkomponen,
            function (data, textStatus, jqXHR) {
                $('#editRincianPendatanModal #editRincianPendatanModalLabel').html(data.subrincian.uraian);
                $('#editRincianPendatanModal #uraian').val(data.uraian);
                $('#editRincianPendatanModal #anggaran').val(parseInt(data.anggaran));
            },
            "JSON"
        );
    })

});
