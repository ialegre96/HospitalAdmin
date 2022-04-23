'use strict';

$(document).on('change', '#appLogo', function () {
    $('#validationErrorsBox').addClass('d-none');
    if (isValidLogo($(this), '#validationErrorsBox')) {
        displayLogo(this, '#previewImage');
    }
});

$(document).on('submit', '#createSetting', function (event) {
    event.preventDefault();
    $('#createSetting')[0].submit();

    return true;
});

window.isValidLogo = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: jpg, jpeg, png.').
            show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayLogo = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                /*
                if (image.height != 60 && image.width != 90) {
                    $(selector).val('');
                    $('#validationErrorsBox').removeClass('d-none');
                    $('#validationErrorsBox').
                        html(imageValidation).
                        show();
                    return false;
                }
                 */
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val('2').trigger('change');
});

$(document).on('submit', '#superAdminFooterSettingForm', function (event) {
    event.preventDefault();

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }

    let facebookUrl = $('#facebookUrl').val();
    let twitterUrl = $('#twitterUrl').val();
    let instagramUrl = $('#instagramUrl').val();
    let linkedInUrl = $('#linkedInUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let instagramUrlExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false));
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook URL');
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter URL');
        return false;
    }
    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramUrlExp) ? true : false));
    if (!instagramCheck) {
        displayErrorMessage('Please enter a valid Instagram URL');
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin URL');
        return false;
    }
    $('#superAdminFooterSettingForm')[0].submit();

    return true;
});

$(document).ready(function () {
    if (typeof phoneNo != 'undefined' && phoneNo !== '')
        $('#phoneNumber').trigger('blur');
});
