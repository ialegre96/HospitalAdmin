'use strict';

$(document).ready(function () {
    $('#doctorId, #caseId').select2({
        width: '100%',
        dropdownParent: $('#addModal'),
    });
    $('#editDoctorId, #editCaseId').select2({
        width: '100%',
        dropdownParent: $('#editModal'),
    });
    $('#date, #editDate').flatpickr({
        dateFormat: 'Y-m-d h:i K',
        useCurrent: true,
        sideBySide: true,
        enableTime: true,
    });
    $('#addModal, #editModal').on('shown.bs.modal', function () {
        $('#caseId, #editCaseId:first').focus();
    });
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: operationReportCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#operationReportsTable').
                    DataTable().
                    ajax.
                    reload(null, false);
                $('#btnSave').attr('disabled', false);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            $('#btnSave').attr('disabled', false);
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
    let operationReportId = $(event.currentTarget).data('id');
    renderData(operationReportId);
});

window.renderData = function (id) {
    $.ajax({
        url: operationReportUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#operationReportId').val(result.data.id);
                $('#editCaseId').
                    val(result.data.case_id).
                    trigger('change.select2');
                $('#editDoctorId').
                    val(result.data.doctor_id).
                    trigger('change.select2');
                $('#editDescription').val(result.data.description);
                document.querySelector('#editDate').
                    _flatpickr.
                    setDate(moment(result.data.date).format());
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
    $('#btnEditSave').attr('disabled', true);
    let id = $('#operationReportId').val();
    $.ajax({
        url: operationReportUrl + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#operationReportsTable').
                    DataTable().
                    ajax.
                    reload(null, false);
                $('#btnEditSave').attr('disabled', false);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
            $('#btnEditSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#btnSave').attr('disabled', false);
    $('#caseId, #doctorId').val('').trigger('change.select2');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});
