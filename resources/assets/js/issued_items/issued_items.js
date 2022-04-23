'use strict';

$('#filter_status').select2();

let tbl = $('#issuedItemsTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[7, 'desc']],
    ajax: {
        url: issuedItemUrl,
        data: function (data) {
            data.status = $('#filter_status').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center',
            'width': '10%',
        },
        {
            'targets': [6],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '10%',
        },
        {
            'targets': [4],
            'className': 'text-right',
        },
        {
            'targets': [7],
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
            data: function (row) {
                return row;
            },
            render: function (row) {
                return `<div class="badge badge-light">
                            <div>${moment(row.issued_date).utc().format('Do MMM, Y')}</div>
                        </div>`;
            },
            name: 'issued_date',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                if (row.return_date === null) {
                    return 'N/A';
                }

                return `<div class="badge badge-light">
                            <div>${moment(row.return_date).utc().format('Do MMM, Y')}</div>
                        </div>`;
            },
            name: 'return_date',
        },
        {
            data: function (row) {
                return `<span class="badge badge-light-primary fs-7">${row.quantity}</span>`;
            },
            name: 'quantity',
        },
        {
            data: function (row) {
                let statusText = (row.status == 0) ? 'Return Item' : 'Returned';
                let statusBadge = (row.status == 0)
                    ? 'light-info'
                    : 'light-primary';
                let data = [
                    {
                        'id': row.id,
                        'status': row.status,
                        'statusText': statusText,
                        'statusBadge': statusBadge,
                    }];
                return prepareTemplateRender('#issuedItemStatusTemplate', data);
            },
            name: 'status',
        },
        {
            data: function (row) {
                let url = issuedItemUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#issuedItemActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#filter_status', function () {
            $('#issuedItemsTable').DataTable().ajax.reload(null, true);
        });
    },
});
handleSearchDatatable(tbl);

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let issuedItemId = $(event.currentTarget).data('id');
    deleteItem(issuedItemUrl + '/' + issuedItemId, '#issuedItemsTable',
        'Issued Item');
});

$(document).on('click', '.changes-status-btn', function (event) {
    let issuedItemId = $(this).data('id');
    const issuedItemStatus = $(this).data('status');

    if (!issuedItemStatus) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'swal2-confirm btn fw-bold btn-danger mt-0',
                cancelButton: 'swal2-cancel btn fw-bold btn-bg-light btn-color-primary mt-0'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Return Item !',
            text: 'Are you sure want to return this item ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: returnIssuedItemUrl,
                    type: 'get',
                    dataType: 'json',
                    data: {id: issuedItemId},
                    success: function (data) {
                        swal.fire({
                            title: 'Item Returned!',
                            confirmButtonColor: '#009ef7',
                            text: data.message,
                            timer: 2000,
                        });
                        tbl.ajax.reload(null, true);
                    },
                });
            }
        });
    }
});
