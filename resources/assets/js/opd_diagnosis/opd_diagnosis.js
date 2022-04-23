import moment from "moment";
'use strict';

$(document).ready(function () {
    let tableName = '#tblOpdDiagnoses';
    let tbl = $('#tblOpdDiagnoses').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: opdDiagnosisUrl,
            data: function (data) {
                data.id = opdPatientDepartmentId;
            },
        },
        columnDefs: [
            {
                'targets': [0, 1, 2],
                'width': '10%',
            },
            {
                'targets': [3],
                'width': '20%',
            },
            {
                'targets': [4],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '4%',
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: 'report_type',
                name: 'report_type',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.report_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.report_date).format('LT')}</div>
                                <div>${moment(row.report_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'report_date',
            },
            {
                data: function (row) {
                    if (row.opd_diagnosis_document_url != '') {
                        let downloadLink = downloadDiagnosisDocumentUrl + '/' +
                            row.id;
                        return '<a href="' + downloadLink + '">' + 'Download' +
                            '</a>';
                    } else
                        return 'N/A';
                },
                name: 'description',
            },
            {
                data: 'description',
                name: 'description',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('#opdDiagnosisActionTemplate',
                        data);
                }, name: 'id',
            },
        ],
    });
    searchDataTable(tbl,'#search-table-2');

    function searchDataTable(tbl, selector) {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tbl.search(e.target.value).draw();
        });
    }

    $('#reportDate, #editReportDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: "Y-m-d H:i",
        useCurrent: true,
        sideBySide: true,
        minDate: moment(appointmentDate).format('YYYY-MM-DD'),
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom',
        },
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(opdDiagnosisUrl + '/' + id, tableName, 'OPD Diagnosis');
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        let data = {
            'formSelector': $(this),
            'url': opdDiagnosisCreateUrl,
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
        let opdDiagnosisId = $(event.currentTarget).data('id');
        renderData(opdDiagnosisId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: opdDiagnosisUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let ext = result.data.opd_diagnosis_document_url.split('.').pop().toLowerCase();
                    if (ext == 'pdf') {
                        $('#editPreviewImage').css('background-image', 'url("' + pdfDocumentImageUrl + '")');
                    } else if ((ext == 'docx') || (ext == 'doc')) {
                        $('#editPreviewImage').css('background-image', 'url("' + docxDocumentImageUrl + '")');
                    } else {
                        if (result.data.opd_diagnosis_document_url != '') {
                            $('#editPreviewImage').css('background-image', 'url("' + result.data.opd_diagnosis_document_url + '")');
                        }
                    }
                    $('#opdDiagnosisId').val(result.data.id);
                    $('#editReportType').val(result.data.report_type);
                    document.querySelector('#editReportDate')._flatpickr.setDate(moment(result.data.report_date).format());
                    $('#editDescription').val(result.data.description);
                    if (result.data.opd_diagnosis_document_url != '') {
                        $('#documentUrl').show();
                        $('.btn-view').show();
                        $('#documentUrl').attr('href',
                            result.data.opd_diagnosis_document_url);
                    } else {
                        $('#documentUrl').hide();
                        $('.btn-view').hide();
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
        let loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        let id = $('#opdDiagnosisId').val();
        let url = opdDiagnosisUrl + '/' + id;
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
        $('#previewImage').attr('src', defaultDocumentImageUrl);
        $('#previewImage').css('background-image', 'url("' + defaultDocumentImageUrl + '")');
    });

    $('#EditModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
        $('#editPreviewImage').css('background-image', 'url("' + defaultDocumentImageUrl + '")');
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
    let extension = isValidDocument($(this), '#editValidationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        $('#editValidationErrorsBox').html('').hide();
        displayDocument(this, '#editPreviewImage', extension);
    }
});

window.isValidDocument = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).html(
            'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').show();
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
