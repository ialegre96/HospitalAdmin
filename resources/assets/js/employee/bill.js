'use strict';

$(document).ready(function () {
    let tableName = '#tblBills';
    let tbl = $('#tblBills').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: billUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '8%',
            },
            {
                'targets': [3],
                'className': 'text-right',
                'width': '10%',
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
                    let showLink = billUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' +
                        row.bill_id + '</a>';
                },
                name: 'bill_id',
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
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.bill_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.bill_date).utc().format('LT')}</div>
                                <div>${moment(row.bill_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'bill_date',
            },
            {
                data: function (row) {
                    return !isEmpty(row.amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) + '</p>' : 'N/A';
                },
                name: 'amount',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
