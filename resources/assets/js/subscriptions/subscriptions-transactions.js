'use strict';

$(document).ready(function () {
    let tableName = '#subscriptionTransactionsTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: subscriptionTransactionUrl,
            data: function (data) {
                data.payment_type = $('#paymentTypeArr')
                    .find('option:selected')
                    .val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': true,
            },
            {
                'targets': [1, 2],
                'className': 'text-center align-middle text-nowrap',
                'orderable': true,
            },
            {
                'targets': [3],
                'className': 'text-center align-middle text-nowrap',
                'orderable': true,
            },
            {
                'targets': [4],
                'className': 'text-center align-middle text-nowrap',
                'orderable': false,
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
                    return row.user.full_name;
                },
                name: 'user.first_name',
            },
            {
                data: function (row) {
                    if (row.payment_type == 1) {
                        return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${stripe}</a>`;
                    } else if (row.payment_type == 2) {
                        return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${paypal}</a>`;
                    } else if (row.payment_type == 3) {
                        return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${razorPay}</a>`;
                    } else if (row.payment_type == 4) {
                        return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${cash}</a>`;
                    }
                },
                name: 'payment_type',
            },
            {
                data: function (row) {
                    return '<p class="mb-0">' + row.plan_currency_symbol + ' ' +
                        addCommas(row.amount) + '</p>';
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.created_at)
                        .format('LT')}</div>
                                <div>${moment(row.created_at)
                        .format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (isSuperAdminLogin) {
                        if (row.is_manual_payment == 0 && row.status == 0) {
                            return `<div class="w-150px d-flex align-items-center">
                                        <select class="form-select form-select-sm form-select-solid approve-status payment-approve" data-id="${row.id}">
                                                <option selected="selected" value="">${selectManualPayment}</option>
                                                <option value="1">${approved}</option>
                                                <option value="2" >${denied}</option>
                                        </select>
                         </div>`;
                        } else if (row.is_manual_payment == 1) {
                            return `<span class="badge badge-light-success">${approved}</span>`;
                        } else if (row.is_manual_payment == 2) {
                            return `<span class="badge badge-light-danger">${denied}</span>`;
                        } else {
                            return `N/A`;
                        }
                    } else {
                        if (row.is_manual_payment == 0 && row.status == 0) {
                            return `<span class="badge badge-light-primary">${waitingForApproval}</span>`;
                        } else if (row.is_manual_payment == 1) {
                            return `<span class="badge badge-light-success">${approved}</span>`;
                        } else if (row.is_manual_payment == 2) {
                            return `<span class="badge badge-light-danger">${denied}</span>`;
                        } else {
                            return `N/A`;
                        }
                    }

                },
                name: 'is_manual_payment',
            },
            {
                data: function (row) {
                    if (row.status == 1) {
                        return `<span class="badge badge-light-success">${paid}</span>`;
                    } else if (row.status == 0) {
                        return `<span class="badge badge-light-danger">${unpaid}</span>`;
                    }
                },
                name: 'status',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#paymentTypeArr', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
        drawCallback: function () {
            $('.approve-status').select2();
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('change', '.payment-approve', function () {
        let id = $(this).attr('data-id');
        let status = $(this).val();

        $.ajax({
            url: route('change-payment-status', id),
            type: 'GET',
            data: {id: id, status: status},
            success: function (result) {
                displaySuccessMessage(result.message);
                $(tableName).DataTable().ajax.reload();
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

});

$(document).on('click', '#resetFilter', function () {
    $('#paymentTypeArr').val('').trigger('change');
});
