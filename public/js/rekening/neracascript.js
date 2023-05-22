$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.akun').on('click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/neraca/kelompok/" + id,
            success: function (data) {
                $('#akun' + id).html(data);
            }
        });
    });

    $('body').delegate('.kelompok', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/neraca/jenis/" + id,
            success: function (data) {
                $('#kelompok' + id).html(data);
            }
        });
    });

    $('body').delegate('.jenis', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/neraca/objek/" + id,
            success: function (data) {
                $('#jenis' + id).html(data);
            }
        });
    });

    $('body').delegate('.objek', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/neraca/rincian/" + id,
            success: function (data) {
                $('#objek' + id).html(data);
            }
        });
    });

    $('body').delegate('.rincian', 'click', function () {
        id = $(this).val();
        $.ajax({
            type: "get",
            url: "/rekening/neraca/subrincian/" + id,
            success: function (data) {
                $('#rincian' + id).html(data);
            }
        });
    });

    $('#belanjaTableSeacrh').select2({
        theme: "bootstrap-5",
    })

    $(document).on('click', '.btn-add-kode', function () {
        var kode = $(this).val();
        var title = $(this).data('uraian');
        $('#kode-belanja').val(kode);
        $('#katRekModalLabel').html(title);
    });

    $('.modal-add-kode').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
            ajax: {
                type: "post",
                url: "/api/get/kategori/by/kode",
                dataType: "JSON",
                delay: 250,
                data: function (param) {
                    return {
                        'q': param.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + ' - ' + item.uraian + (item.kategori_ssh ? ' (' + item.kategori_ssh + ')' : ''),
                            }
                        })
                    };
                },
                cache: true,
            },
            minimumInputLength: 2
        })
    })



});
