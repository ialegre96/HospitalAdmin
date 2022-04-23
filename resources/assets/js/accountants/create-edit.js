'use strict';

$(document).ready(function () {

    $(document).ready(function () {
        $('#bloodGroup').select2({
            width: '100%',
        });
    });

    $('#birthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
    });

    $(document).
        on('submit', '#createAccountantForm, #editAccountantForm', function () {
            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                return false;
            }
        });

    $('#createAccountantForm, #editAccountantForm').find('input:text:visible:first').focus();

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
