'use strict';

$(document).ready(function () {

    let tbl = $('#bloodDonorsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[6, 'desc']],
        ajax: {
            url: bloodDonorUrl,
        },
        columnDefs: [
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [1],
                'className': 'text-right',
            },
            {
                'targets': [6],
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
                    return `<span class="badge badge-light-info">${row.age}</span>`;
                },
                name: 'age',
            },
            {
                data: function (row) {
                    if (row.gender == 1)
                        return `<span class="badge badge-light-primary">Female</span>`;
                    else
                        return `<span class="badge badge-light-success">Male</span>`;
                },
                name: 'gender',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-danger">${row.blood_group}</span>`;
                },
                name: 'blood_group',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.last_donate_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                    <div class="mb-2">${moment(row.last_donate_date).
                        utc().
                        format('LT')}</div>
                    <div>${moment(row.last_donate_date).
                        utc().
                        format('Do MMM, Y')}</div>
                </div>`;
                },
                name: 'last_donate_date',
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
        url: bloodDonorCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#bloodDonorsTable').DataTable().ajax.reload(null, false);
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
    var id = $('#bloodDonorId').val();
    $.ajax({
        url: bloodDonorUrl + '/' + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bloodDonorsTable').DataTable().ajax.reload(null, false);
                $(loadingButton).attr('disabled', false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
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

window.renderData = function (id) {
    $.ajax({
        url: bloodDonorUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodDonor = result.data;
                $('#bloodDonorId').val(bloodDonor.id);
                $('#editName').val(bloodDonor.name);
                $('#editAge').val(bloodDonor.age);
                $('#male,#female').prop('checked', false);
                if (bloodDonor.gender == 1) {
                    $('#female').prop('checked', true);
                } else {
                    $('#male').prop('checked', true);
                }
                $('#editBloodGroup').val(bloodDonor.blood_group);
                $('#editBloodGroup').trigger('change');
                $('#editLastDonationDate').
                    val(moment(bloodDonor.last_donate_date).
                        utc().
                        format('YYYY-MM-DD HH:mm:ss'));
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
    let bloodDonorId = $(event.currentTarget).data('id');
    renderData(bloodDonorId);
});

$(document).on('click', '.delete-btn', function (event) {
    let bloodDonorId = $(event.currentTarget).data('id');
    deleteItem(
        bloodDonorUrl + '/' + bloodDonorId,
        '#bloodDonorsTable',
        'Blood Donor',
    );
});

$(document).ready(function () {
    $('#bloodGroup').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('#editBloodGroup').select2({
        width: '100%',
        dropdownParent: $('#editModal')
    });
    let lastDonationDate = $("#lastDonationDate").flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        maxDate: new Date(),
        dateFormat: "Y-m-d H:i",
    });

    let editLastDonationDate = $("#editLastDonationDate").flatpickr({
        enableTime: true,
        maxDate: new Date(),
        dateFormat: "Y-m-d H:i",
    });
});
