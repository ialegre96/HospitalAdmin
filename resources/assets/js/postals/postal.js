'use strict';

$(document).ready(function () {
    $('#date, #editDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });

    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[6, 'desc']],
        ajax: {
            url: postalUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'className': 'text-center',
                'width': '12%',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [6],
                'visible': false,
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    if (isEmpty(row.reference_no)) {
                        return 'N/A';
                    } else {
                        return `<span class="badge badge badge-light-info fs-7">${row.reference_no}</span>`;
                    }
                },
                name: 'reference_no',
            },
            {
                data: function (row) {
                    return ispostal == '2' ? row.to_title : row.from_title;
                },
                name: ispostal == '2' ? 'to_title' : 'from_title',
            },
            {
                data: function (row) {
                    return ispostal == '2' ? row.from_title : row.to_title;
                },
                name: ispostal == '2' ? 'from_title' : 'to_title',
            },
            {
                data: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    if (row.document_url != '') {
                        let downloadLink = postalUrl + '/' + row.id;
                        return '<a href="' + downloadLink + '">' + 'Download' +
                            '</a>';
                    } else {
                        return 'N/A';
                    }
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('.modalActionTemplate', data);
                },
                name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        $('#btnSave').attr('disabled', true);
        let loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: postalCreateUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                    setTimeout(function () {
                        $('#btnSave').attr('disabled', false);
                        loadingButton.button('reset');
                    }, 1000);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                setTimeout(function () {
                    $('#btnSave').attr('disabled', false);
                    loadingButton.button('reset');
                }, 1000);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(postalUrl + '/' + id, tableName, name);
    });

    $(document).on('click', '.edit-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let postalId = $(event.currentTarget).data('id');
        renderData(postalId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: postalUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {

                    if (result.data.document_url != '') {
                        let ext = result.data.document_url.split('.').
                            pop().
                            toLowerCase();
                        if (ext === 'pdf') {
                            $('#editPreviewImage').
                                css('background-image',
                                    'url("' + pdfDocumentImageUrl + '")');
                        } else if ((ext === 'docx') || (ext === 'doc')) {
                            $('#editPreviewImage').
                                css('background-image',
                                    'url("' + docxDocumentImageUrl + '")');
                        } else if (ext === '') {
                            $('#editPreviewImage').
                                css('background-image',
                                    'url("' + defaultDocumentImageUrl + '")');
                        } else {
                            $('#editPreviewImage').
                                css('background-image',
                                    'url("' + result.data.document_url + '")');
                        }
                    }

                    $(hiddenId).val(result.data.id);
                    $('#editFromTitle').val(result.data.from_title);
                    $('#editDate').
                        val(result.data.date ? format(result.data.date,
                            'YYYY-MM-DD') : '');
                    $('#editReferenceNumber').val(result.data.reference_no);
                    $('#editToTitle').val(result.data.to_title);
                    $('#editAddress').val(result.data.address);
                    if (isEmpty(result.data.document_url)) {
                        $('.edit-attachment').addClass('d-none');
                    } else {
                        $('#documentUrl').attr('href', result.data.document_url);
                    }
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
        $('#btnEditSave').attr('disabled', true);
        let loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        let id = $(hiddenId).val();
        let url = postalUrl + '/' + id;
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'post',
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton);
        $('#editModal').modal('hide');
        $('#btnEditSave').attr('disabled', false);
    });

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('#previewImage').
            css('background-image', 'url("' + defaultDocumentImageUrl + '")');
        $('#btnSave').attr('disabled', false);
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox1');
        $('#editPreviewImage').
            css('background-image', 'url("' + defaultDocumentImageUrl + '")');
        $('#btnEditSave').attr('disabled', false);
    });

    $(document).on('change', '#attachment', function () {
        let extension = isValidDocument($(this), '#validationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#validationErrorsBox').html('').hide();
            displayDocument(this, '#previewImage', extension);
        }
    });

    $(document).on('change', '#editAttachment', function () {
        let extension = isValidDocument($(this),
            '#editModal #editValidationErrorsBox1');
        if (!isEmpty(extension) && extension != false) {
            displayDocument(this, '#editPreviewImage', extension);
        }
    });

    window.isValidDocument = function (
        inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
            -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).html(documentError).removeClass('hide');
            $(validationMessageSelector).removeAttr('style');
            return false;
        }

        $(validationMessageSelector).html(documentError).addClass('hide');
        return ext;
    };
    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage');
    });
    $(document).on('click', '.remove-image-edit', function () {
        defaultImagePreview('#editPreviewImage');
    });
});
