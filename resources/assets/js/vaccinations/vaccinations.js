'use strict';
$(document).ready(function () {

    let tbl = $('#vaccinationsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [4, 'desc'],
        ajax: {
            url: vaccinationUrl,
        },
        columnDefs: [
            {
                'targets': [3],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '10%',
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
                data: 'name',
                name: 'name',
            },
            {
                data: 'manufactured_by',
                name: 'manufactured_by',
            },
            {
                data: 'brand',
                name: 'brand',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('.modalActionTemplate', data);
                }, name: 'name',
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
    $.ajax({
        url: vaccinationCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#vaccinationsTable').DataTable().ajax.reload(null, false);
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let vaccinationId = $(event.currentTarget).attr('data-id');
    renderData(vaccinationId);
});

window.renderData = function (id) {
    $.ajax({
        url: vaccinationUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let vaccination = result.data;
                $('#vaccinationId').val(vaccination.id);
                $('#editName').val(vaccination.name);
                $('#editManufacturedBy').val(vaccination.manufactured_by);
                $('#editBrand').val(vaccination.brand);
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
    let id = $('#vaccinationId').val();
    $.ajax({
        url: vaccinationUrl + '/' + id + '/update',
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#vaccinationsTable').DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let vaccinationId = $(event.currentTarget).data('id');
    deleteItem(vaccinationUrl + '/' + vaccinationId, '#vaccinationsTable',
        'Vaccination');
});
