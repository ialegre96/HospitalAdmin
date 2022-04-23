'use strict';

let tableName = '#accountsTbl';

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    let id = $('#accountId').val();
    let url = accountUrl + '/' + +id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
        'tableSelector': tableName,
    };
    editRecordWithFormData(data, loadingButton);
});

window.editRecordWithFormData = function (data, loadingButton) {
    let formData = (data.formSelector === '') ? data.formData : $(
        data.formSelector).serialize();
    $.ajax({
        url: data.url,
        type: data.type,
        data: formData,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#EditModal').modal('hide');
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
};

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let accountId = $(event.currentTarget).data('id');
    renderData(accountId);
});

window.renderData = function (id) {
    $.ajax({
        url: accountUrl + '/' + +id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#accountId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.description);
                if (result.data.status) {
                    $('#editIsActive').val(1).prop('checked', true);
                }
                if (result.data.type == 1) {
                    $('#editDebit').prop('checked', true);
                } else {
                    $('#editCredit').prop('checked', true);
                }
                $('#EditModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};
