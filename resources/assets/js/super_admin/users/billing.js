'use strict';

$(document).ready(function () {
    let tbl = '#hospitalBilling';

    let table = $(tbl).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: billingUrl,
            data: function (data) {
                data.id = $('#hospitalBillingId').val();
                data.status = $('#billingStatusArr').
                    find('option:selected').
                    val();
                data.payment_type = $('#billingPaymentType').val();

            },
        },
        columnDefs: [
            {
                'targets': [1],
                'className': 'text-center align-middle text-nowrap',
                'orderable': false,
            },
            {
                'targets': [2],
                'orderable': true,
            },
            {
                'targets': [3],
                'orderable': true,
            },
            {
                'targets': [4],
                'orderable': true,
            },
            {
                'targets': [5],
            },
            {
                'targets': [6],
                'className': 'text-center align-middle text-nowrap',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center align-middle text-nowrap',
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
                    return row.subscription_plan.name;
                },
                name: 'subscriptionPlan.name',
            },
            {
                data: function (row) {
                    if (row.transaction_id) {
                        if (row.transactions.payment_type == 1) {
                            return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${stripe}</a>`;
                        } else if (row.transactions.payment_type == 2) {
                            return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${paypal}</a>`;
                        } else if (row.transactions.payment_type == 3) {
                            return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${razorPay}</a>`;
                        } else if (row.transactions.payment_type == 4) {
                            return `<a data-id="${row.payment_type}" class="badge badge-light-primary">${cash}</a>`;
                        }
                    } else {
                        return 'N/A';
                    }
                },
                name: 'transactions.payment_type',
            },
            {
                data: function (row) {
                    return '<p class="mb-0">' + row.plan_currency_symbol + ' ' +
                        addCommas(row.plan_amount) + '</p>';
                },
                name: 'plan_amount',
            },
            {
                data: function (row) {
                    return `<span className="text-center">${row.plan_frequency ==
                    1 ? month : year}</span>`;
                },
                name: 'plan_frequency',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.starts_at).
                        format('LT')}</div>
                                <div>${moment(row.starts_at).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'starts_at',
            },
            {
                data: function (row) {
                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.ends_at).
                        format('LT')}</div>
                                <div>${moment(row.ends_at).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'ends_at',
            },
            {
                data: function (row) {
                    if (row.trial_ends_at) {
                        return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.trial_ends_at).
                            format('LT')}</div>
                                <div>${moment(row.trial_ends_at).
                            format('Do MMM, Y')}</div>
                            </div>`;
                    } else {
                        return 'N/A';
                    }
                },
                name: 'trial_ends_at',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-${row.status == 1
                        ? 'success'
                        : 'danger'}">${row.status == 1
                        ? active
                        : deactive}</span>`;
                },
                name: 'status',
            },
        ],
        'fnInitComplete': function () {
            $(document).
                on('change', '#billingStatusArr, #billingPaymentType',
                    function () {
                        $(tbl).DataTable().ajax.reload(null, true);
                    });
        },
    });

    // handleSearchDatatable(table);

    searchDataTable(table, '#search-table-billing');

});

function searchDataTable (table, selector) {
    const filterSearch = document.querySelector(selector);
    filterSearch.addEventListener('keyup', function (e) {
        table.search(e.target.value).draw();
    });
}

$(document).on('click', '.billing-modal', function (event) {
    let userId = $(event.currentTarget).attr('data-id');
    renderData(userId);
});

$(document).on('click', '#resetFilter', function () {
    $('#billingStatusArr, #billingPaymentType').val('').trigger('change');
});

window.renderData = function (id) {
    $.ajax({
        url: route('super.admin.hospital.billing.modal', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#plan_name').text(result.data[0].subscription_plan.name);
                $('#transaction').empty();
                if (result.data[0].transactions.payment_type == 1) {
                    $('#transaction').
                        append(
                            `<span class="badge badge-light-primary">${stripe}</span>`);
                } else {
                    $('#transaction').
                        append(
                            `<span class="badge badge-light-primary">${paypal}</span>`);
                }
                $('#amount').text(result.data[0].plan_amount);
                $('#frequency').
                    text(result.data[0].plan_frequency == 1 ? month : year);
                $('#start_date').
                    text(moment(result.data[0].starts_at).format('Do MMM, Y'));
                $('#end_date').
                    text(moment(result.data[0].ends_at).format('Do MMM, Y'));
                if (result.data[0].trial_ends_at) {
                    $('#trail_end_date').
                        text(moment(result.data[0].trial_ends_at).
                            format('Do MMM, Y'));
                } else {
                    $('#trail_end_date').text('N/A');
                }
                $('#status').empty();
                if (result.data[0].status == 1) {
                    $('#status').
                        append(
                            `<span class="badge badge-light-success">${active}</span>`);
                } else {
                    $('#status').
                        append(
                            `<span class="badge badge-light-danger">${deactive}</span>`);
                }

                setValueOfEmptySpan();
                $('#showBillingModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
