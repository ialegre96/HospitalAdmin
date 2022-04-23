'use strict';

$(document).ready(function () {
    let tbl = $('#patientVaccinatedTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: patientVaccinatedUrl,
        },
        columnDefs: [
            {
                'targets': [3],
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
                data: 'vaccination.name',
                name: 'vaccination.name',
            },
            {
                data: 'vaccination_serial_number',
                name: 'vaccination_serial_number',
            },
            {
                data: 'dose_number',
                name: 'dose_number',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.dose_given_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.dose_given_date).utc().format('LT')}</div>
                                <div>${moment(row.dose_given_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'dose_given_date',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
