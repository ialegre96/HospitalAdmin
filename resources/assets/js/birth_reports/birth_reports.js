'use strict';

$(document).ready(function () {
    let tbl = $('#birthReportsTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: birthReportUrl,
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center  text-nowrap',
                'width': '15%',
            },
            {
                'targets': [5, 6],
                'visible': false,
            },
            {
                'targets': [7],
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
                data: function(row){
                    let showLink = caseUrl + '/' + row.case_from_birth_report.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">'+ row.case_id +'</a>';
                },
                name: 'case_id',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
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
                    if (row.date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.date).format('LT')}</div>
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    let url = birthReportUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('#birthReportActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'patient.user.last_name',
                name: 'patient.user.last_name',
            },
            {
                data: 'doctor.user.last_name',
                name: 'doctor.user.last_name',
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
    let birthReportId = $(event.currentTarget).data('id');
    deleteItem(birthReportUrl + '/' + birthReportId, '#birthReportsTbl', 'Birth Report');
});
