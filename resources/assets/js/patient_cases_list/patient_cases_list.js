'use strict';

$(document).ready(function () {
    let tbl = $('#patientCasesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [3, 'desc'],
        ajax: {
            url: patientCasesUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',

            },
            {
                'targets': [5],
                'className': 'text-right',
            },
            {
                'targets': [1],
                'width': '15%',
            },
            // {
            //     'targets': [11],
            //     'visible': false,
            // },
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center',
                'width': '6%',
            },
            {
                'targets': [7, 8],
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
                    let showLink = patientCaseShowUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.case_id + '</a>';
                },
                name: 'case_id',
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
                    if (row.date === null) {
                        return '';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.date).
                        format('LT')}</div>
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: 'phone',
                name: 'phone',
            },
            {
                data: function (row) {
                    return !isEmpty(row.fee) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.fee) + '</p>' : 'N/A';
                },
                name: 'fee',
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
            {
                data: function (row) {
                    let showLink = patientCaseShowUrl + '/' + row.id;
                    return '<a title="Show" class="btn action-btn btn-primary btn-sm mr-1" href="' +
                        showLink + '">' +
                        '<i class="fa fa-eye action-icon p-case-list-color"></i>' +
                        '</a>';
                }, name: 'id',
            },
            {
                data: 'patient.user.first_name',
                name: 'patient.user.first_name',
                visible: false,
            },
            {
                data: 'doctor.user.last_name',
                name: 'doctor.user.last_name',
                visible: false,
            },
            // {
            //     data: 'created_at',
            //     name: 'created_at',
            // },
        ],
    });
    handleSearchDatatable(tbl);
});
