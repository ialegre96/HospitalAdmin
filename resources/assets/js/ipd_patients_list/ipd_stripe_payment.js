'use strict';

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $(document).on('click', '#ipdPaymentBtn', function () {
        let payloadData = {
            amount: parseInt($('#billAmout').val()),
            ipdNumber: $('#ipdNumber').val(),
        };
        $(this).
            html(
                '<div class="spinner-border spinner-border-sm " role="status">\n' +
                '                                            <span class="sr-only">Loading...</span>\n' +
                '                                        </div>').
            addClass('disabled');
        $.post(ipdStripePaymentUrl, payloadData).done((result) => {
            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).html('Make Payment').removeClass('disabled');
                manageAjaxErrors(result);
            });
        }).catch(error => {
            $(this).html('Make Payment').removeClass('disabled');
            manageAjaxErrors(error);
        });
    });
});
