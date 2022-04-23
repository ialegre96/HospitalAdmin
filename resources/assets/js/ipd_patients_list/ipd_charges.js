'use strict';

$(document).ready(function () {

    let tableName = '#tblIpdCharges';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'desc']],
        ajax: {
            url: ipdChargesUrl,
            data: function (data) {
                data.id = ipdPatientDepartmentId;
            },
        },
        columnDefs: [
            {
                'targets': [0, 1, 2, 3],
                'width': '15%',
            },
            {
                'targets': [4, 5],
                'className': 'text-right',
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
                    return row;
                },
                render: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }

                    return moment(row.date).format('Do MMM, Y');
                },
                name: 'date',
            },
            {
                data: function (row) {
                    if (row.charge_type_id === 1)
                        return 'Procedures';
                    else if (row.charge_type_id === 2)
                        return 'Investigations';
                    else if (row.charge_type_id === 3)
                        return 'Supplier';
                    else if (row.charge_type_id === 4)
                        return 'Operation Theatre';
                    else
                        return 'Others';
                },
                name: 'charge_type_id',
            },
            {
                data: 'chargecategory.name',
                name: 'chargecategory.name',
            },
            {
                data: 'charge.code',
                name: 'charge.code',
            },
            {
                data: function (row) {
                    return !isEmpty(row.standard_charge)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.standard_charge) + '</p>'
                        : 'N/A';
                },
                name: 'standard_charge',
            },
            {
                data: function (row) {
                    return !isEmpty(row.applied_charge)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.applied_charge) + '</p>'
                        : 'N/A';
                },
                name: 'applied_charge',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
