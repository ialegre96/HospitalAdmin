'use strict';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    $(document).on('click', '.freePayment', function () {
        if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata ==
            '') {
            window.location.href = logInUrl;

            return true;
        }

        if ($(this).data('plan-price') === 0) {
            $(this).addClass('disabled');
            let data = {
                plan_id: $(this).data('id'),
                price: $(this).data('plan-price'),
            };
            $.post(makePaymentURL, data).done((result) => {
                let toastMessageData = {
                    'toastType': 'success',
                    'toastMessage': result.message,
                };
                paymentMessage(toastMessageData);
                setTimeout(function () {
                    location.reload();
                }, 5000);
            }).catch(error => {
                $(this).html(subscribeText).removeClass('disabled');
                $('.freePayment').attr('disabled', false);
                let toastMessageData = {
                    'toastType': 'error',
                    'toastMessage': error.responseJSON.message,
                };
                paymentMessage(toastMessageData);
            });

            return true;
        }
    });
});
