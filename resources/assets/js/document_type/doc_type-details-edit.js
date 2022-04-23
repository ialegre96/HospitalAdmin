'use strict';

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let docTypeId = $(event.currentTarget).data('id');
    renderData(docTypeId);
});

window.renderData = function (id) {
    $.ajax({
        url: docTypeUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#docTypeId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#EditModal').modal('show');
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
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    let id = $('#docTypeId').val();
    let url = docTypeUrl + '/' + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
    };
    editDocumentTypeRecordWithForm(data, loadingButton);
});

window.editDocumentTypeRecordWithForm = function (data, loadingButton) {
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
