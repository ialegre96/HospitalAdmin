'use strict';

$(document).ready(function () {
    let tableName = '#radiologyCategoryTable';
    let tbl = $('#radiologyCategoryTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[2, 'desc']],
        ajax: {
            url: radiologyCategoryUrl,
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
                'className': 'text-center text-nowrap',
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
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender(
                        '#radiologyCategoryActionTemplate',
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
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: radiologyCategoryCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#radiologyCategoryTable').
                    DataTable().
                    ajax.
                    reload(null, true);
                $('#btnSave').attr('disabled', false);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            $('#btnSave').attr('disabled', false);
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
    $('#btnEditSave').attr('disabled', true);
    var id = $('#radiologyCategoryId').val();
    $.ajax({
        url: radiologyCategoryUrl + '/' + id,
        type: 'patch',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#radiologyCategoryTable').
                    DataTable().
                    ajax.
                    reload(null, true);
                $('#btnEditSave').attr('disabled', false);
            }
        },
        error: function (result) {
            UnprocessableInputError(result);
            $('#btnEditSave').attr('disabled', false);
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

window.renderData = function (id) {
    $.ajax({
        url: radiologyCategoryUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let radiologyCategory = result.data;
                $('#radiologyCategoryId').val(radiologyCategory.id);
                $('#editName').val(radiologyCategory.name);
                $('#editModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};
$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let radiologyCategoryId = $(event.currentTarget).data('id');
    renderData(radiologyCategoryId);
});

$(document).on('click', '.delete-btn', function (event) {
    let radiologyCategoryId = $(event.currentTarget).data('id');
    deleteItem(radiologyCategoryUrl + '/' + radiologyCategoryId,
        '#radiologyCategoryTable', 'Radiology Category');
});
