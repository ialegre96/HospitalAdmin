'use strict';

$(document).ready(function () {

    let tbl = $('#bloodIssuesTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: bloodIssueUrl,
        },
        columnDefs: [
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [5],
                'className': 'text-right',
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
                    let showLink = '#';
                    let patientName;
                    if (isAdmin == true){
                        showLink =  patientUrl + '/' + row.patient.id;
                        patientName = `<a href="${showLink}"
                           class="mb-1">${row.patient.user.full_name}</a>`;
                    }else {
                        patientName = `<span class="fw-bolder text-gray-800 mb-1">${row.patient.user.full_name}</span>`;
                    }
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.patientImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            ${patientName}
                            <span>${row.patient.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    let showLink = doctorUrl + '/' + row.doctor.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.doctorImageUrl}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.doctor.user.full_name}</a>
                            <span>${row.doctor.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'doctor.user.first_name',
            },
            {
                data: 'blooddonor.name',
                name: 'blooddonor.name',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.issue_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                    <div class="mb-2">${moment(row.issue_date).utc().format('LT')}</div>
                    <div>${moment(row.issue_date).utc().format('Do MMM, Y')}</div>
                </div>`;
                },
                name: 'issue_date',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-danger">${row.blooddonor.blood_group}</span>`;
                },
                name: 'blooddonor.blood_group',
            },
            {
                data: function data (row) {
                    return !isEmpty(row.amount) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.amount) +
                        '</p>' : 'N/A';
                }, name: 'amount',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('.modalActionTemplate', data);
                }, name: 'patient.user.last_name',
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
        url: bloodIssueCreateUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#bloodIssuesTable').DataTable().ajax.reload(null, false);
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

$('#donorName').on('change', function () {
    changeBloodGroup('#bloodGroup', $(this).val());
});
$('#editDonorName').on('change', function () {
    changeBloodGroup('#editBloodGroup', $(this).val());
});

window.changeBloodGroup = function (selector, id) {
    $.ajax({
        url: bloodGroupUrl,
        type: 'get',
        dataType: 'json',
        data: { id: id },
        success: function (data) {
            $(selector).empty();
            $.each(data.data, function (i, v) {
                $(selector).
                    append($('<option></option>').attr('value', i).text(v));
            });
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $('#btnEditSave').attr('disabled', true);
    let id = $('#bloodIssueId').val();
    $.ajax({
        url: bloodIssueUrl + '/' + id,
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#bloodIssuesTable').DataTable().ajax.reload(null, false);
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
    $('#btnSave').attr('disabled', false);
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    $('#btnEditSave').attr('disabled', false);
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

window.renderData = function (id) {
    $.ajax({
        url: bloodIssueUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let bloodIssue = result.data;
                $('#bloodIssueId').val(bloodIssue.id);
                $('#editIssueDate').
                    val(moment(bloodIssue.issue_date).utc().
                        format('YYYY-MM-DD HH:mm:ss'));
                $('#editDoctorName').
                    val(bloodIssue.doctor_id).
                    trigger('change');
                $('#editPatientName').
                    val(bloodIssue.patient_id).
                    trigger('change');
                $('#editDonorName').
                    val(bloodIssue.donor_id).
                    trigger('change', [{ isEdit: true }]);
                $('#editAmount').val(bloodIssue.amount);
                $('.price-input').trigger('input');
                $('#editRemarks').val(bloodIssue.remarks);
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
    let bloodIssueId = $(event.currentTarget).data('id');
    renderData(bloodIssueId);
});

$(document).on('click', '.delete-btn', function (event) {
    let bloodIssueId = $(event.currentTarget).data('id');
    deleteItem(
        bloodIssueUrl + '/' + bloodIssueId,
        '#bloodIssuesTable',
        'Blood Issue',
    );
});

$(document).ready(function () {
    $('#doctorName,#patientName,#donorName,#bloodGroup').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('#editDoctorName,#editPatientName,#editDonorName,#editBloodGroup').select2({
        width: '100%',
        dropdownParent: $('#editModal')
    });
    let issueDate = $('#issueDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        maxDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    let editIssueDate = $('#editIssueDate').flatpickr({
        enableTime: true,
        maxDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });
});
