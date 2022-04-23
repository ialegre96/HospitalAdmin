'use strict';

$(document).ready(function () {
    let tableName = '#doctorOPDChargeTable';
    let tbl = $(tableName).DataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [3, 'desc'],
        ajax: {
            url: doctorOPDChargeUrl,
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '10%',
            },
            {
                'targets': [1],
                'className': 'text-right',
                'width': '15%',
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
                        let showLink = doctorShowUrl + '/' + row.doctor_id;
                    return `<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${showLink}">
                                    <div class="">
                                        <img src="${row.image_url}" alt="" class="user-img">
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
                    return !isEmpty(row.standard_charge)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.standard_charge) + '</p>'
                        : 'N/A';
                },
                name: 'standard_charge',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender('#doctorOPDChargeTemplate',
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
    
    $('#addModal, #editModal').on('shown.bs.modal', function () {
        $('#doctorId, #editDoctorId:first').focus();
    });
    
    $('#doctorId').select2({
        width: '100%',
        dropdownParent: $('#addModal'),
    })

    $('#editDoctorId').select2({
        width: '100%',
        dropdownParent: $('#editModal'),
    })

    $(document).on('submit', '#addNewForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnSave');
        loadingButton.button('loading');
        $('#btnSave').attr('disabled', true);
        $.ajax({
            url: doctorOPDChargeCreateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addModal').modal('hide');
                    tbl.ajax.reload(null, false);
                    $('#btnSave').attr('disabled', false);
                }
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                $('#btnSave').attr('disabled', false);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        deleteItem(doctorOPDChargeUrl + '/' + id, tableName,
            'Doctor OPD Charge');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let doctorOPDChargeId = $(event.currentTarget).data('id');
        renderData(doctorOPDChargeId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: doctorOPDChargeUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#doctorOPDChargeId').val(result.data.id);
                    $('#editDoctorId').val(result.data.doctor_id).trigger('change.select2');
                    $('#editStandardCharge').val(result.data.standard_charge);
                    $('.price-input').trigger('input');
                    $('#editModal').modal('show');
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editForm', function (event) {
        event.preventDefault();
        var loadingButton = jQuery(this).find('#btnEditSave');
        loadingButton.button('loading');
        $('#btnEditSave').attr('disabled', true);
        let id = $('#doctorOPDChargeId').val();
        $.ajax({
            url: doctorOPDChargeUrl + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                    $('#btnEditSave').attr('disabled', false);
                }
            },
            error: function (result) {
                UnprocessableInputError(result);
                $('#btnEditSave').attr('disabled', false);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('#doctorId').val('').trigger('change.select2');
        $('#btnSave').attr('disabled', false);
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        $('#btnEditSave').attr('disabled', false);
    });
});
