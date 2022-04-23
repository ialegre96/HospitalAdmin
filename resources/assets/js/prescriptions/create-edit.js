'use strict';

$(document).ready(function () {
    $('#patient_id,#filter_status,#doctorId').select2({
        width: '100%',
    });

    $('#patient_id').first().focus();

    $('#createPrescription, #editPrescription').on('submit', function () {
        $('#saveBtn').attr('disabled', true);
    });
});
