$(document).ready(function () {
    'use strict';

    $('#patientId, #doctorId, #packageId, #insuranceId, #bedId').select2({
        width: '100%',
    });
    let admissionDate = undefined;
    admissionDate = $('#admissionDate').flatpickr({
        dateFormat: "Y-m-d H:i",
        sideBySide: true,
        enableTime: true,
    });

    $('#patientId').focus();

    if (isEdit) {
        setTimeout(function () {
            $('#admissionDate').trigger('dp.change');
        }, 300);
        let dischargeDate = undefined;
        let patientBirthDate = $('#patientBirthDate').val();
        $("#admissionDate").flatpickr({
            dateFormat: "Y-m-d H:i",
            sideBySide: true,
            enableTime: true,
            minDate: patientBirthDate,
            onChange: function (selectedDates, dateStr, instance) {
                let minDate = moment($('#admissionDate').val()).add(1, 'days').format();
                if (typeof dischargeDate != "undefined") {
                    dischargeDate.set('minDate', minDate)
                }
            }
        });

        dischargeDate = $("#dischargeDate").flatpickr({
            dateFormat: "Y-m-d H:i",
            sideBySide: true,
            minDate: minDate,
            useCurrent: false,
            enableTime: true,
        });
        let minDate = moment($('#admissionDate').val()).add(1, 'days').format();
        dischargeDate.set('minDate', minDate)
    }

    $(document).
        on('submit', '#createPatientAdmission, #editPatientAdmission',
            function () {
                if ($('#error-msg').text() !== '') {
                    $('#phoneNumber').focus();
                    return false;
                }
            });
    $(document).on('change', '#patientId', function (event) {
        let id = $(this).val();
        getAdmissionDate(id);
    });
    window.getAdmissionDate = function (id) {
        $.ajax({
            url: patientBirthUrl + '/' + id,
            method: 'get',
            cache: false,
            success: function (result) {
                admissionDate.set('minDate', result.user.dob)
            },
        });
    };
});
