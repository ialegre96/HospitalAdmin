'use strict';

$(document).ready(function () {
    let tbl = $('#doctorsDepartmentList').DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
    });
    handleSearchDatatable(tbl);
});
