'use strict';

let tableName = '#visitedOPDPatientTable';
$(tableName).DataTable({
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
            'targets': [2],
            'className': 'text-right',
        },
        {
            'targets': [1, 2, 3],
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
            data: 'opd_number',
            name: 'opd_number',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                if (row.appointment_date === null) {
                    return 'N/A';
                }

                return moment(row.appointment_date).format('Do MMM, Y h:mm A');
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
            data: 'doctor.user.full_name',
            name: 'doctor.user.first_name',
        },
        {
            data: 'symptoms',
            name: 'symptoms',
        },
        {
            data: 'notes',
            name: 'notes',
        },
    ],
});

