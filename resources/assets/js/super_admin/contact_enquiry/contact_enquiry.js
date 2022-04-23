'use strict';

$(document).on('submit', '#contactEnquiryForm', function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $('.ajax-message').css('display', 'block');
    $('.ajax-message').html('');
    $.ajax({
        url: route('super.admin.enquiry.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $('.ajax-message').
                    html('<div class="gen alert alert-success">' +
                        result.message + '</div>').
                    delay(5000).
                    hide('slow');
                $('#contactEnquiryForm')[0].reset();
            } else {
                $('.ajax-message').
                    html('<div class="gen alert alert-danger">' +
                        result.message + '</div>').
                    delay(5000).
                    hide('slow');
            }
            grecaptcha.reset();
        },
        error: function (result) {
            $('.ajax-message').
                html('<div class="err alert alert-danger">' +
                    result.responseJSON.message + '</div>').
                delay(5000).
                hide('slow');
            grecaptcha.reset();
            $('#contactEnquiryForm')[0].reset();
        },
    });
});
