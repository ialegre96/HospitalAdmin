'use strict';

$(document).ready(function () {

    let tbl = $('#bloodDonationTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [3, 'desc'],
        ajax: {
            url: bloodDonationUrl,
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [1],
                'className': 'text-right',
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
                data: 'blooddonor.name',
                name: 'blooddonor.name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info">${row.bags}</span>`;
                },
                name: 'bags',
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
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: bloodDonationCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#bloodDonationTable').DataTable().ajax.reload(null, false);
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2500);
                $('#btnSave').attr('disabled', false);
            }
        },
        error: function (result) {
            printErrorMessage('#validationErrorsBox', result);
            setTimeout(function () {
                loadingButton.button('reset');
            }, 2000);
            $('#btnSave').attr('disabled', false);
        },
    });
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $('#btnEditSave').attr('disabled', true);
    let id = $('#bloodDonationId').val();
    $.ajax({
        url: bloodDonationUrl + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bloodDonationTable').DataTable().ajax.reload(null, false);
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
    $('#donorName').val('').trigger('change.select2');
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#btnSave').attr('disabled', false);
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});

window.renderData = function (id) {
    $.ajax({
        url: bloodDonationUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodDonation = result.data;
                $('#bloodDonationId').val(bloodDonation.id);
                $('#editDonorName').val(bloodDonation.blood_donor_id);
                $('#editDonorName').trigger('change');
                $('#editBags').val(bloodDonation.bags);
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
    let bloodDonationId = $(event.currentTarget).data('id');
    renderData(bloodDonationId);
});

$(document).on('click', '.delete-btn', function (event) {
    let bloodDonationId = $(event.currentTarget).data('id');
    deleteItem(
        bloodDonationUrl + '/' + bloodDonationId,
        '#bloodDonationTable',
        'Blood Donation',
    );
});

$(document).ready(function () {
    $('#donorName').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('#editDonorName').select2({
        width: '100%',
        dropdownParent: $('#editModal')
    });
    $('#addModal, #editModal').on('shown.bs.modal', function () {
        $('#donorName, #editDonorName:first').focus();
    });
});
