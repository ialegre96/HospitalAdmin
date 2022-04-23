'use strict';

$(document).on('submit', '#enquiryCreateForm', function (e) {
    e.preventDefault();
    let response = '';
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
    $.ajax({
        url: enquiryURl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    location.reload();
                    $('#enquiryCreateForm')[0].reset();
                }, 5000);
            } else {
                displayErrorMessage(result.message);
                setTimeout(function () {
                }, 5000);
            }
            if ((typeof isGoogleCaptchaEnabled == undefined)
                ? ''
                : isGoogleCaptchaEnabled) {
                grecaptcha.reset();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            // setTimeout(function () {
            //     $('#enquiryCreateForm')[0].reset();
            // }, 3000);
            if ((typeof isGoogleCaptchaEnabled == undefined)
                ? ''
                : isGoogleCaptchaEnabled) {
                grecaptcha.reset();
            }
        },
        complete: function () {
        },
    });
});
$('#general').selectize();
