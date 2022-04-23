'use strict';

$(document).ready(function () {
    let tableName = '#bedsAssigns';
    let tbl = $(tableName).DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
    });
    handleSearchDatatable(tbl);
});
