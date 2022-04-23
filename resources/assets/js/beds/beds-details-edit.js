'use strict';

$(document).ready(function () {

    $('#bedType,#editBedType').select2({
        width: '100%',
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
                $('#editBedType').
                    val(result.data.bed_type).
                    trigger('change.select2');
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
    let id = $('#bedId').val();
    $.ajax({
        url: bedUrl + '/' + id,
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
