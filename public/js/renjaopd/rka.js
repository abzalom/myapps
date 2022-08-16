$(document).ready(function () {
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

    $("#rkaAkunModal #rkaObjek").on('change', function () {
        idObjek = $(this).val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rka/rincian/api/" + idObjek,
            dataType: "JSON",
            success: function (data) {
                $("#rkaAkunModal #rkaRincian").html('<option value="" selected>Pilih..</option>');
                $.each(data, function (index, value) {
                    $("#rkaAkunModal #rkaRincian").append('<option value="' + value.id + '">' + value.kode_unik_rincian + ' - ' + value.uraian + '</option>');
                });
            }
        });
    });

    $("#rkaAkunModal #rkaRincian").on('change', function () {
        idRincian = $(this).val();
        opd = $('#opd').val();
        subkegiatan = $('#subkegiatan').val();
        indikator = $('#indikator').val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/rka/subrincian/api/" + idRincian + '/' + opd + '/' + subkegiatan + '/' + indikator,
            dataType: "JSON",
            success: function (data) {
                // console.log(data);
                $("#rkaAkunModal #rkaSubrincian").html('<option value="" selected>Pilih..</option>');
                $.each(data, function (index, value) {
                    $("#rkaAkunModal #rkaSubrincian").append('<option value="' + value.id + '">' + value.kode_unik_subrincian + ' - ' + value.uraian + '</option>');
                });
            }
        });
    });

    $(".rekening").on('click', function () {
        idsubrincian = $(this).val();
        $.ajax({
            type: "get",
            url: "http://myapps.com:8686/ssh/api/" + idsubrincian,
            dataType: "JSON",
            success: function (data) {
                $('#addSshModal #komponenSSH').html('');
                $.each(data, function (index, value) {
                    $('#addSshModal #komponenSSH').append('<option value="' + value.id + '">' + value.komponen + ' - ' + addCommas(value.harga) + ' / ' + value.satuan + '</option>');
                });
            }
        });
    })
});

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
