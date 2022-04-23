'use strict';

$(document).ready(function () {
    let tableName = '#tblIpdPayments';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: ipdPaymentUrl,
            data: function (data) {
                data.id = ipdPatientDepartmentId;
            },
        },
        columnDefs: [
            {
                'targets': [0, 1, 2],
                'width': '10%',
            },
            {
                'targets': [0],
                'className': 'text-right',
            },
            {
                'targets': [3],
                'width': '5%',
            },
            {
                'targets': [4],
                'width': '20%',
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
                    return !isEmpty(row.amount)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) + '</p>'
                        : 'N/A';
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.date).
                        utc().
                        format('LT')}</div>
                                <div>${moment(row.date).
                        utc().
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return ipdPaymentModes[row.payment_mode];
                },
                name: 'payment_mode',
            },
            {
                data: function (row) {
                    if (row.ipd_payment_document_url != '') {
                        let downloadLink = downloadPaymetDocumentUrl + '/' +
                            row.id;
                        return '<a href="' + downloadLink + '">' + 'Download' +
                            '</a>';
                    } else
                        return 'N/A';
                },
                name: 'id',
            },
            {
                data: 'notes',
                name: 'notes',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
