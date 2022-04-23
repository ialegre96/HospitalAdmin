'use strict';

$('#editModal').on('shown.bs.modal', function () {
    $('#editName:first').focus();
});

$(document).on('click', '.edit-btn', function (event) {
    let diagnosisCategoryId = $(event.currentTarget).data('id');
    renderData(diagnosisCategoryId);
});

window.renderData = function (id) {
    $.ajax({
        url: diagnosisCategoryUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#diagnosisCategoryId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.description);
                $('#editModal').modal('show');
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
    var id = $('#diagnosisCategoryId').val();
    $.ajax({
        url: diagnosisCategoryUrl + '/' + id,
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
