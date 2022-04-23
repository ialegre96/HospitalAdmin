'use strict';

$(document).ready(function () {
    let patientAdmissionsTable = '#patientAdmissionsTbl';
    let tbl = $(patientAdmissionsTable).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[10, 'desc']],
        ajax: {
            url: patientAdmissionsUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '10%',
            },
            {
                'targets': [9],
                'width': '8%',
                'orderable': false,
                'className': 'text-center text-nowrap',
            },
            {
                'targets': [8],
                'width': '5%',
                'orderable': false,
            },
            {
                'targets': [10],
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
                    return '<a href="#" class="show-btn badge badge-light-info" data-id="' + row.id +
                        '">' +
                        row.patient_admission_id + '</a>';
                },
                name: 'patient_admission_id',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="${showLink}">
                            <div class="">
                                <img src="${row.patientImageUrl}" alt=""
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
                    if (userRole) {
                        return row.doctor.user.full_name;
                    }
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
                    return row;
                },
                render: function (row) {
                    if (row.admission_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.admission_date).format('LT')}</div>
                                <div>${moment(row.admission_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'admission_date',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.discharge_date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.discharge_date).format('LT')}</div>
                                <div>${moment(row.discharge_date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'discharge_date',
            },
            {
                data: function (row) {
                    if (isEmpty(row.package_id)) {
                        return 'N/A';
                    }
                    let showLink = packageUrl + '/' + row.package.id;
                    return '<a href="' + showLink + '">' + row.package.name +
                        '</a>';
                },
                name: 'package.name',
            },
            {
                data: function (row) {
                    if (isEmpty(row.insurance_id)) {
                        return 'N/A';
                    }
                    let showLink = insuranceUrl + '/' + row.insurance.id;
                    return '<a href="' + showLink + '">' + row.insurance.name +
                        '</a>';
                },
                name: 'insurance.name',
            },
            {
                data: function (row) {
                    return isEmpty(row.policy_no) ? 'N/A' : row.policy_no;
                },
                name: 'policy_no',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return `<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm"><input name="status" data-id="${row.id}" class="form-check-input status" type="checkbox" value="1" ${checked} /><span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span></label>`;
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = patientAdmissionsUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'viewUrl': url,
                        }];
                    return prepareTemplateRender('.pageActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(patientAdmissionsTable).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(patientAdmissionsUrl + '/' + id, patientAdmissionsTable,
            'Patient Admission');
    });

    $(document).on('change', '.status', function (event) {
        let id = $(event.currentTarget).data('id');
        updateStatus(id);
    });

    $(document).on('click', '.show-btn', function (event) {
        let patientAdmissionId = $(event.currentTarget).attr('data-id');
        renderData(patientAdmissionId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('patient-admissions.show.modal', id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#patient_name').text(result.data.patient.user.full_name);
                    $('#doctor_name').text(result.data.doctor.user.full_name);
                    $('#admission_id').text(result.data.patient_admission_id);
                    $('#admission_date').text(result.data.admission_date);
                    $('#discharge_date').text(result.data.discharge_date);
                    $('#package').text(result.data.package ? result.data.package.name : 'N/A');
                    $('#insurance').text(result.data.insurance ? result.data.insurance.name : 'N/A');
                    $('#admission_bed').text(result.data.bed ? result.data.bed.name : 'N/A');
                    $('#policy_no').text(result.data.policy_no);
                    $('#agent_name').text(result.data.agent_name);
                    $('#guardian_name').text(result.data.guardian_name);
                    $('#guardian_relation').text(result.data.guardian_relation);
                    $('#guardian_contact').text(result.data.guardian_contact);
                    $('#guardian_address').text(result.data.guardian_address);
                    $('#patient_status').empty();
                    if (result.data.status == 1) {
                        $('#patient_status').
                            append(
                                '<span class="badge badge-light-success">Active</span>');
                    } else {
                        $('#patient_status').
                            append(
                                '<span class="badge badge-light-danger">Deactive</span>');
                    }
                    $('#created_on').
                        text(moment(result.data.created_at).fromNow());
                    $('#updated_on').
                        text(moment(result.data.updated_at).fromNow());

                    setValueOfEmptySpan();
                    $('#showPatientAdmission').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

    $(document).on('click', '#resetFilter', function () {
        $('#filter_status').val(2).trigger('change');
    });

    window.updateStatus = function (id) {
        $.ajax({
            url: patientAdmissionsUrl + '/' + +id + '/active-deactive',
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
});
