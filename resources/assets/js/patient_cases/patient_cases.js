'use strict';

$(document).ready(function () {
    let tableName = '#casesTbl';
    let tbl = $('#casesTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[3, 'desc']],
        ajax: {
            url: casesUrl,
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
                'targets': [2],
                'width': '20%',
            },
            {
                'targets': [5],
                'orderable': false,
                'width': '6%',
            },
            {
                'targets': [6],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [7, 8],
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
                    return '<a data-id="' + row.id +
                        '" href="#" class="show-btn badge badge-light-info">' + row.case_id + '</a>';
                },
                name: 'case_id',
            },
            {
                data: function (row) {
                    let showLink = patientUrl + '/' + row.patient.id;
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
                                <a href="${showLink}" class="mb-1">${row.patient.user.full_name}</a>
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
                                <a href="${showLink}" class="mb-1">${row.doctor.user.full_name}</a>
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
                    if (row.date === null) {
                        return '';
                    }

                    return `<div class="badge badge-light">
                                <div class="mb-2">${moment(row.date).format('LT')}</div>
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return !isEmpty(row.fee) ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.fee) + '</p>' : 'N/A';
                },
                name: 'fee',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    return `<label class="form-check form-switch form-check-custom form-check-solid form-switch-sm"><input name="status" data-id="${row.id}" class="form-check-input status" type="checkbox" value="1" ${checked} /><span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span></label>`;
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let url = casesUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
                }, name: 'id',
            },
            {
                data: 'patient.user.last_name',
                name: 'patient.user.last_name',
            },
            {
                data: 'doctor.user.last_name',
                name: 'doctor.user.last_name',
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
        let caseId = $(event.currentTarget).data('id');
        deleteItem(casesUrl + '/' + caseId, '#casesTbl', 'Case');
    });

    $(document).on('click', '#resetFilter', function () {
        $('#filter_status').val(2).trigger('change');
    });

    // status activation deactivation change event
    $(document).on('change', '.status', function (event) {
        let caseId = $(event.currentTarget).data('id');
        activeDeActiveStatus(caseId);
    });

    // activate de-activate Status
    window.activeDeActiveStatus = function (id) {
        $.ajax({
            url: casesUrl + '/' + id + '/active-deactive',
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    tbl.ajax.reload();
                }
            },
        });
    };

    $(document).on('click', '.show-btn', function (event) {
        let patientCaseId = $(event.currentTarget).attr('data-id');
        renderData(patientCaseId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: route('patient_case.show.modal', id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#case_id').text(result.data.case_id);
                    $('#patient_name').text(result.data.patient.user.full_name);
                    $('#patient_phone').text(result.data.phone);
                    $('#patient_doctor').text(result.data.doctor.user.full_name);
                    $('#case_date').text(moment(result.data.date).format('Do MMM, Y h:mm A'));
                    $('#case_fee').text(currentCurrency + ' ' + addCommas(result.data.fee));
                    $('#description').text(result.data.description);
                    $('#patientStatus').empty();
                    if (result.data.status == 1) {
                        $('#patientStatus').
                            append(
                                '<span class="badge badge-light-success">Active</span>');
                    } else {
                        $('#patientStatus').
                            append(
                                '<span class="badge badge-light-danger">Deactive</span>');
                    }
                    $('#created_on').
                        text(moment(result.data.created_at).fromNow());
                    $('#updated_on').
                        text(moment(result.data.updated_at).fromNow());

                    setValueOfEmptySpan();
                    $('#showPatientCase').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    };

});
