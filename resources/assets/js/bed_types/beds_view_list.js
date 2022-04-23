'use strict';

$(document).ready(function () {
    let tableName = '#bedTypesTable';
    let tbl = $(tableName).DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
    });
    handleSearchDatatable(tbl);
});
