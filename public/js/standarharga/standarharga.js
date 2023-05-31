$(document).ready(function () {
    // console.clear();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var select2 = $(".select2").each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data("width") ?
                $(this).data("width") : $(this).hasClass("w-100") ?
                "100%" : "style",
            placeholder: $(this).data("placeholder"),
            dropdownParent: $(this).parent(), // fix select2 search input focus bug
        });
    });

    $(".datatables-sshsbu").DataTable({
        columnDefs: [{
            targets: [0],
            visible: false,
        }, ],
        rowGroup: {
            dataSrc: [0],
        },
        autoWidth: false,
    });

    $("#dataTable").DataTable({
        serverSide: true,
        searching: true,
        ajax: {
            url: "/api/get/all/standarharga",
            type: 'POST',
            data: {
                ajax: true,
            },
        },
        order: [
            [1, 'asc']
        ],
        rowGroup: {
            dataSrc: 'rekening',
            name: 'rekening',
        },
        columns: [{
            data: 'rekening',
            name: 'rekening',
            searchable: true,
        }, {
            data: 'kategori_subrincian',
            name: 'kategori_subrincian',
            searchable: true,
        }, {
            data: 'uraian',
            name: 'uraian',
            searchable: true,
        }, {
            data: 'spesifikasi',
            name: 'spesifikasi',
            searchable: true,
        }, {
            data: 'satuan',
            name: 'satuan',
            searchable: true,
        }, {
            data: 'harga_zona_1',
            name: 'harga_zona_1',
            searchable: true,
        }, {
            data: 'harga_zona_2',
            name: 'harga_zona_2',
            searchable: true,
        }, {
            data: 'harga_zona_3',
            name: 'harga_zona_3',
            searchable: true,
        }, {
            data: 'nama_kelompok',
            name: 'nama_kelompok',
            searchable: true,
        }, {
            data: 'action',
            name: 'action',
            searchable: true,
        }, ],
        columnDefs: [{
                targets: [0],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $("#addSshModal").on("shown.bs.modal", function () {
        $("#addSshModal #addSshLoading")
            .delay(400)
            .fadeOut(400, function () {
                $("#addSshModal #addSshShow").fadeIn(400);
            });
        $("#addSshModal #kategori").select2({
            theme: "bootstrap-5",
            width: $("#kategori").data("width") ?
                $("#kategori").data("width") : $("#kategori").hasClass("w-100") ?
                "100%" : "style",
            placeholder: $("#kategori").data("placeholder"),
            dropdownParent: $("#kategori").parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/neraca/kategori/1/search",
                dataType: "json",
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                        q: params.term,
                    };
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
                cache: true,
            },
        });
    });

    $("#addSshModal #kategori").on("change", function () {
        idsubrincian = $(this).val();

        $("#addSshModal #uraian").attr("disabled", true);
        $("#addSshModal #spesifikasi").attr("disabled", true);
        $("#addSshModal #harga").attr("disabled", true);
        $("#addSshModal #satuan").attr("disabled", true);
        $("#addSshModal #zonasi").attr("disabled", true);
        $("#addSshModal #jenis").attr("disabled", true);
        $("#addSshModal #inflasi").attr("disabled", true);
        $("#addSshModal #zona_2").attr("disabled", true);
        $("#addSshModal #zona_3").attr("disabled", true);

        $("#addSshModal #rekening").html('<option value="0">Pilih...</option>');
        $("#addSshModal #rekening").attr("disabled", false);
        $("#addSshModal #rekening").select2({
            theme: "bootstrap-5",
            width: $("#rekening").data("width") ?
                $("#rekening").data("width") : $("#rekening").hasClass("w-100") ?
                "100%" : "style",
            placeholder: $("#rekening").data("placeholder"),
            dropdownParent: $("#rekening").parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lra/1/subrincian/search",
                dataType: "json",
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                        q: params.term,
                    };
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
                cache: true,
            },
        });
    });

    $("#addSshModal #rekening").on("change", function () {
        $("#addSshModal #zonasi").html(
            '<option value="1" selected>Ya</option><option value="2">Tidak</option>'
        );
        $("#addSshModal #uraian").attr("disabled", false);
        $("#addSshModal #spesifikasi").attr("disabled", false);
        $("#addSshModal #harga").attr("disabled", false);
        $("#addSshModal #satuan").attr("disabled", false);
        $("#addSshModal #zonasi").attr("disabled", false);
        $("#addSshModal #jenis").attr("disabled", false);
        $("#addSshModal #inflasi").attr("disabled", false);

        $.get(
            "/api/data/get/jeniskomponen",
            function (data, textStatus, jqXHR) {
                $.each(data, function (key, value) {
                    $("#addSshModal #jenis").append(
                        '<option value="' + value.id + '">' + value.uraian + "</option>"
                    );
                });
            },
            "JSON"
        );
    });

    $("#addSshModal").on("hidden.bs.modal", function () {
        $("#addSshModal #addSshLoading").show();
        $("#addSshModal #addSshShow").hide();

        $("#addSshModal #rekening").attr("disabled", true);

        $("#addSshModal #kategori").html("");
        $("#addSshModal #rekening").html("");
        $("#addSshModal #zonasi").html(
            '<option value="1" selected>Ya</option><option value="2">Tidak</option>'
        );
        $("#addSshModal #jenis").html("");
        $("#addSshModal #kategori").attr("disabled", true);
        $("#addSshModal #rekening").attr("disabled", true);
        $("#addSshModal #jenis").attr("disabled", true);
    });

    /**
     * Upload SSH
     */
    $("#uploadStandarHargaModal").on("hidden.bs.modal", function () {
        $("#uploadStandarHargaModal #uploadStandarHarga").val("");
    });

    /**
     * Edit Komponen SSH
     */

    $("#editSshModal").on("shown.bs.modal", function () {
        $("#editSshModal #editSshLoading")
            .delay(400)
            .fadeOut(400, function () {
                $("#editSshModal #editSshShow").fadeIn(400);
            });
        $("#editSshModal #kategoriEdit").select2({
            theme: "bootstrap-5",
            width: $("#kategoriEdit").data("width") ?
                $("#kategoriEdit").data("width") : $("#kategoriEdit").hasClass("w-100") ?
                "100%" : "style",
            placeholder: $("#kategoriEdit").data("placeholder"),
            dropdownParent: $("#kategoriEdit").parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/get/kategori/by/kode",
                dataType: "json",
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "POST",
                data: function (params) {
                    var queryParameters = {
                        q: params.term,
                    };
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
                cache: true,
            },
        });
        $("#editSshModal #rekeningEdit").select2({
            theme: "bootstrap-5",
            width: $("#rekeningEdit").data("width") ?
                $("#rekeningEdit").data("width") : $("#rekeningEdit").hasClass("w-100") ?
                "100%" : "style",
            placeholder: $("#rekeningEdit").data("placeholder"),
            dropdownParent: $("#rekeningEdit").parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/get/rekening/by/kode",
                dataType: "json",
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "POST",
                data: function (params) {
                    var queryParameters = {
                        q: params.term,
                    };
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
                cache: true,
            },
        });


        // $("#editSshModal #rekeningEdit").html(
        //     '<option value="0">Pilih...</option>'
        // );
        $("#editSshModal #rekeningEdit").attr("disabled", false);
        $("#editSshModal #rekeningEdit").select2({
            theme: "bootstrap-5",
            width: $("#rekeningEdit").data("width") ?
                $("#rekeningEdit").data("width") : $("#rekeningEdit").hasClass("w-100") ?
                "100%" : "style",
            placeholder: $("#rekeningEdit").data("placeholder"),
            dropdownParent: $("#rekeningEdit").parent(), // fix select2 search input focus bug
            ajax: {
                url: "/api/lra/1/subrincian/search",
                dataType: "json",
                delay: 250,
                minimumInputLength: 3,
                minimumResultsForSearch: 20,
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                        q: params.term,
                    };
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                id: item.kode_unik_subrincian,
                                text: item.kode_unik_subrincian + " - " + item.uraian,
                            };
                        }),
                    };
                },
                cache: true,
            },
        });

    });

    $(document).on("click", ".edit-komponen-ssh", function () {
        idkomponen = $(this).val();
        $("#editSshModal #idkomponen").val(idkomponen);
        $.ajax({
            type: "post",
            url: "/api/find/standarharga",
            data: {
                id: idkomponen,
            },
            dataType: "JSON",
            success: function (data) {
                $("#editSshModal #editSshModalLabel").html(
                    data.uraian
                );
                if (data.kategori_subrincian) {
                    $("#editSshModal #kategoriEdit").html(
                        '<option value="' +
                        data.kategori_subrincian +
                        '" selected>' +
                        data.kategori_subrincian +
                        " - " +
                        data.kategori_uraian +
                        "</option>"
                    );
                };
                $("#editSshModal #rekeningEdit").html(
                    '<option value="' +
                    data.rekening_subrincian +
                    '" selected>' +
                    data.rekening_subrincian +
                    " - " +
                    data.rekening_uraian +
                    "</option>"
                );
                $("#editSshModal #uraianEdit").val(data.uraian);
                $("#editSshModal #spekEdit").val(data.spesifikasi);
                $("#editSshModal #satuanEdit").val(data.satuan);
                $("#editSshModal #zona1Edit").val(
                    data.harga_zona_1 ?
                    parseFloat(data.harga_zona_1) :
                    ""
                );
                $("#editSshModal #zona2Edit").val(
                    data.harga_zona_2 ?
                    parseFloat(data.harga_zona_2) :
                    ""
                );
                $("#editSshModal #zona3Edit").val(
                    data.harga_zona_3 ?
                    parseFloat(data.harga_zona_3) :
                    ""
                );
            },
        });
    });

    // $("#editSshModal #kategoriEdit").on("change", function () {
    //     idsubrincian = $(this).val();

    //     $("#editSshModal #rekeningEdit").html(
    //         '<option value="0">Pilih...</option>'
    //     );
    //     $("#editSshModal #rekeningEdit").attr("disabled", false);
    //     $("#editSshModal #rekeningEdit").select2({
    //         theme: "bootstrap-5",
    //         width: $("#rekeningEdit").data("width") ?
    //             $("#rekeningEdit").data("width") : $("#rekeningEdit").hasClass("w-100") ?
    //             "100%" : "style",
    //         placeholder: $("#rekeningEdit").data("placeholder"),
    //         dropdownParent: $("#rekeningEdit").parent(), // fix select2 search input focus bug
    //         ajax: {
    //             url: "/api/lra/1/subrincian/search",
    //             dataType: "json",
    //             delay: 250,
    //             minimumInputLength: 3,
    //             minimumResultsForSearch: 20,
    //             type: "GET",
    //             data: function (params) {
    //                 var queryParameters = {
    //                     q: params.term,
    //                 };
    //                 return queryParameters;
    //             },
    //             processResults: function (data) {
    //                 return {
    //                     results: $.map(data.data, function (item) {
    //                         return {
    //                             id: item.kode_unik_subrincian,
    //                             text: item.kode_unik_subrincian + " - " + item.uraian,
    //                         };
    //                     }),
    //                 };
    //             },
    //             cache: true,
    //         },
    //     });
    // });

    $("#editSshModal").on("hidden.bs.modal", function () {
        $("#editSshModal #editSshLoading").show();
        $("#editSshModal #editSshShow").hide();

        $("#editSshModal #kategoriEdit").html("");
        $("#editSshModal #rekeningEdit").html("");
    });

    $(".delete-komponen-ssh").on("click", function () {
        idkomponen = $(this).val();
        $("#deleteSshModal #idkomponenDelete").val(idkomponen);
    });
});
