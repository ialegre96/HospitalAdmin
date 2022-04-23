'use strict';

$(document).ready(function () {
    let tableName = '#opdPatientDepartmentsTable';
    let tbl = $('#opdPatientDepartmentsTable').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: opdPatientUrl,
        },
        columnDefs: [
            {
                'targets': [6],
                'className': 'text-center',
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
                    let showLink = opdPatientUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.opd_number +
                        '</a>';
                },
                name: 'opd_number',
            },
            {
                data: function (row) {
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.doctorImageUrl}" alt="" class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a class="text-dark fw-bold mb-1 d-block">${row.doctor.user.full_name}</a>
                        <span class="d-block">${row.doctor.user.email}</span>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.appointment_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.admission_date).format('LT')}</div>
                                <div>${moment(row.admission_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'appointment_date',
            },
            {
                data: function (row) {
                    return getCurrentCurrencyClass() +
                        addCommas(row.standard_charge);
                },
                name: 'standard_charge',
            },
            {
                data: 'payment_mode_name',
                name: 'payment_mode',
            },
            {
                data: 'patient.user.phone',
                name: 'patient.user.phone',
            },
            {
                data: 'visits',
                name: 'doctor.user.last_name',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
