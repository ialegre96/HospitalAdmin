'use strict';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    $(document).on('click', '.makePayment', function () {
        if (typeof getLoggedInUserdata != 'undefined' && getLoggedInUserdata ==
            '') {
            window.location.href = logInUrl;

            return true;
        }

        let payloadData = {
            plan_id: $(this).data('id'),
            from_pricing: typeof fromPricing != 'undefined'
                ? fromPricing
                : null,
            price: $(this).data('plan-price'),
            payment_type: $('#paymentType option:selected').val(),
        };
        $(this).addClass('disabled');
        $.post(makePaymentURL, payloadData).done((result) => {
            if (typeof result.data == 'undefined') {
                let toastMessageData = {
                    'toastType': 'success',
                    'toastMessage': result.message,
                };
                paymentMessage(toastMessageData);
                setTimeout(function () {
                    window.location.href = subscriptionPlans;
                }, 5000);

                return true;
            }

            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).html(subscribeText).removeClass('disabled');
                $('.makePayment').attr('disabled', false);
                let toastMessageData = {
                    'toastType': 'error',
                    'toastMessage': result.responseJSON.message,
                };
                paymentMessage(toastMessageData);
            });
        }).catch(error => {
            $(this).html(subscribeText).removeClass('disabled');
            $('.makePayment').attr('disabled', false);
            let toastMessageData = {
                'toastType': 'error',
                'toastMessage': error.responseJSON.message,
            };
            paymentMessage(toastMessageData);
        });
    });

    $('#paymentType').on('change', function () {
        let paymentType = $(this).val();
        if (paymentType == 1) {
            $('.proceed-to-payment, .razorPayPayment, .cashPayment')
                .addClass('d-none');
            $('.stripePayment').removeClass('d-none');
        }
        if (paymentType == 2) {
            $('.proceed-to-payment, .razorPayPayment, .cashPayment')
                .addClass('d-none');
            $('.paypalPayment').removeClass('d-none');
        }
        if (paymentType == 3) {
            $('.proceed-to-payment, .paypalPayment, .cashPayment')
                .addClass('d-none');
            $('.razorPayPayment').removeClass('d-none');
        }
        if (paymentType == 4) {
            $('.proceed-to-payment, .paypalPayment, .razorPayPayment')
                .addClass('d-none');
            $('.cashPayment').removeClass('d-none');
        }
    });

    $('.paymentByPaypal').on('click', function () {
        let pricing = typeof fromPricing != 'undefined' ? fromPricing : null;
        $(this).addClass('disabled');
        $.ajax({
            type: 'GET',
            url: route('paypal.init'),
            data: {
                'planId': $(this).data('id'),
                'from_pricing': pricing,
                'payment_type': $('#paymentType option:selected').val(),
            },
            success: function (result) {
                if (result.url) {
                    window.location.href = result.url;
                }

                if (result.statusCode == 201) {
                    let redirectTo = '';

                    $.each(result.result.links,
                        function (key, val) {
                            if (val.rel == 'approve') {
                                redirectTo = val.href;
                            }
                        });
                    location.href = redirectTo;
                }
            },
            error: function (result) {
            },
            complete: function () {
            },
        });
    });

    // RazorPay Payment

    $(document).on('click', '.razor_pay_payment', function () {
        $(this).addClass('disabled');
        $.ajax({
            type: 'POST',
            url: makeRazorpayURl,
            data: {
                'plan_id': $(this).data('id'),
                'from_pricing': typeof fromPricing != 'undefined'
                    ? fromPricing
                    : null,
            },
            success: function (result) {
                if (result.url) {
                    window.location.href = result.url;
                }
                if (result.success) {
                    let {
                        id,
                        amount,
                        name,
                        email,
                        contact,
                        planID,
                    } = result.data;
                    options.amount = amount;
                    options.order_id = id;
                    options.prefill.name = name;
                    options.prefill.email = email;
                    options.prefill.contact = contact;
                    options.prefill.planID = planID;
                    let razorPay = new Razorpay(options);
                    razorPay.open();
                    razorPay.on('payment.failed', storeFailedPayment);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
            },
        });
    });

    function storeFailedPayment (response) {
        $.ajax({
            type: 'POST',
            url: razorpayPaymentFailed,
            data: {
                data: response,
            },
            success: function (result) {
                if (result.url) {
                    window.location.href = result.url;
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    }

    // cash Payment

    $(document).on('click', '.cash_payment', function () {
        $(this).addClass('disabled');
        $.ajax({
            type: 'POST',
            url: cashPaymentUrl,
            data: {
                'plan_id': $(this).data('id'),
                'from_pricing': typeof fromPricing != 'undefined'
                    ? fromPricing
                    : null,
            },
            success: function (result) {
                if (result.url) {
                    window.location.href = result.url;
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
            },
        });
    });
});
