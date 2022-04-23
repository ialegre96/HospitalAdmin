'use strict';

$(document).ready(function () {
    let tbl = '#hospitalTransaction';

    let table = $(tbl).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: transactionUrl,
            data: function (data) {
                data.id = $('#hospitalBillingId').val();
                data.payment_type = $('#paymentType').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0, 1],
                'orderable': true,
            },
            {
                'targets': [2],
                'className': 'text-center align-middle text-nowrap',
                'orderable': true,
            },
            {
                'targets': [3],
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
                                <div class="mb-2">${moment(row.created_at).
                        format('LT')}</div>
                                <div>${moment(row.created_at).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.status == 1) {
                        return `<span class="badge badge-light-success">${paid}</span>`;
                    }
                },
                name: 'status',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#paymentType', function () {
                $(tbl).DataTable().ajax.reload(null, true);
            });
        },
    });

    // handleSearchDatatable(table);

    searchDataTable(table, '#search-table-transction');

});

function searchDataTable (table, selector) {
    const filterSearch = document.querySelector(selector);
    filterSearch.addEventListener('keyup', function (e) {
        table.search(e.target.value).draw();
    });
}

$(document).on('click', '#resetFilter', function () {
    $('#paymentType').val('').trigger('change');
});
