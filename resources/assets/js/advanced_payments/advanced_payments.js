'use strict';

$(document).ready(function () {

    let tbl = $('#advancedPaymentsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [5, 'desc'],
        ajax: {
            url: advancedPaymentUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center  text-nowrap',
                'width': '8%',
            },
            {
                'targets': [3],
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
                data: function (row) {
                    let showLink = advancedPaymentUrl + '/' + row.id;
                    return '<a class="badge badge-light-info" href="' + showLink + '">' +
                        row.receipt_no + '</a>';
                },
                name: 'receipt_no',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="${showLink}">
                                <div class="">
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
                name: 'patient.user.first_name',
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
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return !isEmpty(row.amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) + '</p>' : 'N/A';
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    let url = advancedPaymentUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('.modalActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let advancedPaymentId = $(event.currentTarget).data('id');
    deleteItem(advancedPaymentUrl + '/' + advancedPaymentId,
        '#advancedPaymentsTable', 'Advanced Payment');
});
