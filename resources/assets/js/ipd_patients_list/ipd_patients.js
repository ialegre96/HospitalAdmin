'use strict';

$(document).ready(function () {
    let tableName = '#ipdPatientDepartmentsTable';
    let tbl = $('#ipdPatientDepartmentsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: ipdPatientUrl,
        },
        columnDefs: [
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    let showLink = ipdPatientUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' +
                        row.ipd_number +
                        '</a>';
                },
                name: 'ipd_number',
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
                data: 'bed.name',
                name: 'bed.name',
            },
            {
                data: 'patient.user.phone',
                name: 'patient.user.phone',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
