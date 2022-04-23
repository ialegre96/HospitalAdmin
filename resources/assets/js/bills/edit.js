'use strict';

$(document).ready(function () {

    setTimeout(function () {
        $('#patientAdmissionId').val(patientAdmissionId);
        $('#patientAdmissionId').trigger('change');
    }, 500);
});
