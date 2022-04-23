'use strict';

$(document).ready(function () {
    // $('#type,#ownerType,#month,#status').select2({
    //     width: '100%',
    // });

    $('.price-input').trigger('input');

    $('#type').focus();
});

$('#basicSalary,#allowance,#deductions').on('change', function () {
    let basicSalary = parseFloat(removeCommas($('#basicSalary').val()));
    let allowance = parseFloat(removeCommas($('#allowance').val()));
    let deductions = parseFloat(removeCommas($('#deductions').val()));
    let netSalary = ((basicSalary + allowance) - deductions);

    if (deductions > netSalary) {
        $('#validationErrorsBox').removeClass('d-none');
        $('#validationErrorsBox').
            text('Deductions cannot be greater than Basic salary + Allowance').
            show();
        $('#deductions').val(null);
        deductions = 0;
        setTimeout(function () {
            $('#validationErrorsBox').addClass('d-none');
            $('#validationErrorsBox').text('');
        }, 7000);
    }
    (!isNaN(netSalary)) ? $('#netSalary').val(netSalary).trigger('input') : $(
        '#netSalary').val(0);
});

$('#type').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: employeeUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length != 0) {
                    $('#ownerType').empty();
                    $('#ownerType').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#ownerType').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                } else {
                    $('#ownerType').trigger('change');
                }
                if (isEdit) {
                    $('#ownerType').val(employeeOwnerId).trigger('change');
                    isEdit = false;
                }
            },
        });
    }
    $('#ownerType').empty();
    $('#ownerType').prepend('<option value="0">Select Employee</option>');
    $('#ownerType').prop('disabled', true);
});

$(document).on('submit', '#createPayroll, #editPayroll', function () {
    $('#btnSave').attr('disabled', true);
});
