'use strict';

let tbl = $('#itemStocksTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [6, 'desc'],
    ajax: {
        url: itemStockUrl,
    },
    columnDefs: [
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '10%',
        },
        {
            'targets': [2, 3],
            'className': 'text-right',
        },
        {
            'targets': [6],
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
            data: 'item.name',
            name: 'item.name',
        },
        {
            data: 'item.itemcategory.name',
            name: 'item.itemcategory.name',
        },
        {
            data: function (row){
                return `<span class="badge badge-light-success">${row.quantity}</span>`;
            },
            name: 'quantity',
        },
        {
            data: function (row) {
                return !isEmpty(row.purchase_price) ? '<p class="cur-margin">' +
                    getCurrentCurrencyClass() + ' ' +
                    addCommas(row.purchase_price) + '</p>' : 'N/A';
            },
            name: 'purchase_price',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                if (row.created_at === null) {
                    return 'N/A';
                }
                return `<div class="badge badge-light">
                            <div>${moment(row.created_at).utc().format('Do MMM, Y')}</div>
                        </div>`;
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                let url = itemStockUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                        'hasAttachment': !isEmpty(row.item_stock_url)
                            ? true
                            : false,
                        'attachmentSaveUrl': itemStockDownload + '/' + row.id,
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
    let itemStockId = $(event.currentTarget).data('id');
    deleteItem(itemStockUrl + '/' + itemStockId, '#itemStocksTable',
        'Item Stock');
});
