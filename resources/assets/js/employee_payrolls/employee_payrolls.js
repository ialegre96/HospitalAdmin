'use strict';

$(document).ready(function () {
    let srNo = 1;

    let tableName = '#employeePayrollsTable';
    let tbl = $('#employeePayrollsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[8, 'desc']],
        ajax: {
            url: employeePayrollUrl,
            data: function (data) {
                data.status = $('#filter_status').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '5%',
            },
            {
                'targets': [1],
                'width': '10%',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [4],
                'className': 'text-right',
            },
            {
                'targets': [5],
                'className': 'text-right',
            },
            {
                'targets': [8],
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
                data: 'sr_no',
                name: 'sr_no',
            },
            {
                data: function (row) {
                    return '<a href="#" class="show-btn badge badge-light-info" data-id="'+ row.id +'">' + row.payroll_id + '</a>';
                },
                name: 'payroll_id',
            },
            {
                data: function (row) {
                    return `<div class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="#">
                                        <div>
                                            <img src="${row.image_url}" alt=""
                                                 class="user-img">
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 mb-1"> ${row.owner.user.full_name}</a>
                                    <span class="text-gray-600"> ${row.type_string}</span>
                                </div>
                            </div>`;
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
                    return !isEmpty(row.net_salary) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.net_salary) + '</p>'
                        : 'N/A';
                },
                name: 'net_salary',
            },
            {
                data: function (row) {
                    if (row.status == 1)
                        return '<span class="badge badge-light-success fs-7">Paid</span>';
                    else
                        return '<span class="badge badge-light-danger fs-7">Unpaid</span>';
                }, name: 'status',
            },
            {
                data: function (row) {
                    let url = employeePayrollUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
                },
                name: 'id',
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

$(document).ready(function () {
    $(document).on('click', '#resetFilter', function () {
        $('#filter_status').val(2).trigger('change');
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let employeePayrollId = $(event.currentTarget).data('id');
    deleteItem(
        employeePayrollUrl + '/' + employeePayrollId,
        '#employeePayrollsTable',
        'Employee Payroll',
    );
});

$(document).on('click', '.show-btn', function (event) {
    let employeePayrollId = $(event.currentTarget).attr('data-id');
    renderData(employeePayrollId);
});

window.renderData = function (id) {
    $.ajax({
        url: route('employee-payrolls.show.modal', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#sr_no').text(result.data.sr_no);
                $('#payroll_id').text(result.data.payroll_id);
                $('#payroll_role').text(result.data.type_string);
                $('#employee_full_name').text(result.data.owner.user.full_name);
                $('#payroll_month').text(result.data.month);
                $('#payroll_year').text(result.data.year);
                $('#salary').text(addCommas(result.data.basic_salary));
                $('#allowance').text(addCommas(result.data.allowance));
                $('#deductions').text(addCommas(result.data.deductions));
                $('#net_salary').text(addCommas(result.data.net_salary));
                $('#employee_status').empty();
                if (result.data.status == 1) {
                    $('#employee_status').
                        append(
                            '<span class="badge badge-light-success">Paid</span>');
                } else {
                    $('#employee_status').
                        append(
                            '<span class="badge badge-light-danger">Unpaid</span>');
                }
                $('#created_on').text(moment(result.data.created_at).fromNow());
                $('#updated_on').text(moment(result.data.updated_at).fromNow());
                setValueOfEmptySpan();
                $('#showEmployeePayrolls').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
