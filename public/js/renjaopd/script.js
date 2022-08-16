$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    // (function () {
    //     'use strict'

    //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //     var forms = document.querySelectorAll('.needs-validation')

    //     // Loop over them and prevent submission
    //     Array.prototype.slice.call(forms)
    //         .forEach(function (form) {
    //             form.addEventListener('submit', function (event) {
    //                 if (!form.checkValidity()) {
    //                     event.preventDefault()
    //                     event.stopPropagation()
    //                 }

    //                 form.classList.add('was-validated')
    //             }, false)
    //         })
    // })()

    //fix modal force focus
    // $.fn.modal.Constructor.prototype.enforceFocus = function () {
    //     var that = this;
    //     $(document).on('focusin.modal', function (e) {
    //         if ($(e.target).hasClass('select2')) {
    //             return true;
    //         }

    //         if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
    //             that.$element.focus();
    //         }
    //     });
    // };

    $('.select2').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
    });

    $('#selectOpdEdit').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $('#editOpd'), // fix select2 search input focus bug
        maximumSelectionLength: 3,
        language: {
            maximumSelected: function (e) {
                var t = "Satu OPD hanya bisa menampung " + e.maximum + " bidang";
                e.maximum != 1 && (t += "s");
                return t;
            }
        },
    });

    $(document).on('select2:close', '.select2', function (e) {
        var evt = "scroll.select2"
        $(e.target).parents().off(evt)
        $(window).off(evt)
    });

    $('#bidang1').on('change', function () {
        $('#bidang2').html('<option value="" selected>Pilih bidang 2</option>');
        idbid_1 = $(this).val();
        $.ajax({
            url: "http://myapps.com:8686/nomen/bidang1/" + idbid_1,
            method: "GET",
            dataType: "JSON",
            success: function (params) {
                $('#bidang2').removeAttr('disabled');
                $.each(params, function (k, v) {
                    $('#bidang2').append('<option value="' + v.id + '" data-bidsatu="' + idbid_1 + '">' + v.kode_unik_bidang + ' - ' + v.uraian_bidang + '</option>');
                })
            }
        });
    });

    $('#bidang2').on('change', function () {
        $('#bidang3').html('<option value="" selected>Pilih bidang 2</option>');
        idbid_1 = $(this).find(':selected').data('bidsatu');
        idbid_2 = $(this).val();
        alert
        $.ajax({
            url: "http://myapps.com:8686/nomen/bidang1/" + idbid_1 + "/bidang2/" + idbid_2,
            method: "GET",
            dataType: "JSON",
            success: function (params) {
                $('#bidang3').removeAttr('disabled');
                $.each(params, function (k, v) {
                    $('#bidang3').append('<option value="' + v.id + '">' + v.kode_unik_bidang + ' - ' + v.uraian_bidang + '</option>');
                })
            }
        });
    });

    $('#tagOpd').hide();
    $('#tagOpd').removeAttr('name');
    $('#unitOpd').on('click', function (event) {
        if (event.target.checked) {
            $('#tagOpd').show();
            $('#tagOpd').attr('name', 'opdinduk');
            $('#kodeUrut').hide();
            $('#urut').removeAttr('name');

            $('#addBid1').hide();
            $('#addBid2').hide();
            $('#addBid3').hide();
        } else {
            $('#tagOpd').hide();
            $('#tagOpd').removeAttr('name');
            $('#kodeUrut').show();
            $('#urut').attr('name', 'kode_urut');
            $('#addBid1').show();
            $('#addBid2').show();
            $('#addBid3').show();
        }
    });

    $('.edit-opd-btn').on('click', function () {
        $('#selectOpdEdit').html('<option value=""></option>');
        idopd = $(this).val();
        $.ajax({
            url: 'http://myapps.com:8686/perangkat/ambilopd/' + idopd,
            success: function (params) {
                $('#namaOpdEdit').val(params.nama_perangkat);
                $('#kodeOpdEdit').val(params.kode_urut);
                $('#idopdEdit').val(params.id);
                $('#editpad').val(params.pad);
                $('#editdau').val(params.dau);
                $('#editdakfisik').val(params.dak_fisik);
                $('#editdaknonfisik').val(params.dak_non_fisik);
                $('#editotsussg').val(params.otsus_sg);
                $('#editotsusbg').val(params.otsus_bg);
                $('#editotsusdti').val(params.otsus_dti);
                $('#editOpdLabel').html('Edit OPD ' + params.nama_perangkat);
                $('#formEdit').attr('action', 'http://myapps.com:8686/perangkat/update/' + idopd);
            }
        });
        $.ajax({
            url: 'http://myapps.com:8686/perangkat/edit/' + idopd,
            success: function (params) {
                $('#selectOpdEdit').html(params);
            }
        });
    });

    $('.unitOpdEdit').on('click', function () {
        idUnit = $(this).val();
        $('#editUnitOpd').attr('action', 'http://myapps.com:8686/perangkat/updateunit/' + idUnit);
        $.ajax({
            url: 'http://myapps.com:8686/perangkat/unit/' + idUnit,
            method: 'GET',
            dataType: 'JSON',
            success: function (params) {
                $('#namaUnitEdit').val(params.nama_unit);
                a = params;
            },
            complete: function (data) {
                $.ajax({
                    url: 'http://myapps.com:8686/perangkat/unitopdinduk/' + a.f_perangkat_id,
                    method: 'GET',
                    success: function (html) {
                        $('#opdIdUnitEdit').html(html);
                    }
                });
            }
        });
    });

    $('.datatables').DataTable({});

    $('.sumberdana-opd').on('click', function () {
        opd = $(this).val();
        $('#addPaguModal table > tbody').html('');
        $.ajax({
            url: "/pagu/sumberdana/" + opd,
            method: "get",
            dataType: "JSON",
            success: function (data) {
                $('#addPaguModal #tambahSumberDana').html('');
                // $('#addPaguModal #tambahSumberDana').html(data);
                $.each(data, function (i, v) {
                    $('#addPaguModal #tambahSumberDana').append('<optgroup label="' + v.uraian + '">');
                    $.each(v.pendapatan, function (pi, pv) {
                        $('#addPaguModal #tambahSumberDana').append('<option value="' + pv.id + '">' + pv.uraian + '</option>')
                    });
                    $('#addPaguModal #tambahSumberDana').append('</optgroup>');
                });
                $('#addSumberDanaOPD').val(opd);
                $('#getOpd').val(opd);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
            complete: function () {
                ajaxApi('GET', 'JSON', '/pagu/perangkat/' + opd, function (data) {
                    $.each(data, function (key, subrincian) {
                        i = 1;
                        $('#addPaguModal #tableShowPagu').append('<tr class="fw-bold" style="background-color: rgb(255, 255, 231)">' +
                            '<th scope="row"></th>' +
                            '<td>' + subrincian.uraian + '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $.each(subrincian.pendapatan, function (pdtnkey, pendapatan) {
                            if (pendapatan.paguopd.pagu == null) {
                                jumlahPagu = '';
                            } else {
                                jumlahPagu = 'value="' + pendapatan.paguopd.pagu + '"';
                            }
                            $('#addPaguModal #tableShowPagu').append('<tr>' +
                                '<th scope="row">' + i++ + '</th>' +
                                '<td>' + pendapatan.uraian + '</td>' +
                                '<td>' +
                                '<input type="hidden" name="id[]" value="' + pendapatan.paguopd.id + '">' +
                                '<input type="number" name="pagu[]" class="form-control" id="exampleFormControlInput1" ' + jumlahPagu + ' placeholder="Rp. 000,00">' +
                                '</td>' +
                                '<td><button type="button" class="btn btn-sm btn-danger delete-pagu" value="' + pendapatan.paguopd.id + '" data-opd="' + opd + '"><i class="fa-solid fa-trash fa-sm"></i></button></td>' +
                                '</tr>'
                            );
                        });
                    });
                    $('#formPaguUpdate').attr('action', '/pagu/update/' + opd);
                });
            }
        });
    });

    function ajaxApi(method, dataType, url, callback) {
        $.ajax({
            type: method,
            url: url,
            async: true,
            dataType: dataType,
            success: callback,
        });
    }

    $('#addPaguModal #formTambahSumberDana').on('submit', function (e) {
        e.preventDefault();
        opd = $('#getOpd').val();
        $('#formPaguUpdate').removeAttr('action');
        $.ajax({
            type: "post",
            url: "/pagu/store",
            data: $(this).serialize(),
            beforeSend: function () {
                $('#addPaguModal #paguAlert').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
            },
            success: function (data) {
                select = $('#addPaguModal #paguAlert').html('');
                select = $('#addPaguModal #tambahSumberDana').find(':selected').remove();
                select = $('#addPaguModal #paguAlert').html(data);
            },
            error: function (jqXHR, textStatus, errorThrow) {
                console.log(jqXHR.responseText);
            },
            complete: function () {
                ajaxApi('GET', 'JSON', '/pagu/perangkat/' + opd, function (data) {
                    $('#tableShowPagu').html('');
                    i = 1;
                    $.each(data, function (key, subrincian) {
                        i = 1;
                        $('#addPaguModal #tableShowPagu').append('<tr class="fw-bold" style="background-color: rgb(255, 255, 231)">' +
                            '<th scope="row"></th>' +
                            '<td>' + subrincian.uraian + '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>'
                        );
                        $.each(subrincian.pendapatan, function (pdtnkey, pendapatan) {
                            if (pendapatan.paguopd.pagu == null) {
                                jumlahPagu = '';
                            } else {
                                jumlahPagu = 'value="' + pendapatan.paguopd.pagu + '"';
                            }
                            $('#addPaguModal #tableShowPagu').append('<tr>' +
                                '<th scope="row">' + i++ + '</th>' +
                                '<td>' + pendapatan.uraian + '</td>' +
                                '<td>' +
                                '<input type="hidden" name="id[]" value="' + pendapatan.paguopd.id + '">' +
                                '<input type="number" name="pagu[]" class="form-control" id="exampleFormControlInput1" ' + jumlahPagu + ' placeholder="Rp. 000,00">' +
                                '</td>' +
                                '<td><button type="button" class="btn btn-sm btn-danger delete-pagu" value="' + pendapatan.paguopd.id + '" data-opd="' + opd + '"><i class="fa-solid fa-trash fa-sm"></i></button></td>' +
                                '</tr>'
                            );
                        });
                    });
                    $('#formPaguUpdate').attr('action', '/pagu/update/' + opd);
                    // $('#addPaguModal #paguAlert').html('');
                });
            }
        });
    });


    $('body').delegate('.delete-pagu', 'click', function () {
        idpagu = $(this).val();
        opd = $('#getOpd').val();
        $.ajax({
            type: "get",
            url: "/pagu/destroy/id/" + idpagu + '/opd/' + opd,
            beforeSend: function () {
                $('#addPaguModal #paguAlert').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
            },
            success: function (data) {
                $('#tableShowPagu').html('');
                i = 1;
                $.each(data, function (key, subrincian) {
                    i = 1;
                    $('#addPaguModal #tableShowPagu').append('<tr class="fw-bold" style="background-color: rgb(255, 255, 231)">' +
                        '<th scope="row"></th>' +
                        '<td>' + subrincian.uraian + '</td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '</tr>'
                    );
                    $.each(subrincian.pendapatan, function (pdtnkey, pendapatan) {
                        if (pendapatan.paguopd.pagu == null) {
                            jumlahPagu = '';
                        } else {
                            jumlahPagu = 'value="' + pendapatan.paguopd.pagu + '"';
                        }
                        $('#addPaguModal #tableShowPagu').append('<tr>' +
                            '<th scope="row">' + i++ + '</th>' +
                            '<td>' + pendapatan.uraian + '</td>' +
                            '<td>' +
                            '<input type="hidden" name="id[]" value="' + pendapatan.paguopd.id + '">' +
                            '<input type="number" name="pagu[]" class="form-control" id="exampleFormControlInput1" ' + jumlahPagu + ' placeholder="Rp. 000,00">' +
                            '</td>' +
                            '<td><button type="button" class="btn btn-sm btn-danger delete-pagu" value="' + pendapatan.paguopd.id + '"><i class="fa-solid fa-trash fa-sm"></i></button></td>' +
                            '</tr>'
                        );
                    });
                });
                $('#formPaguUpdate').attr('action', '/pagu/update/' + opd);
                $('#addPaguModal #paguAlert').html('');
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
            complete: function () {
                // $('#addPaguModal table > tbody').html('');
                $.ajax({
                    url: "/pagu/sumberdana/" + opd,
                    method: "get",
                    dataType: "JSON",
                    success: function (data) {
                        $('#addPaguModal #tambahSumberDana').html('');
                        $.each(data, function (i, v) {
                            $('#addPaguModal #tambahSumberDana').append('<optgroup label="' + v.uraian + '">');
                            $.each(v.pendapatan, function (pi, pv) {
                                $('#addPaguModal #tambahSumberDana').append('<option value="' + pv.id + '">' + pv.uraian + '</option>')
                            });
                            $('#addPaguModal #tambahSumberDana').append('</optgroup>');
                        });
                        $('#addSumberDanaOPD').val($('#getOpd').val());
                    },
                });
            }
        });
    });

});
