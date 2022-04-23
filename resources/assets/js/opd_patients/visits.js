'use strict';

let tableName = '#visitedOPDPatientTable';
let tbl = $('#visitedOPDPatientTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[0, 'desc']],
    ajax: {
        url: visitedOPDPatients,
        data: {
            patient_id: patient_id,
            id: opdPatientDepartmentId,
        },
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '8%',
        },
        {
            'targets': [7],
            'className': 'text-center text-nowrap',
            'width': '5%',
        },
        {
            'targets': [2],
            'className': 'text-right',
            'width': '12%',
        },
        {
            'targets': [1, 3],
            'width': '12%',
        },
        {
            'targets': [5, 6],
            render: function (data) {
                if (data != null) {
                    return data.length > 30 ?
                        data.substr(0, 30) + '...' :
                        data;
                }
            },
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
                return '<a href="' + showLink + '" class="badge badge-light-info">' + row.opd_number +
                    '</a>';
            },
            name: 'opd_number',
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
                if (row.appointment_date === null) {
                    return 'N/A';
                }

                return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.appointment_date).utc().format('LT')}</div>
                                <div>${moment(row.appointment_date).utc().format('Do MMM, Y')}</div>
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
            data: 'payment_mode_name',
            name: 'payment_mode',
        },
        {
            data: 'symptoms',
            name: 'symptoms',
        },
        {
            data: 'notes',
            name: 'notes',
        },
        {
            data: function (row) {
                let editLink = opdPatientUrl + '/' + row.id + '/edit';
                let data = [
                    {
                        'id': row.id,
                        'url': editLink,
                    }];

                return prepareTemplateRender('#opdVisitsActionTemplate', data);
            },
            name: 'doctor.user.last_name',
        },
    ],
});
searchDataTable(tbl,'#search-table-1');

function searchDataTable(tbl, selector)
{
    const filterSearch = document.querySelector(selector);
    filterSearch.addEventListener('keyup', function (e) {
        tbl.search(e.target.value).draw();
    });
}

$(document).on('click', '.delete-visit-btn', function (event) {
    let opdPatientId = $(event.currentTarget).data('id');
    deleteItem(opdPatientUrl + '/' + opdPatientId, tableName, 'OPD Patient');
});
