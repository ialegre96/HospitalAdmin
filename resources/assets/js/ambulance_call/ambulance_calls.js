'use strict';

$(document).ready(function () {
    let tableName = '#ambulanceCallsTbl';
    let tbl = $('#ambulanceCallsTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[6, 'desc']],
        ajax: {
            url: ambulanceCallUrl,
        },
        columnDefs: [
            {
                'targets': [4],
                'className': 'text-right',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
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
                            <a href="${showLink}"
                               class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: 'ambulance.vehicle_model',
                name: 'ambulance.vehicle_model',
            },
            {
                data: 'driver_name',
                name: 'driver_name',
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
                            </div>`;
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
                    let url = ambulanceCallUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender(
                        '#ambulanceCallsActionTemplate',
                        data);
                }, name: 'id',
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
    let ambulanceCallId = $(event.currentTarget).data('id');
    deleteItem(ambulanceCallUrl + '/' + ambulanceCallId, '#ambulanceCallsTbl',
        'Ambulance Call');
});
