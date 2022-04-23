'use strict';

$(document).ready(function () {
    $('#birthDate').flatpickr({
        maxDate: new Date(),
    });

    $(document).
        on('submit', '#createCaseHandlerForm, #editCaseHandlerForm',
            function () {
                if ($('#error-msg').text() !== '') {
                    $('#phoneNumber').focus();
                    return false;
                }
            });
    $('#createCaseHandlerForm, #editCaseHandlerForm').find('input:text:visible:first').focus();

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
