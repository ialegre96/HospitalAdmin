'use strict';

$(document).ready(function () {
    $('#patientId, #doctorId,#paymentMode').select2({
        width: '100%',
    });

    $('#caseId').select2({
        width: '100%',
        placeholder: 'Choose Case',
    });

    let appointmentDateFlatPicker = $("#appointmentDate").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });

    if (lastVisit) {
        $('#patientId').val(lastVisit).trigger('change');
        $('#patientId').attr('disabled', true);
    }

    if (isEdit) {
        $('#patientId').attr('disabled', true);
        $('#patientId').trigger('change');
        appointmentDateFlatPicker.set('minDate', $('#appointmentDate').val());
    } else {
        appointmentDateFlatPicker.setDate(new Date());
        appointmentDateFlatPicker.set('minDate', new Date());
    }

    $(document).
        on('submit', '#createOpdPatientForm, #editOpdPatientDepartmentForm',
            function () {
                $('#patientId').attr('disabled', false);
                $('#btnSave').attr('disabled', true);
            });
});

$('#patientId').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: patientCasesUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#caseId').empty();
                    $('#caseId').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#caseId').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                } else {
                    $('#caseId').prop('disabled', true);
                }
            },
        });
    }
    $('#caseId').empty();
    $('#caseId').prop('disabled', true);
});

$('#doctorId').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: doctorOpdChargeUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#standardCharge').val(data.data[0].standard_charge);
                } else {
                    $('#standardCharge').val(0);
                }
            },
        });
    }
});
