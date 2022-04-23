'use strict';

let tableName = '#frontServicesTable';

$(document).ready(function () {
    let tbl = $('#frontServicesTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [4, 'desc'],
        ajax: {
            url: fontServicesUrl,
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
            {
                targets: [2],
                render: function (data) {
                    return data.length > 110 ? data.substr(0, 110) + '…' : data;
                },
            },
        ],
        columns: [
            {
                data: function (row) {
                    if (row.icon_url) {
                        return `<img src="${row.icon_url}" class="user-img image-stretching">`;
                    } else {
                        return `<img src="${defaultDocumentImageUrl}" class="user-img image-stretching">`;
                    }
                },
                name: 'id',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'short_description',
                name: 'short_description',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('.modalActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });
    handleSearchDatatable(tbl);
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: fontServicesCreateUrl,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
                $('#btnSave').attr('disabled', false);

            }
        },
        error: function error(result) {
            printErrorMessage('#validationErrorsBox', result);
            $('#btnSave').attr('disabled', false);
        },
        complete: function complete() {
            loadingButton.button('reset');
        },
    });

});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let frontServiceId = $(event.currentTarget).data('id');
    renderData(frontServiceId);
});

window.renderData = function (id) {
    $.ajax({
        url: fontServicesUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#frontServiceId').val(result.data.id);
                if (result.data.icon_url)
                    $('#editPreviewImage').
                        css('background-image',
                            'url("' + result.data.icon_url + '")');
                else
                    $('#editPreviewImage').
                        css('background-image',
                            'url("' + defaultDocumentImageUrl + '")');
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.short_description);
                if (isEmpty(result.data.icon_url)) {
                    $('#iconUrl').hide();
                    $('.btn-view').hide();
                } else {
                    $('#iconUrl').show();
                    $('.btn-view').show();
                    $('#iconUrl').attr('href', result.data.icon_url);
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
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $('#btnEditSave').attr('disabled', true);
    let id = $('#frontServiceId').val();
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: fontServicesUrl + '/' + id,
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
                $('#btnEditSave').attr('disabled', false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $('#btnEditSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#addModal #validationErrorsBox');
    $('#previewImage').
        attr('src', defaultDocumentImageUrl).
        css('background-image', `url(${defaultDocumentImageUrl})`);
    $('#btnSave').attr('disabled', false);
});

$('#addModal').on('shown.bs.modal', function () {
    $('#addModal #validationErrorsBox').show();
    $('#addModal #validationErrorsBox').addClass('d-none');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editModal #editValidationErrorsBox');
    $('#previewImage').
        attr('src', defaultDocumentImageUrl).
        css('background-image', `url(${defaultDocumentImageUrl})`);
    $('#btnEditSave').attr('disabled', false);
});

$('#editModal').on('shown.bs.modal', function () {
    $('#editModal #editValidationErrorsBox').show();
    $('#editModal #editValidationErrorsBox').addClass('d-none');
});

$(document).on('click', '.delete-btn', function (event) {
    let frontServiceId = $(event.currentTarget).data('id');
    deleteItem(fontServicesUrl + '/' + frontServiceId, tableName, 'Service');
});
