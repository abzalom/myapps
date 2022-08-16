$(document).ready(function () {
    // console.clear();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var select2 = $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
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

    $('#addRkaModal').on('shown.bs.modal', function () {
        $('#addRkaModal #modal-content-loading').delay(400).fadeOut(400, function () {
            $('#addRkaModal #modal-content-show').fadeIn(400);
        });
        $('#addRkaModal #rekening').select2({
            theme: "bootstrap-5",
            width: $('#rekening').data('width') ? $('#rekening').data('width') : $('#rekening').hasClass('w-100') ? '100%' : 'style',
            placeholder: $('#rekening').data('placeholder'),
            dropdownParent: $('#rekening').parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lra/subrincian/rka/search",
                dataType: 'json',
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                        q: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + ' - ' + item.uraian,
                            }
                        })
                    };
                },
                cache: true
            },
        });
    })

    $('#addRkaModal #rekening').on('change', function () {
        kode = $(this).val();
        kode = kode.split('.').join('-')

        $('#addRkaModal #spesifikasi').val('');
        $('#addRkaModal #harga').val('');
        $('#addRkaModal #satuan').val('');

        $('#addRkaModal #komponen').html('<option value="0" selected>Pilih komponen</option>')
        $.get("/api/ssh/komponen/rutin/" + kode,
            function (data, textStatus, jqXHR) {
                $.each(data.data, function (key, value) {
                    $('#addRkaModal #komponen').append('<option value="' + value.id + '" data-harga="' + value.harga + '" data-satuan="' + value.satuan + '" data-spesifikasi="' + value.spesifikasi + '" data-idtag="' + value.id + '">' + value.uraian + '</option>');
                });
                // if (data.data !== null) {
                // }
            },
            "JSON"
        );
    })

    $('#addRkaModal #komponen').on('change', function () {
        idkomponen = $(this).val();
        harga = $(this).find(':selected').data('harga');
        satuan = $(this).find(':selected').data('satuan');
        spesifikasi = $(this).find(':selected').data('spesifikasi');
        idtag = $(this).find(':selected').data('idtag');

        $('#addRkaModal #spesifikasi').val(spesifikasi);
        $('#addRkaModal #harga').val(harga);
        $('#addRkaModal #satuan').val(satuan);

        $('#addRkaModal #volume').on('keyup', function () {
            jumlah = $(this).val() * harga;
            $('#addRkaModal #jumlah').val(numberFormat(jumlah));
        });

    })

    $('#addRkaModal').on('hidden.bs.modal', function () {
        $('#addRkaModal #modal-content-loading').show();
        $('#addRkaModal #modal-content-show').hide();
        $(this).find('form').trigger('reset');
    });


    /**
     * 
     * Edit RKA
     * 
     */

    $('#editRkaModal').on('shown.bs.modal', function () {
        $('#editRkaModal #modal-content-loading').delay(400).fadeOut(400, function () {
            $('#editRkaModal #modal-content-show').fadeIn(400);
        });
    });

    $('.edit-rka-rutin').on('click', function () {
        idkomponen = $(this).val();
        $('#editRkaModal #idkomponen').val(idkomponen);
        var jumlah;
        var pajak = 0;
        $.getJSON("/rka/rutin/get/komponen/" + idkomponen,
            function (data, textStatus, jqXHR) {
                // console.log(data);
                $('#editRkaModal #rekeningEdit').val(data.rekening.kode_unik_subrincian + ' - ' + data.rekening.uraian);
                $('#editRkaModal #komponenEdit').val(data.uraian);
                $('#editRkaModal #spesifikasiEdit').val(data.spesifikasi);
                $('#editRkaModal #hargaEdit').val(data.harga);
                $('#editRkaModal #satuanEdit').val(data.satuan);
                $('#editRkaModal #volumeEdit').val(data.volume);
                jumlah = data.volume * data.harga;
                if (data.pajak == true) {
                    $('#editRkaModal #pajakEdit').prop('checked', true);
                    pajak = jumlah * 0.1;
                }
                $('#editRkaModal #jumlahEdit').val(numberFormat(jumlah + pajak));
                $('#editRkaModal #pajakEdit').on('click', function (param) {
                    pajakCheck = $(this).prop('checked');
                    if (pajakCheck == true) {
                        pajak = jumlah * 0.1;
                        $('#editRkaModal #jumlahEdit').val(numberFormat(jumlah + pajak));
                    } else {
                        pajak = 0;
                        $('#editRkaModal #jumlahEdit').val(numberFormat(jumlah + pajak));
                    }
                });
                $('#editRkaModal #volumeEdit').on('keyup', function () {
                    volume = $(this).val();
                    jumlah = data.harga * volume;
                    if ($('#editRkaModal #pajakEdit').prop('checked') == true) {
                        pajak = jumlah * 0.1;
                    }
                    $('#editRkaModal #jumlahEdit').val(numberFormat(volume * data.harga + pajak));
                    $('#editRkaModal #pajakEdit').on('click', function (param) {
                        pajakCheck = $(this).prop('checked');
                        if (pajakCheck == true) {
                            pajak = jumlah * 0.1;
                            $('#editRkaModal #jumlahEdit').val(numberFormat(jumlah + pajak));
                        } else {
                            pajak = 0;
                            $('#editRkaModal #jumlahEdit').val(numberFormat(jumlah + pajak));
                        }
                    });
                })
            }
        );
    });

    $('#editRkaModal').on('hidden.bs.modal', function () {
        $('#editRkaModal #modal-content-loading').show();
        $('#editRkaModal #modal-content-show').hide();
        $('#editRkaModal #rekeningEdit').val('');
        $('#editRkaModal #komponenEdit').val('');
        $('#editRkaModal #spesifikasiEdit').val('');
        $('#editRkaModal #hargaEdit').val('');
        $('#editRkaModal #satuanEdit').val('');
        $('#editRkaModal #volumeEdit').val('');
        $('#editRkaModal #jumlahEdit').val('');
        $('#editRkaModal #pajakEdit').prop('checked', false);
    });


});
