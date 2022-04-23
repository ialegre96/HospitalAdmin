'use strict';

$(document).ready(function () {

    let tbl = $('#vaccinatedPatientTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [6, 'desc'],
        ajax: {
            url: vaccinatedPatientUrl,
        },
        columnDefs: [
            {
                'targets': [5],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '10%',
            },
            {
                'targets': [4],
                'className': 'text-center',
                'width': '18%',
            },
            {
                'targets': [3],
                'className': 'text-center',
                'width': '10%',
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
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div>
                                <img src="${row.image_url}" alt=""
                                     class="user-img">
                            </div>
                        </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="${showLink}"
                               class="mb-1">${row.patient.user.full_name}</a>
                            <span>${row.patient.user.email}</span>
                        </div>
                    </div>`;
                },
                name: 'patient.user.first_name',
            },
            {
                data: 'vaccination.name',
                name: 'vaccination.name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-warning fs-7">${row.vaccination_serial_number ?? 'N/A'}</span>`;
                },
                name: 'vaccination_serial_number',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-info fs-7">${row.dose_number}</span>`;
                },
                name: 'dose_number',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.dose_given_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.dose_given_date).utc().format('LT')}</div>
                                <div>${moment(row.dose_given_date).utc().format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'dose_given_date',
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

$(document).ready(function () {
    $('#patientName,#vaccinationName').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('#editPatientName,#editVaccinationName').select2({
        width: '100%',
        dropdownParent: $('#editModal')
    });

    let doesDatePicker = $('#doesGivenDate,#editDoesGivenDate').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });
    // let editDoesDatePicker = $('#editDoesGivenDate').flatpickr({
    //     enableTime: true,
    //     dateFormat: 'Y-m-d',
    // });


    $('#addModal').on('shown.bs.modal', function () {
        doesDatePicker.set('minDate', new Date());
        $('#doesGivenDate').val(moment().format('YYYY-MM-DD HH:mm'));
    });

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
        $('#btnSave').attr('disabled', true);
        $.ajax({
            url: vaccinatedPatientCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    $('#vaccinatedPatientTable').
                        DataTable().
                    ajax.
                    reload(null, false);
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

$('#addModal').on('hidden.bs.modal', function () {
    $('#patientName').val('').trigger('change');
    $('#vaccinationName').val('').trigger('change');
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#btnSave').attr('disabled', false);
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let vaccinatedPatientId = $(event.currentTarget).attr('data-id');
    renderData(vaccinatedPatientId);
});

window.renderData = function (id) {
    $.ajax({
        url: vaccinatedPatientUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let vaccinatedPatient = result.data;
                $('#vaccinatedPatientId').val(vaccinatedPatient.id);
                $('#editPatientName').
                    val(vaccinatedPatient.patient_id).
                    trigger('change.select2');
                $('#editVaccinationName').
                    val(vaccinatedPatient.vaccination_id).
                    trigger('change.select2');
                $('#editSerialNo').
                    val(vaccinatedPatient.vaccination_serial_number);
                $('#editDoseNumber').val(vaccinatedPatient.dose_number);
                $('#editDoesGivenDate').
                    val(moment(vaccinatedPatient.dose_given_date).
                        utc().
                        format('YYYY-MM-DD HH:mm:ss'));
                // document.querySelector('#editDoesGivenDate').
                //     _flatpickr.
                //     setDate(moment(vaccinatedPatient.dose_given_date).format());
                $('#editDescription').val(vaccinatedPatient.description);
                $('#editModal').modal('show');
                ajaxCallCompleted();
                // editDoesDatePicker.set('minDate', $('#editDoesGivenDate').val());
                console.log(vaccinatedPatient.dose_given_date)
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#editBtnSave');
    loadingButton.button('loading');
    let id = $('#vaccinatedPatientId').val();
    $('#editBtnSave').attr('disabled', true);
    $.ajax({
        url: vaccinatedPatientUrl + '/' + id + '/update',
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#vaccinatedPatientTable').
                    DataTable().
                    ajax.
                    reload(null, false);
                $('#editBtnSave').attr('disabled', false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $('#editBtnSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

    $(document).on('click', '.delete-btn', function (event) {
        let vaccinatedPatientId = $(event.currentTarget).data('id');
        deleteItem(vaccinatedPatientUrl + '/' + vaccinatedPatientId,
            '#vaccinatedPatientTable', 'Vaccinated Patient');
    });
});
