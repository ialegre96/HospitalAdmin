'use strict';

$(document).ready(function () {
    $('#editPatientId, #editDocumentTypeId').
        select2({
            width: '100%',
        });

    $(document).on('click', '.edit-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let documentId = $(event.currentTarget).data('id');
        renderData(documentId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: documentsUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let ext = result.data.document_url.split('.').
                        pop().
                        toLowerCase();
                    if (ext == 'pdf') {
                        $('#editPreviewImage').css('background-image', 'url("' + pdfDocumentImageUrl + '")');
                    } else if ((ext == 'docx') || (ext == 'doc')) {
                        $('#editPreviewImage').css('background-image', 'url("' + docxDocumentImageUrl + '")');
                    } else {
                        $('#editPreviewImage').css('background-image', 'url("' + result.data.document_url + '")');
                    }

                    $('#editDocumentTypeId').
                        val(result.data.document_type_id).
                        trigger('change.select2');
                    $('#editPatientId').
                        val(result.data.patient_id).
                        trigger('change.select2');
                    $('#editTitle').val(result.data.title);
                    $('#documentUrl').attr('href', result.data.document_url);
                    isEmpty(result.data.document_url) ? $('#documentUrl').hide() : $('#documentUrl').attr('href', result.data.document_url);
                    $('#documentId').val(result.data.id);
                    $('#editNotes').val(result.data.notes);
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
        let id = $('#documentId').val();
        let url = documentsUrl + '/' + id + '/update';
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
        };
        editDocumentRecord(data, loadingButton);
    });

    window.editDocumentRecord = function (
        data, loadingButton, modalSelector = '#EditModal',
        btnToDisabledSelector = '') {
        let formData = (data.formSelector === '')
            ? data.formData
            : new FormData(
                $(data.formSelector)[0]);
        $.ajax({
            url: data.url,
            type: data.type,
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $(modalSelector).modal('hide');
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
                $(btnToDisabledSelector).attr('disabled', true);
            },
        });
    };

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editDocumentValidationErrorsBox');
    });
});

$(document).on('change', '#editDocumentImage', function () {
    let extension = isValidDocument($(this),
        '#editDocumentValidationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editDocumentValidationErrorsBox').html('').hide();
        displayDocument(this, '#editPreviewImage', extension);
    }
});

window.isValidDocument = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).
            html(
                'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').
            show();
        return false;
    }
    return ext;
};
