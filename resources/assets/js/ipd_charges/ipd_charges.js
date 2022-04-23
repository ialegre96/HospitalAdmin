'use strict';

$(document).ready(function () {

    let tableName = '#tblIpdCharges';
    let tblIpdCharges = $('#tblIpdCharges').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'desc']],
        ajax: {
            url: ipdChargesUrl,
            data: function (data) {
                data.id = ipdPatientDepartmentId;
            },
        },
        columnDefs: [
            {
                'targets': [0, 1, 2, 3],
                'width': '15%',
            },
            {
                'targets': [4, 5],
                'className': 'text-right',
                'width': '15%',
            },
            {
                'targets': [6],
                'className': 'text-center text-nowrap',
                'orderable': false,
                'width': '4%',
                'visible': actionAcoumnVisibal,
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
                    return row;
                },
                render: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    if (row.charge_type_id === 1)
                        return 'Procedures';
                    else if (row.charge_type_id === 2)
                        return 'Investigations';
                    else if (row.charge_type_id === 3)
                        return 'Supplier';
                    else if (row.charge_type_id === 4)
                        return 'Operation Theatre';
                    else
                        return 'Others';
                },
                name: 'charge_type_id',
            },
            {
                data: 'chargecategory.name',
                name: 'chargecategory.name',
            },
            {
                data: 'charge.code',
                name: 'charge.code',
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
                    return !isEmpty(row.applied_charge)
                        ? '<p class="cur-margin">' +
                        getCurrentCurrencyClass() + ' ' +
                        addCommas(row.applied_charge) + '</p>'
                        : 'N/A';
                },
                name: 'applied_charge',
            },
            {
                data: function (row) {
                    let data = [{ 'id': row.id }];
                    return prepareTemplateRender(
                        '#ipdChargesActionTemplate',
                        data);
                }, name: 'id',
            },
        ],
    });
    searchDataTable(tblIpdCharges,'#search-table-3');

    function searchDataTable(tblIpdCharges, selector) {
        const filterSearch = document.querySelector(selector);
        filterSearch.addEventListener('keyup', function (e) {
            tblIpdCharges.search(e.target.value).draw();
        });
    }

    $('#btnIpdChargeSave,#btnEditCharges').prop('disabled', true);
    $('#ipdChargeDate, #ipdEditChargeDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: true,
        minDate: ipdPatientCaseDate,
    });
    $('#chargeTypeId, #chargeCategoryId, #chargeId').select2({
        dropdownParent: $('#addIpdChargesModal')
    });
    $('#editChargeTypeId, #editChargeCategoryId, #editChargeId').select2({
        dropdownParent: $('#editIpdChargesModal')
    });
    $(document).on('click', '.ipdCharegs-delete-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        let url = ipdChargesUrl + '/' + id;
        let header = 'IPD Charge';
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'swal2-confirm btn fw-bold btn-danger mt-0',
                cancelButton: 'swal2-cancel btn fw-bold btn-bg-light btn-color-primary mt-0'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Delete !',
            text: 'Are you sure want to delete this "' + header + '" ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (obj) {
                        if (obj.success) {
                            $(tableName).DataTable().ajax.reload(null, false);
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            confirmButtonColor: '#009ef7',
                            text: header + ' has been deleted.',
                            timer: 2000,
                        });
                    },
                    error: function (data) {
                        Swal.fire({
                            title: '',
                            text: data.responseJSON.message,
                            confirmButtonColor: '#009ef7',
                            icon: 'error',
                            timer: 5000,
                        })
                    },
                })
            }
        });
    });

    $('#chargeTypeId, #editChargeTypeId').on('change', function (e, onceOnEditRender) {
        let isChargeEdit = $(this).data('is-charge-edit');
        if ($(this).val() !== '') {
            $.ajax({
                url: chargeCategoryUrl,
                type: 'get',
                dataType: 'json',
                data: { id: $(this).val() },
                beforeSend: function () {
                    makeChargesBtnDisabled(isChargeEdit);
                },
                success: function (data) {
                    if (data.data.length !== 0) {
                        $((!isChargeEdit)
                            ? '#chargeCategoryId'
                            : '#editChargeCategoryId').empty();
                        $((!isChargeEdit)
                            ? '#chargeCategoryId'
                            : '#editChargeCategoryId').removeAttr('disabled');
                        $.each(data.data, function (i, v) {
                            $((!isChargeEdit)
                                ? '#chargeCategoryId'
                                : '#editChargeCategoryId').append($('<option></option>').attr('value', i).text(v));
                        });
                        if (!isChargeEdit)
                            $('#chargeCategoryId').trigger('change');
                        else {
                            if (typeof onceOnEditRender == 'undefined')
                                $('#editChargeCategoryId').trigger('change');
                            else {
                                $('#editChargeCategoryId').val(editChargeCategoryId).trigger('change', onceOnEditRender);
                            }
                        }
                        $((!isChargeEdit)
                            ? '#btnIpdChargeSave'
                            : '#btnEditCharges').prop('disabled', false);
                    } else {
                        $((!isChargeEdit)
                            ? '#chargeCategoryId, #chargeId'
                            : '#editChargeCategoryId, #editChargeId').empty();

                        resetSelect2ForCharges(isChargeEdit);
                        
                        $((!isChargeEdit)
                            ? '#ipdStandardCharge, #ipdAppliedCharge'
                            : '#editIpdStandardCharge, #editIpdAppliedCharge').
                            val('');
                        $((!isChargeEdit)
                            ? '#chargeCategoryId, #chargeId, #btnIpdChargeSave'
                            : '#editChargeCategoryId, #editChargeId, #btnEditCharges').
                            prop('disabled', true);
                    }
                },
            });
        }
        $((!isChargeEdit)
            ? '#chargeCategoryId, #chargeId'
            : '#editChargeCategoryId, #editChargeId').empty();
        $((!isChargeEdit)
            ? '#ipdStandardCharge, #ipdAppliedCharge'
            : '#editIpdStandardCharge, #editIpdAppliedCharge').val('');
        $((!isChargeEdit)
            ? '#chargeCategoryId, #chargeId'
            : '#editChargeCategoryId, #editChargeId').prop('disabled', true);
    });

    $('#chargeCategoryId, #editChargeCategoryId').on('change', function (e, onceOnEditRender) {
        let isChargeEdit = $(this).data('is-charge-edit');
        if ($(this).val() !== '') {
            $.ajax({
                url: chargeUrl,
                type: 'get',
                dataType: 'json',
                data: { id: $(this).val() },
                beforeSend: function () {
                    makeChargesBtnDisabled(isChargeEdit);
                },
                success: function (data) {
                    if (data.data.length !== 0) {
                        $((!isChargeEdit) ? '#chargeId' : '#editChargeId').empty();
                        $((!isChargeEdit) ? '#chargeId' : '#editChargeId').removeAttr('disabled');
                        $.each(data.data, function (i, v) {
                            $((!isChargeEdit)
                                ? '#chargeId'
                                : '#editChargeId').append($('<option></option>').attr('value', i).text(v));
                        });
                        if (!isChargeEdit)
                            $('#chargeId').trigger('change');
                        else {
                            if (typeof onceOnEditRender == 'undefined')
                                $('#editChargeId').trigger('change');
                            else
                                $('#editChargeId').val(editChargeId).trigger('change', onceOnEditRender);
                        }
                    } else {
                        $((!isChargeEdit) ? '#chargeId' : '#editChargeId').
                            prop('disabled', true);
                    }
                },
            });
        }
        $((!isChargeEdit) ? '#chargeId' : '#editChargeId').empty();
        $((!isChargeEdit) ? '#chargeId' : '#editChargeId').
            prop('disabled', true);
    });

    window.resetSelect2ForCharges = function (resetType) {
        if (!resetType) {
            $('#chargeCategoryId').select2({
                dropdownParent: $('#addIpdChargesModal'),
                placeholder: 'Select Charge Category',
            });
            $('#chargeId').select2({
                dropdownParent: $('#addIpdChargesModal'),
                placeholder: 'Select Code',
            });
        } else {
            $('#editChargeCategoryId').select2({
                dropdownParent: $('#editIpdChargesModal'),
                placeholder: 'Select Charge Category',
            });
            $('#editChargeId').select2({
                dropdownParent: $('#editIpdChargesModal'),
                placeholder: 'Select Code',
            });
            $('.applied_charge').addClass('d-none');
        }
    };

    $('#chargeId, #editChargeId').on('change', function (e, onceOnEditRender) {
        let isChargeEdit = $(this).data('is-charge-edit');
        $.ajax({
            url: chargeStandardRateUrl,
            type: 'get',
            dataType: 'json',
            data: {
                id: $(this).val(),
                isEdit: isChargeEdit,
                onceOnEditRender: onceOnEditRender,
                ipdChargeId: $('#ipdChargesId').val(),
            },
            beforeSend: function () {
                makeChargesBtnDisabled(isChargeEdit);
            },
            success: function (data) {
                if (!isChargeEdit) {
                    $('#ipdStandardCharge, #ipdAppliedCharge').val(data.data);
                    $('#btnIpdChargeSave').prop('disabled', false);
                } else {
                    if (data.data != null) {
                        $('#editIpdStandardCharge').val(data.data.standard_charge);
                        $('#editIpdAppliedCharge').val(data.data.applied_charge);
                        $('.price-input').trigger('input');
                        $('#btnEditCharges').prop('disabled', false);
                    }
                }

            },
        });
    });

    $(document).on('submit', '#addIpdChargeNewForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnIpdChargeSave');
        loadingButton.button('loading');

        var formData = new FormData($(this)[0]);
        $.ajax({
            url: ipdChargesCreateUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function success (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#addIpdChargesModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
            error: function error (result) {
                printErrorMessage('#ipdChargevalidationErrorsBox', result);
            },
            complete: function complete () {
                loadingButton.button('reset');
                $('#btnIpdChargeSave').attr('disabled', true);
            },
        });

    });

    $(document).on('click', '.edit-charges-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let ipdChargesId = $(event.currentTarget).data('id');
        renderChargesData(ipdChargesId);
    });

    let editChargeCategoryId = null;
    let editChargeId = null;
    let editStandardRate = null;
    let editAppliedCharge = null;
    window.renderChargesData = function (id) {
        $.ajax({
            url: ipdChargesUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    editChargeCategoryId = result.data.charge_category_id;
                    editChargeId = result.data.charge_id;
                    editStandardRate = result.data.standard_charge;
                    editAppliedCharge = result.data.applied_charge;
                    $('#ipdChargesId').val(result.data.id);
                    document.querySelector('#ipdEditChargeDate')._flatpickr.setDate(moment(result.data.date).format());
                    $('#editChargeTypeId').val(result.data.charge_type_id).trigger('change', [{onceOnEditRender: true}]);
                    $('.price-input').trigger('input');
                    $('.applied_charge').removeClass('d-none');
                    $('#appliedChargeId').text(editAppliedCharge);
                    $('#editIpdChargesModal').modal('show');
                    ajaxCallCompleted();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    };

    $(document).on('submit', '#editIpdChargesForm', function (event) {
        event.preventDefault();
        let loadingButton = jQuery(this).find('#btnEditCharges');
        loadingButton.button('loading');
        let id = $('#ipdChargesId').val();
        let url = ipdChargesUrl + '/' + id;
        let data = {
            'formSelector': $(this),
            'url': url,
            'type': 'POST',
            'tableSelector': tableName,
        };
        editRecord(data, loadingButton, '#editIpdChargesModal',
            '#btnEditCharges');
    });

    $('#addIpdChargesModal').on('hidden.bs.modal', function () {
        $('#addIpdChargeNewForm')[0].reset();
        $('#chargeTypeId, #chargeCategoryId, #chargeId, #ipdStandardCharge, #ipdAppliedCharge').val('');
        $('#chargeCategoryId, #chargeId').empty();
        $('#chargeCategoryId').append($('<option>Select Charge Category</option>'));
        $('#chargeId').append($('<option>Select Code</option>'));
        $('#chargeTypeId').trigger('change.select2');
        $('#btnIpdChargeSave').prop('disabled', true);
    });
    $('#editIpdChargesModal').on('hidden.bs.modal', function () {
        $('#btnEditCharges').prop('disabled', true);
    });
});

function deleteItemAjax (url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                location.reload();
            }
            swal({
                title: 'Deleted!',
                confirmButtonColor: '#009ef7',
                text: header + ' has been deleted.',
                type: 'success',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: '',
                text: data.responseJSON.message,
                type: 'error',
                timer: 5000,
            });
        },
    });
}

window.makeChargesBtnDisabled = function (isChargeOnEdit) {
    $((!isChargeOnEdit) ? '#btnIpdChargeSave' : '#btnEditCharges').
        prop('disabled', true);
};
