'use strict';

$(document).ready(function () {
    let tableName = '#prescriptionsTable';
    let tbl = $('#prescriptionsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: prescriptionUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center',
                'width': '10%',

            },
            {
                'targets': [8],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '5%',
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
                    return isEmpty(row.medical_history)
                        ? 'N/A'
                        : row.medical_history;
                },
                name: 'medical_history',
            },
            {
                data: function (row) {
                    return isEmpty(row.current_medication)
                        ? 'N/A'
                        : row.current_medication;
                },
                name: 'current_medication',
            },
            {
                data: function (row) {
                    return isEmpty(row.health_insurance)
                        ? 'N/A'
                        : row.health_insurance;
                },
                name: 'health_insurance',
            },
            {
                data: function (row) {
                    return isEmpty(row.low_income) ? 'N/A' : row.low_income;
                },
                name: 'low_income',
            },
            {
                data: function (row) {
                    return isEmpty(row.reference) ? 'N/A' : row.reference;
                },
                name: 'reference',
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
                    let showLink = prescriptionUrl + '/' + row.id;
                    let data = [
                        {
                            'viewUrl': showLink,
                        }];
                    return prepareTemplateRender('#patientsPrescriptionActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
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

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});
