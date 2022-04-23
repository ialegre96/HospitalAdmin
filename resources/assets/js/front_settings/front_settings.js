'use strict';

$(document).on('change', '#aboutUsImage', function () {
    let extension = isValidImage($(this), '#validationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#validationErrorsBox').html('').hide();
        displayDocument(this, '#previewImage', extension);
    }
});

window.isValidImage = function (inputSelector, validationMessageSelector) {
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
