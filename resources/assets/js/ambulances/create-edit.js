'use strict';

$(document).ready(function () {
    $('#vehicleType').select2({
        width: '100%',
    });

    $(document).
        on('submit', '#createAmbulanceForm, #editAmbulanceForm', function () {
            $('#btnSave').attr('disabled', true);

            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                $('#btnSave').attr('disabled', false);
                return false;
            }
        });

    $('#createAmbulanceForm, #editAmbulanceForm').
        find('input:text:visible:first').
        focus();
});
