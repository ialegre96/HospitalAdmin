'use strict';

$(document).ready(function () {

    let tableName = '#tblInvoices';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: invoiceUrl,
            data: function (data) {
                data.status = $('#status_filter').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',
            },
            {
                'targets': [3],
                'className': 'text-right',
                'width': '10%',
            },
            {
                'targets': [4],
                'className': 'text-left',
                'width': '8%',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [6],
                'visible': false,
                'className': 'text-center text-nowrap',
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
                data: function (row) {
                    let showLink = invoiceUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' +
                        row.invoice_id + '</a>';
                },
                name: 'invoice_id',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="${showLink}">
                                <div>
                                    <img src="${row.image_url}" alt=""
                                         class="user-img">
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}" class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>
                   </div>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.invoice_date === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.invoice_date).format('Do MMM, Y')}</div>
                            </div>`
                },
                name: 'invoice_date',
            },
            {
                data: function (row) {
                    return !isEmpty(row.amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas((row.amount -
                            (row.amount * row.discount / 100)).toFixed(
                            2)) + '</p>' : 'N/A';
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    if (row.status_label === 'Paid')
                        return '<span class="badge badge-light-primary fs-7">' +
                            row.status_label + '</span>';
                    else
                        return '<span class="badge badge-light-warning fs-7">' +
                            row.status_label + '</span>';
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = invoiceUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'patient.user.first_name',
                name: 'patient.user.first_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#status_filter', function () {
                $(tableName).DataTable().ajax.reload(null, true);
                $(tableName).DataTable().page('previous').draw('page');
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(invoiceUrl + '/' + id, tableName, 'Invoice');
    });
});

$(document).ready(function () {
    $(document).on('click', '#resetFilter', function () {
        $('#status_filter').val(2).trigger('change');
    });
});
