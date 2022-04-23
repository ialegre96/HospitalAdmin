'use strict';

$(document).ready(function () {
    $('#editCaseId, #editDoctorId').select2({
        width: '100%',
    });
    $('#editDate').flatpickr({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: true,
        sideBySide: true,
        maxDate: new Date(),
    });
    $('#editModal').on('shown.bs.modal', function () {
        $('#caseId, #editCaseId:first').focus();
    });
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let deathReportId = $(event.currentTarget).data('id');
    renderData(deathReportId);
});

window.renderData = function (id) {
    $.ajax({
        url: deathReportUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#deathReportId').val(result.data.id);
                $('#editCaseId').
                    val(result.data.case_id).
                    trigger('change.select2');
                $('#editDoctorId').
                    val(result.data.doctor_id).
                    trigger('change.select2');
                $('#editDescription').val(result.data.description);
                $('#editDate').
                    val(format(result.data.date, 'YYYY-MM-DD HH:mm:ss'));
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
    let id = $('#deathReportId').val();
    $.ajax({
        url: deathReportUrl + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
