$(document).ready(function () {
    $('.tambah-komponen').on('click', function () {
        subId = $(this).val();
        $('#addRincianPendatanModal #subrincianid').val(subId);
    });
});
