'use strict';

$(document).ready(function () {
    let tables = [
        '#doctorCases',
        '#doctorPatients',
        '#doctorAppointments',
        '#doctorSchedules',
        '#doctorPayrolls'];

    $.each(tables, function (index, value) {
        let tbl = $(value).DataTable({
            'language': {
                'lengthMenu': 'Show _MENU_',
            },
        });
        searchDataTable(tbl, '#search-table-' + (index + 1));
    });

    function searchDataTable(tbl, selector) {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tbl.search(e.target.value).draw();
        });
    }
});
