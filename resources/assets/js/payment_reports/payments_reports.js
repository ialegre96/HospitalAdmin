'use strict';

$(document).ready(function () {

    let tableName = '#paymentsReportsTbl';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: paymentReportUrl,
            data: function (data) {
                data.account_type = $('#filterPaymentAccount').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'class': 'text-center',
            },
            {
                'targets': [5],
                'visible': false,
            },
        ],
        columns: [
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.payment_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div>${moment(row.payment_date).format('Do MMM, Y')}</div>
                            </div>`
                },
                name: 'payment_date',
            },
            {
                data: 'accounts.name',
                name: 'accounts.name',
            },
            {
                data: 'pay_to',
                name: 'pay_to',
            },
            {
                data: function (row) {
                    if (row.accounts.type == 1)
                        return '<span class="badge badge-light-danger fs-7">Debit</span>';
                    else
                        return '<span class="badge badge-light-success fs-7">Credit</span>';
                },
                name: 'accounts.type',
            },
            {
                data: function (row) {
                    return !isEmpty(row.amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) + '</p>' : 'N/A';
                },
                name: 'amount',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filterPaymentAccount', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).ready(function () {
    $('#filterPaymentAccount').select2({
        width: '100%',
    });

    $(document).on('click', '#resetFilter', function () {
        $('#filterPaymentAccount').val(0).trigger('change');
    });
});
