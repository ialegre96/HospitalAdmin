'use strict';

let tableName = '#prescriptionsTable';
$(document).ready(function () {

    let tbl = $('#prescriptionsTable').DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[5, 'desc']],
        ajax: {
            url: prescriptionUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'searchable': false,
                'className': 'text-center text-nowrap',
                'width': '10%',
            },
            {
                'targets': [3],
                'orderable': false,
                'searchable': false,
                'width': '10%',
            },
            {
                'targets': [5],
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
                    let showLink = patientUrl + '/' + row.patient_id;
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
                data: function (row) {
                    return isEmpty(row.medical_history)
                        ? 'N/A'
                        : row.medical_history;
                },
                name: 'medical_history',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{'id': row.id, 'checked': checked}];
                    return prepareTemplateRender('#prescriptionStatusTemplate',
                        data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = prescriptionUrl + '/' + row.id;
                    let showUrl = prescriptionUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'showUrl': showUrl,
                        }];
                    return prepareTemplateRender('#prescriptionActionTemplate',
                        data);
                }, name: 'patient.user.last_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '.delete-btn', function (event) {
        let prescriptionId = $(event.currentTarget).data('id');
        deleteItem(prescriptionUrl + '/' + prescriptionId,
            '#prescriptionsTable',
            'Prescription');
    });

    $(document).on('change', '.status', function (event) {
        let prescriptionId = $(event.currentTarget).data('id');
        updateStatus(prescriptionId);
    });

    window.updateStatus = function (id) {
        $.ajax({
            url: prescriptionUrl + '/' + +id + '/active-deactive',
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    tbl.ajax.reload(null, false);
                }
            },
        });
    };

    $(document).on('click', '#resetFilter', function () {
        $('#filter_status').val('2').trigger('change');
    });

    $(document).on('click', '.show-btn', function (event) {
        let prescriptionId = $(event.currentTarget).attr('data-id');
        renderData(prescriptionId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('prescriptions.show.modal', id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#patient_name').text(result.data.patient.user.full_name);
                    $('#doctor_name').text(result.data.doctor.user.full_name);
                    $('#food_allergies').text(result.data.food_allergies);
                    $('#tendency_bleed').text(result.data.tendency_bleed);
                    $('#heart_disease').text(result.data.heart_disease);
                    $('#high_blood_pressure').text(result.data.high_blood_pressure);
                    $('#diabetic').text(result.data.diabetic);
                    $('#surgery').text(result.data.surgery);
                    $('#accident').text(result.data.accident);
                    $('#others').text(result.data.others);
                    $('#medical_history').text(result.data.medical_history);
                    $('#current_medication').text(result.data.current_medication);
                    $('#female_pregnancy').text(result.data.female_pregnancy);
                    $('#breast_feeding').text(result.data.breast_feeding);
                    $('#health_insurance').text(result.data.health_insurance);
                    $('#low_income').text(result.data.low_income);
                    $('#reference').text(result.data.reference);
                    $('#status').empty();
                    if (result.data.status == 1) {
                        $('#status').
                            append(
                                '<span class="badge badge-light-success">Active</span>');
                    } else {
                        $('#status').
                            append(
                                '<span class="badge badge-light-danger">Deactive</span>');
                    }
                    $('#created_on').
                        text(moment(result.data.created_at).fromNow());
                    $('#updated_on').
                        text(moment(result.data.updated_at).fromNow());

                    setValueOfEmptySpan();
                    $('#showPrescription').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };
});
