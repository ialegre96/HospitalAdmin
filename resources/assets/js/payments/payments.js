'use strict';

$(document).ready(function () {

    let tbl = $('#paymentsTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: paymentUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'className': 'text-right',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [5],
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
                data: 'account.name',
                name: 'account.name',
            },
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
                data: 'pay_to',
                name: 'pay_to',
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
                data: function (row) {
                    let url = paymentUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('#paymentActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let paymentId = $(event.currentTarget).data('id');
    deleteItem(paymentUrl + '/' + paymentId, '#paymentsTbl', 'Payment');
});

$(document).on('click', '.show-btn', function (event) {
    let paymentId = $(event.currentTarget).attr('data-id');
    renderData(paymentId);
});

window.renderData = function (id) {
    $.ajax({
        url: route('payments.show.modal', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#payment_account').text(result.data.account.name);
                $('#payment_date').text(moment(result.data.payment_date).format('Mo MMM, YYYY'));
                $('#pay_to').text(result.data.pay_to);
                $('#payment_amount').text(result.data.amount);
                $('#created_on').text(moment(result.data.created_at).fromNow());
                $('#updated_on').text(moment(result.data.updated_at).fromNow());
                $('#description').text(result.data.description);
                $('#description').css('overflow-wrap', 'break-word');

                setValueOfEmptySpan();
                $('#showPayment').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
