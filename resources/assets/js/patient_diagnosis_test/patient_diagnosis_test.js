'use strict';

let tableName = '#patientDiagnosisTestTable';
let tbl = $('#patientDiagnosisTestTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[6, 'desc']],
    ajax: {
        url: patientDiagnosisTestUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '12%',
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '8%',
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
                let showLink = patientDiagnosisTestUrl + '/' + row.id;
                return '<a href="' + showLink + '" class="badge badge-light-info">' + row.report_number +
                    '</a>';
            },
            name: 'report_number',
        },
        {
            data: function (row) {
                let showLink = patientUrl + '/' + row.patient.id;
                let patientName;
                if (checkLabTechnicianRole){
                    patientName = `<div class="d-flex flex-column">
                            <span class="mb-1 text-dark fw-bold">${row.patient.user.full_name}</span>
                            <span>${row.patient.user.email}</span>
                        </div>`
                }else {
                    patientName = `<div class="d-flex flex-column">
                            <a href="${showLink}" class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>`
                }
                return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        ${patientName}       
                    </div>`;
            },
            name: 'patient.user.first_name',
        },
        {
            data: function (row) {
                let showLink;
                if (checkLabTechnicianRole){
                    showLink = doctorUrl + '/' + row.doctor.id;
                }else {
                    showLink = doctorUrl + '/' + row.doctor.id;
                }
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
                            <a href="${showLink}" class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>             
                    </div>`;
            },
            name: 'doctor.user.first_name',
        },
        {
            data: function (row) {
                let showLink = diagnosisCategoryUrl + '/' + row.category.id;
                return '<a href="' + showLink + '">' + row.category.name +
                    '</a>';
            },
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
                            </div>`;
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                let url = patientDiagnosisTestUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender(
                    '#patientDiagnosisTestActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let patientDiagnosisTestId = $(event.currentTarget).data('id');
    deleteItem(patientDiagnosisTestUrl + '/' + patientDiagnosisTestId,
        '#patientDiagnosisTestTable', 'Patient diagnosis test');
});
