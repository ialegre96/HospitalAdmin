'use strict';

$(document).ready(function () {

    let tableName = '#opdPatientDepartmentsTable';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[8, 'desc']],
        ajax: {
            url: opdPatientUrl,
        },
        columnDefs: [
            {
                'targets': [1],
                'width': '22%',
            },
            {
                'targets': [3],
                'width': '22%',
            },
            {
                'targets': [4],
                'className': 'text-right',
            },
            {
                'targets': [6],
                'className': 'text-center',
                'width': '10%',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '6%',
            },
            {
                'targets': [8],
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
                    let showLink = opdPatientUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.opd_number +'</a>';
                },
                name: 'opd_number',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient_id;
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
                        <a href="${showLink}"
                           class="mb-1">${row.patient.user.full_name}</a>
                        <span>${row.patient.user.email}</span>
                    </div>
                </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    let showLink = doctorUrl + '/' + row.doctor.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.doctorImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>
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
                                <div class="mb-2">${moment(
                        row.appointment_date).utc().format('LT')}</div>
                                <div>${moment(row.appointment_date).
                        format('Do MMM, Y')}</div>
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
                data: function (row) {
                    if (row.payment_mode == 1) {
                        return `<span class="badge badge-light-primary">${row.payment_mode_name}</span>`;
                    } else if (row.payment_mode == 2) {
                        return `<span class="badge badge-light-success">${row.payment_mode_name}</span>`;
                    }
                },
                name: 'payment_mode',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${row.visits}</span>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('#opdPatientActionTemplate',
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

    $(document).on('click', '.delete-btn', function (event) {
        let opdPatientId = $(event.currentTarget).data('id');
        deleteItem(opdPatientUrl + '/' + opdPatientId, tableName, 'OPD Patient');
    });
});
