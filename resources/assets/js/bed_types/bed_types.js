'use strict';

$(document).ready(function () {

    let tableName = '#bedTypesTbl';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: bedTypesUrl,
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
                'className': 'text-center  text-nowrap',
                'width': '8%',
            },
            {
                'targets': [2],
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
                    let showLink = bedTypesUrl + '/' + row.id;
                    return '<a href="' + showLink + '">' + row.title + '</a>';
                },
                name: 'title',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        }];
                    return prepareTemplateRender('.modalActionTemplate', data);
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let bedTypeId = $(event.currentTarget).data('id');
    renderData(bedTypeId);
});

$(document).on('click', '.delete-btn', function (event) {
    let bedTypeId = $(event.currentTarget).data('id');
    deleteItem(bedTypesUrl + '/' + bedTypeId, '#bedTypesTbl', 'Bed Type');
});

window.renderData = function (id) {
    $.ajax({
        url: bedTypesUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bedType = result.data;
                $('#bedTypeId').val(bedType.id);
                $('#editTitle').val(bedType.title);
                $('#editDescription').val(bedType.description);
                $('#editModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    $(loadingButton).attr('disabled', true);
    $.ajax({
        url: bedTypesCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(loadingButton).attr('disabled', false);
                $('#addModal').modal('hide');
                $('#bedTypesTbl').DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            $(loadingButton).attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $(loadingButton).attr('disabled', true);
    var id = $('#bedTypeId').val();
    $.ajax({
        url: bedTypesUrl + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bedTypesTbl').DataTable().ajax.reload(null, false);
                $(loadingButton).attr('disabled', false);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
            $(loadingButton).attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#btnSave').attr('disabled', false);
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});
