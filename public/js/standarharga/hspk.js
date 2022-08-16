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

    $('.datatables-sshsbu').DataTable({
        columnDefs: [{
            targets: [0],
            visible: false
        }],
        rowGroup: {
            dataSrc: [0]
        },
        autoWidth: false,
    });

    $('#addSshModal').on('shown.bs.modal', function () {
        $('#addSshModal #addSshLoading').delay(400).fadeOut(400, function () {
            $('#addSshModal #addSshShow').fadeIn(400);
        });
        $('#addSshModal #kategori').select2({
            theme: "bootstrap-5",
            width: $('#kategori').data('width') ? $('#kategori').data('width') : $('#kategori').hasClass('w-100') ? '100%' : 'style',
            placeholder: $('#kategori').data('placeholder'),
            dropdownParent: $('#kategori').parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lo/kategori/2/search",
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
                                text: item.kode_unik_subrincian + ' - ' + item.uraian
                            }
                        })
                    };
                },
                cache: true
            },
        });
    });

    $('#addSshModal #kategori').on('change', function () {
        idsubrincian = $(this).val();

        $('#addSshModal #uraian').attr('disabled', true);
        $('#addSshModal #spesifikasi').attr('disabled', true);
        $('#addSshModal #harga').attr('disabled', true);
        $('#addSshModal #satuan').attr('disabled', true);
        $('#addSshModal #zonasi').attr('disabled', true);
        $('#addSshModal #jenis').attr('disabled', true);
        $('#addSshModal #inflasi').attr('disabled', true);

        $('#addSshModal #rekening').html('<option value="0">Pilih...</option>');
        $('#addSshModal #rekening').attr('disabled', false);
        $('#addSshModal #rekening').select2({
            theme: "bootstrap-5",
            width: $('#rekening').data('width') ? $('#rekening').data('width') : $('#rekening').hasClass('w-100') ? '100%' : 'style',
            placeholder: $('#rekening').data('placeholder'),
            dropdownParent: $('#rekening').parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lra/2/subrincian/search",
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
                                text: item.kode_unik_subrincian + ' - ' + item.uraian
                            }
                        })
                    };
                },
                cache: true
            },
        });

    });

    $('#addSshModal #rekening').on('change', function () {
        $('#addSshModal #zonasi').html('<option value="0">Pilih...</option>');
        $('#addSshModal #jenis').html('<option value="0">Pilih...</option>');
        $('#addSshModal #uraian').attr('disabled', false);
        $('#addSshModal #spesifikasi').attr('disabled', false);
        $('#addSshModal #harga').attr('disabled', false);
        $('#addSshModal #satuan').attr('disabled', false);
        $('#addSshModal #zonasi').attr('disabled', false);
        $('#addSshModal #jenis').attr('disabled', false);
        $('#addSshModal #inflasi').attr('disabled', false);

        $.get("/api/data/get/zonasi",
            function (data, textStatus, jqXHR) {
                $.each(data, function (key, value) {
                    $('#addSshModal #zonasi').append('<option value="' + value.id + '">' + value.uraian + '</option>');
                });
            },
            "JSON"
        );
        $.get("/api/data/get/jeniskomponen",
            function (data, textStatus, jqXHR) {
                $.each(data, function (key, value) {
                    $('#addSshModal #jenis').append('<option value="' + value.id + '">' + value.uraian + '</option>');
                });
            },
            "JSON"
        );
    });


    $('#addSshModal').on('hidden.bs.modal', function () {
        $('#addSshModal #addSshLoading').show();
        $('#addSshModal #addSshShow').hide();

        $('#addSshModal #rekening').attr('disabled', true);

        $('#addSshModal #kategori').html('');
        $('#addSshModal #rekening').html('');
        $('#addSshModal #zonasi').html('');
        $('#addSshModal #jenis').html('');
        $('#addSshModal #kategori').attr('disabled', true);
        $('#addSshModal #rekening').attr('disabled', true);
        $('#addSshModal #zonasi').attr('disabled', true);
        $('#addSshModal #jenis').attr('disabled', true);
    });

    /**
     * Upload SSH
     */
    $('#uploadSshModal').on('hidden.bs.modal', function () {
        $('#uploadSshModal #uploadSshInput').val('');
    });


    /**
     * Edit Komponen SSH
     */

    $('#editSshModal').on('shown.bs.modal', function () {
        $('#editSshModal #editSshLoading').delay(400).fadeOut(400, function () {
            $('#editSshModal #editSshShow').fadeIn(400);
        });
        $('#editSshModal #kategoriEdit').select2({
            theme: "bootstrap-5",
            width: $('#kategoriEdit').data('width') ? $('#kategoriEdit').data('width') : $('#kategoriEdit').hasClass('w-100') ? '100%' : 'style',
            placeholder: $('#kategoriEdit').data('placeholder'),
            dropdownParent: $('#kategoriEdit').parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lo/kategori/2/search",
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
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + ' - ' + item.uraian
                            }
                        })
                    };
                },
                cache: true
            },
        });
    });

    $('.edit-komponen-ssh').on('click', function () {
        idkomponen = $(this).val();
        $('#editSshModal #idkomponen').val(idkomponen);
        $.getJSON("/api/komponen/ssh/" + idkomponen,
            function (komponen, textStatus, jqXHR) {
                $.getJSON("/api/lo/subrincian/bykode/" + komponen.kategori_subrincian.split('.').join('-'),
                    function (kategori, textStatus, jqXHR) {
                        $('#editSshModal #kategoriEdit').html('<option value="' + kategori.kode_unik_subrincian + '" selected>' + kategori.kode_unik_subrincian + ' - ' + kategori.uraian + '</option>')
                        // console.log(kategori);
                    }
                );
                $.getJSON("/api/lra/subrincian/bykode/" + komponen.rekening_subrincian.split('.').join('-'),
                    function (rekening, textStatus, jqXHR) {
                        $('#editSshModal #rekeningEdit').html('<option value="' + rekening.kode_unik_subrincian + '" selected>' + rekening.kode_unik_subrincian + ' - ' + rekening.uraian + '</option>')
                    }
                );
                $('#editSshModal #uraianEdit').val(komponen.uraian);
                $('#editSshModal #spesifikasiEdit').val(komponen.spesifikasi);
                $('#editSshModal #hargaEdit').val(komponen.harga);
                $('#editSshModal #satuanEdit').val(komponen.satuan);
                $('#editSshModal #zonasiEdit').val(komponen.zonasi);
                console.log(komponen.e_jenis_komponen_id);
                $.get("/api/data/get/jeniskomponen",
                    function (data, textStatus, jqXHR) {
                        $.each(data, function (key, value) {
                            if (komponen.e_jenis_komponen_id == value.id) {
                                $('#editSshModal #jenisEdit').append('<option value="' + value.id + '" selected>' + value.uraian + '</option>');
                            } else {
                                $('#editSshModal #jenisEdit').append('<option value="' + value.id + '">' + value.uraian + '</option>');
                            }
                        });
                    },
                    "JSON"
                );
                $('#editSshModal #inflasiEdit').val(komponen.inflasi);
            }
        );
    });

    $('#editSshModal #kategoriEdit').on('change', function () {
        idsubrincian = $(this).val();

        $('#editSshModal #rekeningEdit').html('<option value="0">Pilih...</option>');
        $('#editSshModal #rekeningEdit').attr('disabled', false);
        $('#editSshModal #rekeningEdit').select2({
            theme: "bootstrap-5",
            width: $('#rekeningEdit').data('width') ? $('#rekeningEdit').data('width') : $('#rekeningEdit').hasClass('w-100') ? '100%' : 'style',
            placeholder: $('#rekeningEdit').data('placeholder'),
            dropdownParent: $('#rekeningEdit').parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lra/2/subrincian/search",
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
                                text: item.kode_unik_subrincian + ' - ' + item.uraian
                            }
                        })
                    };
                },
                cache: true
            },
        });

    });

    $('#editSshModal').on('hidden.bs.modal', function () {
        $('#editSshModal #editSshLoading').show();
        $('#editSshModal #editSshShow').hide();

        $('#editSshModal #kategoriEdit').html('');
        $('#editSshModal #rekeningEdit').html('');
    });

    $('.delete-komponen-ssh').on('click', function () {
        idkomponen = $(this).val();
        $('#deleteSshModal #idkomponenDelete').val(idkomponen);
    });


});
