'use strict';

$(document).ready(function () {

    let tableName = '#ipdPatientDepartmentsTable';
    let tbl = $('#ipdPatientDepartmentsTable').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: ipdPatientUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
                data: function (row) {
                    let showLink = ipdPatientUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.ipd_number + '</a>';
                },
                name: 'ipd_number',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient_id;
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
                data: function (row) {
                    let showLink = doctorUrl + '/' + row.doctor_id;
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
                    if (row.admission_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.admission_date).format('LT')}</div>
                                <div>${moment(row.admission_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'admission_date',
            },
            {
                data: function (row) {
                    let showLink = bedUrl + '/' + row.bed_id;
                    return '<a href="' + showLink + '">' + row.bed.name +
                        '</a>';
                },
                name: 'bed.name',
            },
            {
                data: function (row) {
                    if (row.bill_status == 1 && row.bill) {
                        if (row.bill.net_payable_amount <= 0) {
                            return '<span class="badge badge-light-success">Paid</span>';
                        }
                    }
                    return '<span class="badge badge-light-danger">Unpaid</span>';
                },
                name: 'bill_status',
            },
            {
                data: function (row) {
                    let url = ipdPatientUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'bill_status': row.bill_status,
                        }];
                    return prepareTemplateRender('#ipdPatientActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$('#filter_status').select2();

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val('').trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let ipdPatientId = $(event.currentTarget).data('id');
    deleteItem(ipdPatientUrl + '/' + ipdPatientId,
        '#ipdPatientDepartmentsTable', 'IPD Patient');
});
