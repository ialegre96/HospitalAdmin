'use strict';

$(document).ready(function () {

    $('.consultation-date').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    $('.edit-consultation-date').flatpickr({
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    let tbl = $('#liveConsultationTable').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [8, 'desc'],
        ajax: {
            url: liveConsultationUrl,
            data: function (data) {
                data.status = $('#statusArr').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [1],
                'width': '15%',
            },
            {
                'targets': [5],
                'orderable': false,
                'width': '12%',
            },
            {
                'targets': [7],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '15%',
            },
            {
                'targets': [8],
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
                    return '<a href="#" class="show-data" data-id="' + row.id +
                        '">' + row.consultation_title + '</a>';
                },
                name: 'consultation_title',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.consultation_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.consultation_date).format('LT')}</div>
                                <div>${moment(row.consultation_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'consultation_date',
            },
            {
                data: 'user.full_name',
                name: 'user.first_name',
            },
            {
                data: 'doctor.user.full_name',
                name: 'doctor.user.first_name',
            },
            {
                data: 'patient.user.full_name',
                name: 'patient.user.first_name',
            },
            {
                data: function (row) {
                    let status = row.status;
                    let colours = [
                        'warning',
                        'danger',
                        'success',
                    ];
                    if (adminRole || doctorRole) {
                        return `<div class="w-150px d-flex align-items-center">
                            <span class="slot-color-dot bg-${colours[status]} rounded-circle me-2"></span>
                            <select class="form-select-sm form-select-solid form-select change-status" data-id="${row.id}">` +
                            `<option value="0" ${status == 0 ? 'selected' : ''}
                                ${(status == 1 || status == 2)  ? 'disabled' : ''}>Awaited</option>
                            <option value="1" ${status == 1 ? 'selected' : ''}
                                ${(status == 2)  ? 'disabled' : ''}>Cancelled</option>
                            <option value="2" ${status == 2 ? 'selected' : ''}
                                ${(status == 1)  ? 'disabled' : ''}>Finished</option>`
                            + `</select></div>`;
                    }
                    if (row.status == 1) {
                        return `<span class="badge badge-light-danger fw-bolder ms-2 fs-8 py-1 px-3">${row.status_text}</span>`;
                    } else if (row.status == 0) {
                        return `<span class="badge badge-light-warning fw-bolder ms-2 fs-8 py-1 px-3">${row.status_text}</span>`;
                    } else if (row.status == 2) {
                        return `<span class="badge badge-light-success fw-bolder ms-2 fs-8 py-1 px-3">${row.status_text}</span>`;
                    } else {
                        return row.status_text;
                    }
                },
                name: 'user.last_name',
            },
            {
                data: 'password',
                name: 'password',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'status': row.status,
                            'url': (patientRole)
                                ? row.meta.join_url
                                : row.meta.start_url,
                            'title': (patientRole)
                                ? 'Join Meeting'
                                : 'Start Meeting',
                            'isDoctor': doctorRole,
                            'isAdmin': adminRole,
                            'isMeetingFinished': row.status == 2 ? true : false,
                        }];

                    return prepareTemplateRender(
                        '#liveConsultationActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#statusArr', function () {
                $('#liveConsultationTable').DataTable().ajax.reload(null, true);
            });
        },
        drawCallback: function () {
            this.api().state.clear();
            $('.change-status').select2({
                width: '100%',
            });
        },
    });

    handleSearchDatatable(tbl);

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('.consultation-type, .consultation-type-number').val('').trigger('change');
        $('select').each(function (index, element) {
            let drpSelector = '#' + $(this).attr('id');
            $(drpSelector).val('');
            $(drpSelector).prop("selectedIndex", 0).trigger('change');
        });
        $('#type_number').val(null).trigger('change');
        $('#type_number').
            append('<option selected="selected" value="">Select Type Number</option>');
        $('#btnSave').attr('disabled', false);
    });
    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        $('#btnEditSave').attr('disabled', false);
    });

    let patientId = null;
    $('.consultation-type, .edit-consultation-type').on('change', function () {
        changeTypeNumber(
            '.consultation-type-number, .edit-consultation-type-number',
            $(this).val(), patientId);
    });

    $('.patient-name, .edit-patient-name').on('change', function () {
        if ($(this).val() !== '') {
            patientId = $(this).val();
            $('.consultation-type-number, .edit-consultation-type-number').empty();
            $('.consultation-type-number, .edit-consultation-type-number').
                append('<option selected="selected" value="">Select Type Number</option>');
            $('.consultation-type, .edit-consultation-type').removeAttr('disabled');
        }
    });

    window.changeTypeNumber = function (selector, id, patientId) {
        if ($(this).val() !== '') {
            $.ajax({
                url: liveConsultationTypeNumber,
                type: 'get',
                dataType: 'json',
                data: {
                    consultation_type: id,
                    patient_id: patientId,
                },
                success: function (data) {
                    if (data.data.length !== 0) {
                        $(selector).empty();
                        $(selector).removeAttr('disabled');
                        $(selector).append('<option selected="selected" value="">Select Type Number</option>')
                        $.each(data.data, function (i, v) {
                            $(selector).append($('<option></option>').attr('value', i).text(v));
                        });
                        $(selector).select2()
                    } else {
                        $(selector).empty()
                        $(selector).append('<option selected="selected" value="">Select Type Number</option>')
                        $(selector).prop('disabled', true);
                    }
                },
            });
        }
        $(selector).empty();
        $(selector).prop('disabled', true);
    };

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $('#btnSave').attr('disabled', true);
        $.ajax({
            url: liveConsultationCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    $('#liveConsultationTable').
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

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        $('#btnEditSave').attr('disabled', true);
        let id = $('#liveConsultationId').val();
        $.ajax({
            url: liveConsultationUrl + '/' + id,
            type: 'post',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $('#liveConsultationTable').
                        DataTable().
                        ajax.
                        reload(null, false);
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

    window.renderData = function (id) {
        $.ajax({
            url: liveConsultationUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let liveConsultation = result.data;
                    $('#liveConsultationId').val(liveConsultation.id);
                    $('.edit-consultation-title').val(liveConsultation.consultation_title);
                    document.querySelector('.edit-consultation-date').
                        _flatpickr.
                        setDate(moment(liveConsultation.consultation_date).format('YYYY-MM-DD h:mm A'));
                    $('.edit-consultation-duration-minutes').val(liveConsultation.consultation_duration_minutes);
                    $('.edit-patient-name').val(liveConsultation.patient_id).trigger('change');
                    $('.edit-doctor-name').val(liveConsultation.doctor_id).trigger('change');
                    $('.host-enable,.host-disabled').prop('checked', false);
                    if (liveConsultation.host_video == 1) {
                        $(`input[name="host_video"][value=${liveConsultation.host_video}]`).prop('checked', true);
                    } else {
                        $(`input[name="host_video"][value=${liveConsultation.host_video}]`).prop('checked', true);
                    }
                    $('.client-enable,.client-disabled').prop('checked', false);
                    if (liveConsultation.participant_video == 1) {
                        $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).prop('checked', true);
                    } else {
                        $(`input[name="participant_video"][value=${liveConsultation.participant_video}]`).prop('checked', true);
                    }
                    $('.edit-consultation-type').val(liveConsultation.type).trigger('change');
                    setTimeout(function (){
                        $('.edit-consultation-type-number').val(liveConsultation.type_number).trigger('change');
                    }, 400)
                    $('.edit-description').val(liveConsultation.description);
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
        let liveConsultationId = $(event.currentTarget).data('id');
        renderData(liveConsultationId);
    });

    $(document).on('click', '.start-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let liveConsultationId = $(event.currentTarget).data('id');
        startRenderData(liveConsultationId);
    });

    window.startRenderData = function (id) {
        $.ajax({
            url: liveConsultationUrl + '/' + id + '/start',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let liveConsultation = result.data;
                    $('#startLiveConsultationId').val(liveConsultation.liveConsultation.id);
                    $('.start-modal-title').text(
                        liveConsultation.liveConsultation.consultation_title);
                    $('.host-name').text(liveConsultation.liveConsultation.user.full_name);
                    $('.date').text(
                        liveConsultation.liveConsultation.consultation_date);
                    $('.minutes').text(
                        liveConsultation.liveConsultation.consultation_duration_minutes);
                    $('#startModal').find('.status').append((liveConsultation.zoomLiveData.data.status ===
                        'started') ? $('.status').text('Started') : $(
                        '.status').text('Awaited'));
                    $('.start').attr('href', (patientRole)
                        ? liveConsultation.liveConsultation.meta.join_url
                        : ((liveConsultation.zoomLiveData.data.status ===
                            'started')
                            ? $('.start').addClass('disabled')
                            : liveConsultation.liveConsultation.meta.start_url),
                    );
                    $('#startModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('click', '.delete-btn', function (event) {
        let liveConsultationId = $(event.currentTarget).data('id');
        deleteItem(
            liveConsultationUrl + '/' + liveConsultationId,
            '#liveConsultationTable',
            'Live Consultation',
        );
    });

    $(document).on('change', '.change-status', function () {
        let statusId = $(this).val();
        $.ajax({
            url: liveConsultationUrl + '/change-status',
            type: 'GET',
            data: {statusId: statusId, id: $(this).data('id')},
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#liveConsultationTable').DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    });

    $(document).on('click', '.show-data', function (event) {
        let consultationId = $(event.currentTarget).data('id');
        $.ajax({
            url: liveConsultationUrl + '/' + consultationId,
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let liveConsultation = result.data.liveConsultation;
                    let showModal = $('#showModal');
                    $('#startLiveConsultationId').val(liveConsultation.id);
                    $('#consultationTitle').text(liveConsultation.consultation_title);
                    $('#consultationDate').text(liveConsultation.consultation_date);
                    $('#consultationDurationMinutes').text(liveConsultation.consultation_duration_minutes);
                    $('#consultationPatient').text(liveConsultation.patient.user.full_name);
                    $('#consultationDoctor').text(liveConsultation.doctor.user.full_name);
                    (liveConsultation.type == 0) ? showModal.find(
                        '#consultationType').append('OPD') : showModal.find(
                        '#consultationType').append('IPD');
                    (liveConsultation.type == 0)
                        ? showModal.find('#consultationTypeNumber').append(liveConsultation.opd_patient.opd_number)
                        : showModal.find('#consultationTypeNumber').append(liveConsultation.ipd_patient.ipd_number);
                    (liveConsultation.host_video === 0) ? $(
                        '#consultationHostVideo').text('Disable') : $(
                        '#consultationHostVideo').text('Enable');
                    (liveConsultation.participant_video === 0) ? $(
                        '#consultationParticipantVideo').text('Disable') : $(
                        '#consultationParticipantVideo').text('Enable');
                    isEmpty(liveConsultation.description) ? $(
                        '#consultationDescription').text('N/A') : $(
                        '#consultationDescription').text(liveConsultation.description);
                    showModal.modal('show');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    });
    $('#showModal').on('hidden.bs.modal', function () {
        $(this).find(
            '#consultationTitle, #consultationDate, #consultationDurationMinutes, #consultationPatient, #consultationDoctor, #consultationType, #consultationTypeNumber, #consultationHostVideo, #consultationParticipantVideo, #consultationDescription').empty();
    });

    $(document).on('click', '.add-credential', function () {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let userId = $('#userId').val();
        userZoomRenderData(userId);
    });

    window.userZoomRenderData = function (id) {
        $.ajax({
            url: 'user-zoom-credential/' + id + '/fetch',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let userZoomData = result.data;
                    if (!isEmpty(userZoomData)) {
                        $('#zoomApiKey').val(userZoomData.zoom_api_key);
                        $('#zoomApiSecret').val(userZoomData.zoom_api_secret);
                    }
                    $('#addCredential').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#addZoomForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnZoomSave');
        loadingButton.button('loading');
        $.ajax({
            url: zoomCredentialCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addCredential').modal('hide');
                    setTimeout(function () {
                        loadingButton.button('reset');
                    }, 2500);
                }
            },
            error: function (result) {
                printErrorMessage('#credentialValidationErrorsBox', result);
                setTimeout(function () {
                    loadingButton.button('reset');
                }, 2000);
            },
        });
    });

    $('.doctor-name,.patient-name,.consultation-type,.consultation-type-number,.change-status, #statusArr').select2({
        width: '100%',
        dropdownParent: $('#addModal')
    });
    $('.edit-doctor-name,.edit-patient-name,.edit-consultation-type,.edit-consultation-type-number,.edit-change-status, #statusArr').select2({
        width: '100%',
        dropdownParent: $('#editModal')
    });
});

$(document).on('click', '#resetFilter', function () {
    $('#statusArr').val('').trigger('change');
});

$('.consultation-type').on('change', function () {
    $('.consultation-type-number').val('').trigger('change');
})

$('#patientName').on('change', function () {
    $('.consultation-type').val('').trigger('change');
    $('.consultation-type-number').trigger('change');
})
