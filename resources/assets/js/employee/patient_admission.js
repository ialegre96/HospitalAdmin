'use strict';

$(document).ready(function () {
    let patientAdmissionsTable = '#patientAdmissionsTbl';
    let tbl = $(patientAdmissionsTable).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: patientAdmissionsUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',
            },
            {
                'targets': [8],
                'width': '5%',
                'orderable': false,
                'className': 'text-center',
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
                    let showLink = patientAdmissionsUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' +
                        row.patient_admission_id + '</a>';
                },
                name: 'patient_admission_id',
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
                    if (row.admission_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.admission_date).utc().format('LT')}</div>
                                <div>${moment(row.admission_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'admission_date',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.discharge_date === null) {
                        return 'N/A';
                    }

                    return moment(row.discharge_date).format('Do MMM, Y h:mm A');
                },
                name: 'discharge_date',
            },
            {
                data: function (row) {
                    if (isEmpty(row.package_id)) {
                        return 'N/A';
                    }
                    let showLink = packageUrl + '/' + row.package.id;
                    return '<a href="' + showLink + '">' + row.package.name +
                        '</a>';
                },
                name: 'package.name',
            },
            {
                data: function (row) {
                    if (isEmpty(row.insurance_id)) {
                        return 'N/A';
                    }
                    let showLink = insuranceUrl + '/' + row.insurance.id;
                    return '<a href="' + showLink + '">' + row.insurance.name +
                        '</a>';
                },
                name: 'insurance.name',
            },
            {
                data: function (row) {
                    return isEmpty(row.policy_no) ? 'N/A' : row.policy_no;
                },
                name: 'policy_no',
            },
            {
                data: function (row) {
                    if (row.status == 1)
                        return `<span class="badge badge-light-success">Active</span>`;
                    else
                        return `<span class="badge badge-light-danger">Deactive</span>`;
                },
                name: 'status',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(patientAdmissionsTable).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

