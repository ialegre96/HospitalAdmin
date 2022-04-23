'use strict';

$(document).ready(function () {
    let tableName = '#userDocuments';
    let tbl = $(tableName).DataTable({
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [1, 'asc'],
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-center text-nowrap',
                'orderable': false,
            },
        ]
    });
    handleSearchDatatable(tbl);
});
