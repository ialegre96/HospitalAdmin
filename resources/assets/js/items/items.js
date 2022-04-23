'use strict';

let tbl = $('#itemsTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[5, 'desc']],
    ajax: {
        url: itemUrl,
    },
    columnDefs: [
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '10%',
        },
        {
            'targets': [2],
            'width': '8%',
            'className': 'text-right',
        },
        {
            'targets': [3],
            'width': '15%',
            'className': 'text-right',
        },
        {
            'targets': [5],
            'visible': false,
        },
        {
            targets: '_all',
            defaultContent: 'N/A',
            'className': 'text-start align-middle text-nowrap',
        },
    ],
    columns: [
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'itemcategory.name',
            name: 'itemcategory.name',
        },
        {
            data: function (row){
                return `<span class="badge badge-light-success">${row.unit}</span>`
            },
            name: 'unit',
        },
        {
            data: function (row){
                return `<span class="badge badge-light-info">${row.available_quantity}</span>`
            },
            name: 'available_quantity',
        },
        {
            data: function (row) {
                let url = itemUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('.pageActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let itemId = $(event.currentTarget).data('id');
    deleteItem(itemUrl + '/' + itemId, '#itemsTable', 'Item');
});
