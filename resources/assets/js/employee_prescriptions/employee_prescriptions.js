'use strict';

$(document).ready(function () {
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
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
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
                    return `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a>
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                    class="user-img">
                            </div>
                        </a>
                    </div>
                    <div class="d-inline-block align-top">
                        <a class="text-dark mb-1 d-block">${row.patient.user.full_name}</a>
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
                    let showLink = prescriptionUrl + '/' + row.id;
                    let data = [
                        {
                            'viewUrl': showLink,
                        }];
                    return prepareTemplateRender('#employeePrescriptionActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
