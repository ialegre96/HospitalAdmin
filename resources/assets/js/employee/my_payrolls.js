'use strict';

$(document).ready(function () {
    let tbl = $('#employeePayrollsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: employeePayrollUrl,
        },
        columnDefs: [
            {
                'targets': [3, 4, 5, 6],
                'className': 'text-right',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center',
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
                    let showLink = payrollUrl + '/' + row.id;
                    return '<a href="' + showLink + '" class="badge badge-light-info">' + row.payroll_id + '</a>';
                },
                name: 'payroll_id',
            },
            {
                data: 'month',
                name: 'month',
            },
            {
                data: 'year',
                name: 'year',
            },
            {
                data: function (row) {
                    return !isEmpty(row.basic_salary) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.basic_salary) + '</p>' : 'N/A';
                },
                name: 'basic_salary',
            },
            {
                data: function (row) {
                    return !isEmpty(row.allowance) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.allowance) + '</p>' : 'N/A';
                },
                name: 'allowance',
            },
            {
                data: function (row) {
                    return !isEmpty(row.deductions) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.deductions) + '</p>' : 'N/A';
                },
                name: 'deductions',
            },
            {
                data: function (row) {
                    return !isEmpty(row.net_salary) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.net_salary) + '</p>' : 'N/A';
                },
                name: 'net_salary',
            },
            {
                data: function (row) {
                    if (row.status == 1)
                        return `<span class="badge badge-light-success">Paid</span>`;
                    else
                        return `<span class="badge badge-light-danger">Unpaid</span>`;
                },
                name: 'net_salary',
            },
        ],
    });
    handleSearchDatatable(tbl);
});
