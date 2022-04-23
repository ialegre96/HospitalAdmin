'use strict';

$(document).ready(function () {
    let tableName = '#tblDocuments';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: documentsUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': false,
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '10%',
            },
            {
                'targets': [1],
                'width': '28%',
            },
            {
                'targets': [4],
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
                    let imageUrl = '';
                    if (row.media[0].mime_type === 'image/jpeg' ||
                        row.media[0].mime_type === 'image/png') {
                        imageUrl = '<span class="svg-icon svg-icon-2x svg-icon-primary me-4">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black"></path>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black"></path>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</svg>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>';
                    } else {
                        imageUrl = '<span class="svg-icon svg-icon-2x svg-icon-primary me-4">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black"></path>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</svg>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>';
                    }
                    return `<div class="d-flex align-items-center">
                       ${imageUrl}
                        <div class="d-flex flex-column">
                            <span>${row.media[0].file_name}</span>
                        </div>
                   </div>`;
                },
                name: 'media.file_name',
            },
            {
                data: 'document_type.name',
                name: 'documentType.name',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="${showLink}">
                                <div>
                                    <img src="${row.image_url}" alt=""
                                         class="user-img">
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}" class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>
                   </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    let downloadLink = downloadDocumentUrl + '/' + row.id;
                    let data = [{ 'id': row.id, 'downloadLink': downloadLink }];

                    return prepareTemplateRender('#DocumentActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });

    handleSearchDatatable(tbl);

    $('#patientId, #documentTypeId').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('#editPatientId, #editDocumentTypeId').select2({
        width: '100%',
        dropdownParent: $('#EditModal')
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(documentsUrl + '/' + id, tableName, 'Document');
    });

    var filename;
    $(document).on('change', '#documentImage', function () {
        filename = $(this).val();
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        if (filename == null || filename == '') {
            let message = 'Please select attachment';
            displayErrorMessage(message);
            return false;
        }
        if ($('#validationErrorsBox').text() !== '') {
            $('#documentImage').focus();
            return false;
        }
        let loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        let data = {
            'formSelector': $(this),
            'url': documentsCreateUrl,
            'type': 'POST',
            'tableSelector': tableName,
        };
        newRecord(data, loadingButton, '#addModal');
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

                    $('#editDocumentTypeId').val(result.data.document_type_id).trigger('change.select2');
                    $('#editPatientId').val(result.data.patient_id).trigger('change.select2');
                    $('#editTitle').val(result.data.title);
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
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton);
    });

    $('#addModal').on('hidden.bs.modal', function () {
        $('#documentTypeId').val(null).trigger('change');
        $('#patientId').val(null).trigger('change');
        $('#previewImage').css('background-image', 'url(' + defaultImage + ')');
        filename = null;
        resetModalForm('#addNewForm', '#validationErrorsBox');
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editDocumentValidationErrorsBox');
    });
});

$(document).on('change', '#documentImage', function () {
    let extension = isValidDocument($(this), '#validationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#validationErrorsBox').html('').hide();
        displayDocument(this, '#previewImage', extension);
    }
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
        setTimeout(function () {
            $(validationMessageSelector).slideUp(500);
        }, 5000);
        return false;
    }
    return ext;
};
