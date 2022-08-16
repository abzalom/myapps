$(document).ready(function () {
    $('.datatables').DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All']
        ],
        // deferRender: true,
        // scrollY: 200,
        // scrollCollapse: true,
        // scroller: true
    });
});
