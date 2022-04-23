'use strict';

$(document).ready(function () {
    $('#patient_id,#doctor_id,#category_id').select2();

    $(document).on('click', '#addItem', function () {
        let data = {
            'uniqueId': uniqueId,
        };
        let patientDiagnosisTestHtml = prepareTemplateRender(
            '#patientDiagnosisTestTemplate', data);
        $('.diagnosis-item-container').append(patientDiagnosisTestHtml);
        uniqueId++;

        resetPatientDiagnosisTestIndex();
    });

    $(document).on('click', '.delete-diagnosis', function () {
        $(this).parents('tr').remove();
        resetPatientDiagnosisTestIndex();
    });

    function resetPatientDiagnosisTestIndex () {
        let index = 1;
        $('.diagnosis-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
    }

    $('#patientDiagnosisTestForm').on('submit', function (event) {
        event.preventDefault();
        screenLock();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: patientDiagnosisTestSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    window.location.href = patientDiagnosisTest;
                }, 4000);
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
            complete: function () {
                screenUnLock();
                loadingButton.button('reset');
            },
        });
    });

});
