'use strict';

$(document).ready(function () {
    // $('#bedType').select2({
    //     width: '100%',
    //     dropdownParent: $('#addNewForm')
    // });
    // $('#editBedType').select2({
    //     width: '100%',
    //     dropdownParent: $('#editModal')
    // });
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    loadingButton.attr('disabled', true);
    $.ajax({
        url: bedCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#bedsTbl').DataTable().ajax.reload(null, false);
                $(loadingButton).attr('disabled', false);
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
    let bedId = $(event.currentTarget).data('id');
    renderData(bedId);
});

window.renderData = function (id) {
    $.ajax({
        url: bedUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#bedId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editBedType').val(result.data.bed_type).trigger('change.select2');
                $('#editDescription').val(result.data.description);
                $('#editCharge').val(result.data.charge);
                $('.price-input').trigger('input');
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
    loadingButton.attr('disabled', true);
    let id = $('#bedId').val();
    $.ajax({
        url: bedUrl + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bedsTbl').DataTable().ajax.reload(null, false);
                $(loadingButton).attr('disabled', false);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
            $(loadingButton).attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#btnSave').attr('disabled', false);
    $('#bedType').val('').trigger('change.select2');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});
