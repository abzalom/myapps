$(document).ready(function () {

    $('.akun').on('click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/lra/kelompok/" + id,
            success: function (data) {
                $('#akun' + id).html(data);
            }
        });
    });

    $('body').delegate('.kelompok', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/lra/jenis/" + id,
            success: function (data) {
                $('#kelompok' + id).html(data);
            }
        });
    });

    $('body').delegate('.jenis', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/lra/objek/" + id,
            success: function (data) {
                $('#jenis' + id).html(data);
            }
        });
    });

    $('body').delegate('.objek', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/lra/rincian/" + id,
            success: function (data) {
                $('#objek' + id).html(data);
            }
        });
    });

    $('body').delegate('.rincian', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/lra/subrincian/" + id,
            success: function (data) {
                $('#rincian' + id).html(data);
            }
        });
    });

});
