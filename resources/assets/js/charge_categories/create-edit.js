'use strict';

$(document).ready(function () {
    $('#chargeTypeId').select2({
        width: '100%',
        dropdownParent: $('#addModal'),
    });
    $('#editChargeTypeId').select2({
        width: '100%',
        dropdownParent: $('#editModal'),
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $('#btnSave').attr('disabled', true);
        $.ajax({
            url: chargeCategoryCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    $('#chargeCategoriesTbl').
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
        let chargeTypeId = $(event.currentTarget).data('id');
        renderData(chargeTypeId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: chargeCategoryUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#chargeCategoryId').val(result.data.id);
                    $('#editName').val(result.data.name);
                    $('#editChargeTypeId').val(result.data.charge_type).trigger('change.select2');
                    $('#editDescription').val(result.data.description);
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
        $('#btnEditSave').attr('disabled', false);
        let id = $('#chargeCategoryId').val();
        $.ajax({
            url: chargeCategoryUrl + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $('#chargeCategoriesTbl').
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
        $('#chargeTypeId').val('').trigger('change.select2');
        $('#btnSave').attr('disabled', false);
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        $('#editChargeTypeId').val('').trigger('change.select2');
        $('#btnEditSave').attr('disabled', false);
    });
});
