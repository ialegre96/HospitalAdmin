'use strict';

$(document).ready(function () {
    let tableName = '#tblInvoices';
    let tbl = $('#tblInvoices').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: invoiceUrl,
            data: function (data) {
                data.status = $('#status_filter').find('option:selected').val();
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
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                    class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a href="${showLink}"
                           class="text-primary-800 mb-1 d-block">${row.patient.user.full_name}</a>
                        <span class="d-block">${row.patient.user.email}</span>
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
                                <div class="mb-2">${moment(row.invoice_date).utc().format('LT')}</div>
                                <div>${moment(row.invoice_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
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
                data: 'patient.user.first_name',
                name: 'patient.user.first_name',
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
});

$('#status_filter').select2({
    width: '100%',
});

$(document).on('click', '#resetFilter', function () {
    $('#status_filter').val(2).trigger('change');
});
