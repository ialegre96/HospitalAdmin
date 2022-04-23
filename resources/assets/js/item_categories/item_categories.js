'use strict';

let tableName = '#itemCategoriesTbl';
let tbl = $(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[2, 'desc']],
    ajax: {
        url: itemCategoriesUrl,
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
                let data = [
                    {
                        'id': row.id,
                    }];
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let itemCategoryId = $(event.currentTarget).data('id');
    renderData(itemCategoryId);
});

$(document).on('click', '.delete-btn', function (event) {
    let itemCategoryId = $(event.currentTarget).data('id');
    deleteItem(itemCategoriesUrl + '/' + itemCategoryId, '#itemCategoriesTbl',
        'Item Category');
});

window.renderData = function (id) {
    $.ajax({
        url: itemCategoriesUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let itemCategory = result.data;
                $('#itemCategoryId').val(itemCategory.id);
                $('#editName').val(itemCategory.name);
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
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: itemCategoryCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#itemCategoriesTbl').DataTable().ajax.reload(null, true);
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
    var id = $('#itemCategoryId').val();
    $.ajax({
        url: itemCategoriesUrl + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#itemCategoriesTbl').DataTable().ajax.reload(null, true);
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
