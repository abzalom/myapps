$(document).ready(function () {
    $('.datatables').DataTable({
        lengthMenu: [
            [-1],
            ['All']
        ],
        deferRender: true,
        scrollY: 200,
        scrollCollapse: true,
        scroller: true
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
            // tags: true,
            // tokenSeparators: [','],
            // closeOnSelect: false,
            allowClear: true,
        });
    });

    $('#getLokasiModal #lokasi').on('change', function () {
        id = $(this).find(':selected').map(function (i, e) {
            return $(e).val() + ";";
        }).get();
        $('#getLokasiModal #idLokasi').html(id)
    });

});
