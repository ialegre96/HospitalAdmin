'use strict';

$(document).ready(function () {

    $('#date').flatpickr({
        defaultDate: new Date(),
        dateFormat: 'Y-m-d',
    });

    $('#editDate').flatpickr({
        dateFormat: 'Y-m-d',
    });
    $('#patientId').select2({
        dropdownParent: $('#addModal'),
    });
    $('#editPatientId').select2({
        dropdownParent: $('#editModal'),
    });
    $('#addModal, #editModal').on('shown.bs.modal', function () {
        $('#patientId, #editPatientId:first').focus();
    });
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    $(loadingButton).attr('disabled', true);
    $.ajax({
        url: advancePaymentCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(loadingButton).attr('disabled', false);
                $('#addModal').modal('hide');
                $('#advancedPaymentsTable').
                    DataTable().
                    ajax.
                    reload(null, false);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            $(loadingButton).attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let advancedPaymentId = $(event.currentTarget).data('id');
    renderData(advancedPaymentId);
});

window.renderData = function (id) {
    $.ajax({
        url: advancedPaymentUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#advancePaymentId').val(result.data.id);
                $('#editPatientId').
                    val(result.data.patient_id).
                    trigger('change.select2');
                $('#editReceiptNo').val(result.data.receipt_no);
                $('#editAmount').val(result.data.amount);
                $('.price-input').trigger('input');
                $('#editDate').val(format(result.data.date, 'YYYY-MM-DD'));
                $('#editModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    let id = $('#advancePaymentId').val();
    $(loadingButton).attr('disabled', true);
    $.ajax({
        url: advancedPaymentUrl + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(loadingButton).attr('disabled', false);
                $('#editModal').modal('hide');
                $('#advancedPaymentsTable').
                    DataTable().
                    ajax.
                    reload(null, false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $(loadingButton).attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#patientId').val('').trigger('change.select2');
    $('#btnSave').attr('disabled', false);
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});
