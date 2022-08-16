$(document).ready(function () {
    $('.akun-click').on('click', function () {
        akun = $(this).data('akun');
        akunShow = '.akun-show-' + akun;
        if ($(this).attr('aria-expanded') == 'false') {
            // console.log($(this).attr('aria-expanded'));
            $(this).children('#akunIcon').removeClass('fa-minus');
            $(this).children('#akunIcon').addClass('fa-plus');
        };
        if ($(this).attr('aria-expanded') == 'true') {
            $(this).children('#akunIcon').addClass('fa-minus');
            $(this).children('#akunIcon').removeClass('fa-plus');
        }
        // $(this > 'i').attr('class', 'fa fa-solid fa-minus');
        $.ajax({
            type: "get",
            url: "/rekening/lo/api/kelompok/" + akun,
            success: function (data) {
                $(akunShow).html('html');
                $(akunShow).html(data);
            }
        });
    });

    $('body').delegate('.kelompok-click', 'click', function () {
        kelompok = $(this).data('kelompok');
        kelShow = '.kelompok-show-' + kelompok;
        if ($(this).attr('aria-expanded') == 'false') {
            console.log($(this).attr('aria-expanded'));
            $(this).children('#kelompokIcon').removeClass('fa-minus');
            $(this).children('#kelompokIcon').addClass('fa-plus');
        };
        if ($(this).attr('aria-expanded') == 'true') {
            $(this).children('#kelompokIcon').addClass('fa-minus');
            $(this).children('#kelompokIcon').removeClass('fa-plus');
        }
        $.ajax({
            type: "get",
            url: "/rekening/lo/api/jenis/" + kelompok,
            success: function (data) {
                $(kelShow).html(data);
            }
        });
    });

    $('body').delegate('.jenis-click', 'click', function () {
        jenis = $(this).data('jenis');
        jenisShow = '.jenis-show-' + jenis;
        if ($(this).attr('aria-expanded') == 'false') {
            // console.log($(this).attr('aria-expanded'));
            $(this).children('#jenisIcon').removeClass('fa-minus');
            $(this).children('#jenisIcon').addClass('fa-plus');
        };
        if ($(this).attr('aria-expanded') == 'true') {
            $(this).children('#jenisIcon').addClass('fa-minus');
            $(this).children('#jenisIcon').removeClass('fa-plus');
        }
        $.ajax({
            type: "get",
            url: "/rekening/lo/api/objek/" + jenis,
            success: function (data) {
                $(jenisShow).html(data);
            }
        });
    });

    $('body').delegate('.objek-click', 'click', function () {
        objek = $(this).data('objek');
        objekShow = '.objek-show-' + objek;
        if ($(this).attr('aria-expanded') == 'false') {
            // console.log($(this).attr('aria-expanded'));
            $(this).children('#objekIcon').removeClass('fa-minus');
            $(this).children('#objekIcon').addClass('fa-plus');
        };
        if ($(this).attr('aria-expanded') == 'true') {
            $(this).children('#objekIcon').addClass('fa-minus');
            $(this).children('#objekIcon').removeClass('fa-plus');
        }
        $.ajax({
            type: "get",
            url: "/rekening/lo/api/rincian/" + objek,
            success: function (data) {
                $(objekShow).html(data);
            }
        });
    });

    $('body').delegate('.rincian-click', 'click', function () {
        rincian = $(this).data('rincian');
        ricianShow = '.rincian-show-' + rincian;
        if ($(this).attr('aria-expanded') == 'false') {
            // console.log($(this).attr('aria-expanded'));
            $(this).children('#rincianIcon').removeClass('fa-minus');
            $(this).children('#rincianIcon').addClass('fa-plus');
        };
        if ($(this).attr('aria-expanded') == 'true') {
            $(this).children('#rincianIcon').addClass('fa-minus');
            $(this).children('#rincianIcon').removeClass('fa-plus');
        }
        $.ajax({
            type: "get",
            url: "/rekening/lo/api/subrincian/" + rincian,
            success: function (data) {
                $(ricianShow).html(data);
            }
        });
    });

});
