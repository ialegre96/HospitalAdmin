'use strict';

$(document).ready(function () {
    let tableName = '#patientDiagnosisTestTable';
    let tbl = $('#patientDiagnosisTestTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'asc']],
        ajax: {
            url: patientDiagnosisTestUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '12%',
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
                    let showLink = patientDiagnosisTestUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.report_number +
                        '</a>';
                },
                name: 'report_number',
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
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.doctorImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="mb-1 fw-bold text-dark">${row.doctor.user.full_name}</span>
                            <span>${row.doctor.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: 'category.name',
                name: 'category.name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.created_at === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.created_at).format('Do MMM, Y')}</div>
                            </div>`
                },
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
