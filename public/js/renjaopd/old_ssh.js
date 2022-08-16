$(document).ready(function () {
    $('#datatables').DataTable({
        columnDefs: [{
            targets: [0, 1, ],
            visible: false
        }],
        rowGroup: {
            dataSrc: [0, 1, ]
        },
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

    $('#addSshModal #kelompokbarang').on('change', function () {
        $('#addSshModal #kelompok').removeAttr('disabled');
    });
    $('#addSshModal #kelompok').on('change', function () {
        id = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rekening/api/jenis/" + id,
            dataType: "JSON",
            success: function (data) {
                $('#addSshModal #jenis').html('<option value="" selected>Pilih...</option>');
                $.each(data, function (key, jenis) {
                    $('#addSshModal #jenis').append('<option value="' + jenis.id + '">' + jenis.kode_unik_jenis + ' - ' + jenis.uraian + '</option>');
                });
                $('#addSshModal #jenis').removeAttr('disabled');
            }
        });
    });

    $('#addSshModal #jenis').on('change', function () {
        idjenis = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rekening/api/objek/" + idjenis,
            dataType: "JSON",
            success: function (data) {
                $('#addSshModal #objek').html('<option value="" selected>Pilih...</option>');
                $.each(data, function (key, objek) {
                    $('#addSshModal #objek').append('<option value="' + objek.id + '">' + objek.kode_unik_objek + ' - ' + objek.uraian + '</option>');
                });
                $('#addSshModal #objek').removeAttr('disabled');
            }
        });
    });

    $('#addSshModal #objek').on('change', function () {
        idobjek = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rekening/api/rincian/" + idobjek,
            dataType: "JSON",
            success: function (data) {
                $('#addSshModal #rincian').html('<option value="" selected>Pilih...</option>');
                $.each(data, function (key, rincian) {
                    $('#addSshModal #rincian').append('<option value="' + rincian.id + '">' + rincian.kode_unik_rincian + ' - ' + rincian.uraian + '</option>');
                });
                $('#addSshModal #rincian').removeAttr('disabled');
            }
        });
    });

    $('#addSshModal #rincian').on('change', function () {
        idrincian = $(this).find(':selected').val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rekening/api/subrincian/" + idrincian,
            dataType: "JSON",
            success: function (data) {
                $('#addSshModal #subrincian').html('<option value="" selected>Pilih...</option>');
                $.each(data, function (key, subrincian) {
                    $('#addSshModal #subrincian').append('<option value="' + subrincian.id + '">' + subrincian.kode_unik_subrincian + ' - ' + subrincian.uraian + '</option>');
                });
                $('#addSshModal #subrincian').removeAttr('disabled');
            }
        });
    });

    $('#addSshModal #subrincian').on('change', function () {
        $('#addSshModal #komponen').removeAttr('disabled');
        $('#addSshModal #spesifikasi').removeAttr('disabled');
        $('#addSshModal #harga').removeAttr('disabled');
        $('#addSshModal #satuan').removeAttr('disabled');
        $('#addSshModal #keterangan').removeAttr('disabled');
    });

});
