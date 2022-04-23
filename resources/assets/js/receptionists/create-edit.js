'use strict';

$(document).ready(function () {
    $('#bloodGroup').select2({
        width: '100%',
    });
    $('#birthDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
    });
    $('#departmentId').select2({
        width: '100%',
    });

    $(document).
        on('submit', '#createReceptionForm, #editReceptionForm', function () {
            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                return false;
            }
        });
    $('#createReceptionForm, #editReceptionForm').find('input:text:visible:first').focus();
    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
