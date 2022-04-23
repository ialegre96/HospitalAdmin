'use strict';

$(document).ready(function () {
    $('#addModal, #EditModal').on('shown.bs.modal', function () {
        $('#incomeId, #editIncomeHeadId:first').focus();
    });
    $('#incomeHead').select2({
        width: '100%',
    });
    $('#incomeId').select2({
        width: '100%',
        dropdownParent: $('#addModal'),
    });
    $('#editIncomeHeadId').select2({
        width: '100%',
        dropdownParent: $('#EditModal')
    });

    $('#date, #editDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });

    let tableName = '#incomeTable';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: incomeUrl,
            data: function (data) {
                data.income_head = $('#incomeHead').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '12%',
            },
            {
                'targets': [4],
                'className': 'text-right',
                'width': '10%',
            },
            {
                'targets': [0, 3],
                'width': '12%',
            },
            {
                'targets': [2],
                'width': '22%',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [7],
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
                    return isEmpty(row.invoice_number)
                        ? `<span class="badge badge-light-info">N/A</span>`
                        : `<span class="badge badge-light-info">${row.invoice_number}</span>`;
                },
                name: 'invoice_number',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return incomeHeadArray[row.income_head];
                },
                name: 'income_head',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
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
                    return !isEmpty(row.amount)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) + '</p>'
                        : 'N/A';
                },
                name: 'amount',
            },
            {
                data: function (row) {
                    if (row.document_url != '') {
                        let downloadLink = downloadDocumentUrl + '/' + row.id;
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
        'fnInitComplete': function () {
            $(document).on('change', '#incomeHead', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loginButton = jQuery(this).find('#btnSave');
        loginButton.button('loading');
        $('#btnSave').attr('disabled', true);
        $.ajax({
            url: incomeCreateUrl,
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    $('#btnSave').attr('disabled', false);
                    tbl.ajax.reload(null, false);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                $('#btnSave').attr('disabled', false);
            },
            complete: function () {
                loginButton.button('reset');
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(incomeUrl + '/' + id, tableName, 'Income');
    });

    $(document).on('click', '#resetFilter', function () {
        $('#incomeHead').val(0).trigger('change');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    window.renderData = function (id) {
        $.ajax({
            url: incomeUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let ext = result.data.document_url.split('.').
                        pop().
                        toLowerCase();
                    if (ext == 'pdf') {
                        // $('#editPreviewImage').attr('src', pdfDocumentImageUrl);
                        $('#editPreviewImage').css('background-image',
                            'url("' + pdfDocumentImageUrl + '")');
                    } else if ((ext == 'docx') || (ext == 'doc')) {
                        $('#editPreviewImage').css('background-image',
                            'url("' + docxDocumentImageUrl + '")');
                    } else if (ext == '') {
                        $('#editPreviewImage').css('background-image',
                            'url("' + defaultDocumentImageUrl + '")');
                    } else {
                        $('#editPreviewImage').css('background-image',
                            'url("' + result.data.document_url + '")');

                    }

                    $('#editIncomeId').val(result.data.id);
                    $('#editIncomeHeadId').
                        val(result.data.income_head).
                        trigger('change.select2');
                    $('#editName').val(result.data.name);
                    $('#editDate').val(format(result.data.date, 'YYYY-MM-DD'));
                    $('#editInvoiceNumber').val(result.data.invoice_number);
                    $('#editAmount').val(result.data.amount);
                    $('.price-input').trigger('input');
                    $('#editDescription').val(result.data.description);
                    if (isEmpty(result.data.document_url)) {
                        $('#documentUrl').hide();
                        $('.btn-view').hide();
                    } else {
                        $('#documentUrl').show();
                        $('.btn-view').show();
                        $('#documentUrl').attr('href', result.data.document_url);
                    }
                    $('#EditModal').modal('show');
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
        let id = $('#editIncomeId').val();
        let url = incomeUrl + '/' + id + '/update';
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton);
    });

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('#incomeId').val('').trigger('change.select2');
        // $('#previewImage').attr('src', defaultDocumentImageUrl);
        $('#previewImage').css('background-image',
            'url("' + defaultDocumentImageUrl + '")');
        $('#btnSave').attr('disabled', false);
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
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
            $(validationMessageSelector).html(documentError).show();
            return false;
        }
        return ext;
    };

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage');
    });
    $(document).on('click', '.remove-image-edit', function () {
        defaultImagePreview('#editPreviewImage');
    });
});



