'use strict';

$(document).ready(function () {

    let tbl = $('#bloodBankTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: bloodBankUrl,
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '5%',
            },
            {
                'targets': [0],
                'className': 'text-left',
                'width': '30%',
            },
            {
                'targets': [1],
                'className': 'text-right',
                'width': '30%',
            },
            {
                'targets': [0, 1],
                'width': '30%',
            },
            {
                'targets': [3],
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
                    if (row.remained_bags <= 0) {
                        return `<span class="badge badge-light-danger">${row.blood_group}</span>`;
                    }
                    return `<span class="badge badge-light-success">${row.blood_group}</span>`;
                },
                name: 'blood_group',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${row.remained_bags}</span>`;
                },
                name: 'remained_bags',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
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

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    $(loadingButton).attr('disabled', true);
    $.ajax({
        url: bloodBankCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#bloodBankTable').DataTable().ajax.reload(null, false);
                $(loadingButton).attr('disabled', false);
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
    var id = $('#bloodBankId').val();
    $.ajax({
        url: bloodBankUrl + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bloodBankTable').DataTable().ajax.reload(null, false);
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
    $('#btnSave').attr('disabled', false);
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    $('#btnEditSave').attr('disabled', false);
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

window.renderData = function (id) {
    $.ajax({
        url: bloodBankUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodGroup = result.data;
                $('#bloodBankId').val(bloodGroup.id);
                $('#editBloodGroup').val(bloodGroup.blood_group);
                $('#editRemainedBags').val(bloodGroup.remained_bags);
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
    let bloodGroupId = $(event.currentTarget).data('id');
    renderData(bloodGroupId);
});

$(document).on('click', '.delete-btn', function (event) {
    let bloodGroupId = $(event.currentTarget).data('id');
    deleteItem(bloodBankUrl + '/' + bloodGroupId, '#bloodBankTable',
        'Blood Group');
});
