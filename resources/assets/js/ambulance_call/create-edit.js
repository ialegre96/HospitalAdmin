'use strict';

$(document).ready(function () {

    $('#ambulanceId').select2({
        width: '100%',
    });
    $('#patientId').select2({
        width: '100%',
    });
    $('#date').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });
    $('#patientId').focus();

    $('.price-input').trigger('input');

    $('#ambulanceId').on('change', function () {
        $.ajax({
            url: getDriverNameUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (result) {
                $('#driverName').val(result.data);
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    });

    $('#createAmbulanceCall, #editAmbulanceCall').on('submit', function () {
        $('#saveBtn').attr('disabled', true);
    });
});
