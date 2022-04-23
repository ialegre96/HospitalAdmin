'use strict';

$(document).ready(function () {
    $('#patientId, #doctorId').select2({
        width: '100%',
    });
    $('#date').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });
    $('#patientId').focus();

    $('.price-input').trigger('input');

    $(document).
        on('submit', '#createPatientCaseForm, #editPatientCaseForm',
            function () {
                $('#saveBtn').attr('disabled', true);

                if ($('#error-msg').text() !== '') {
                    $('#phoneNumber').focus();
                    $('#saveBtn').attr('disabled', false);
                    return false;
                }
            });
});
