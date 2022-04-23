'use strict';

$(document).ready(function () {
    $('#addModal, #EditModal').on('shown.bs.modal', function () {
        $('#expenseId, #editExpenseHeadId:first').focus();
    });

    $('#expenseId, #editExpenseHeadId,#expenseHead').select2({
        width: '100%',
    });

    $('#editDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });

    $(document).on('click', '.edit-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let expenseId = $(event.currentTarget).data('id');
        renderData(expenseId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: expenseUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let ext = result.data.document_url.split('.').
                        pop().
                        toLowerCase();
                    if (ext == 'pdf') {
                        $('#editPreviewImage').
                            css('background-image',
                                'url("' + pdfDocumentImageUrl + '")');
                    } else if ((ext == 'docx') || (ext == 'doc')) {
                        $('#editPreviewImage').
                            css('background-image',
                                'url("' + docxDocumentImageUrl + '")');
                    } else if (ext == '') {
                        $('#editPreviewImage').
                            css('background-image',
                                'url("' + defaultDocumentImageUrl + '")');
                    } else {
                        $('#editPreviewImage').
                            css('background-image',
                                'url("' + result.data.document_url + '")');
                    }

                    $('#editExpenseId').val(result.data.id);
                    $('#editExpenseHeadId').
                        val(result.data.expense_head).
                        trigger('change.select2');
                    $('#editName').val(result.data.name);
                    $('#editDate').val(format(result.data.date, 'YYYY-MM-DD'));
                    $('#editInvoiceNumber').val(result.data.invoice_number);
                    $('#editAmount').val(result.data.amount);
                    $('.price-input').trigger('input');
                    $('#editDescription').val(result.data.description);
                    if (isEmpty(result.data.document_url)) {
                        $('#documentUrl').text('');
                    } else {
                        $('#documentUrl').html('View');
                        $('#documentUrl').
                            attr('href', result.data.document_url);
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

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        $('#btnSave').attr('disabled', true);
        let loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        let id = $('#editExpenseId').val();
        let url = expenseUrl + '/' + id + '/update';
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
        };
        editExpenseRecord(data, loadingButton);
    });

    window.editExpenseRecord = function (
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

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
    });

    $(document).on('change', '#editAttachment', function () {
        let extension = isValidDocument($(this), '#editValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#editValidationErrorsBox').html('').hide();
            displayDocument(this, '#editPreviewImage', extension);
        }
    });

    window.isValidDocument = function (
        inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
            -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).
                html(documentError).show();
            return false;
        }
        return ext;
    };
});
