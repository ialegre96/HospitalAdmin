'use strict';

$(document).ready(function () {
    $('#chargeTypeId,#chargeCategoryId,#editChargeTypeId,#editChargeCategoryId,#chargeType').
        select2({
            width: '100%',
        });

    $('#addModal, #editModal').on('shown.bs.modal', function () {
        $('#chargeTypeId, #editChargeTypeId:first').focus();
    });

    window.changeChargeCategory = function (selector, id) {
        $.ajax({
            url: changeChargeTypeUrl,
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

    $('#editChargeTypeId').on('change', function () {
        changeChargeCategory('#editChargeCategoryId', $(this).val());
    });

    $(document).on('click', '.edit-btn', function (event) {
        if (ajaxCallIsRunning) {
            return;
        }
        ajaxCallInProgress();
        let chargeId = $(event.currentTarget).data('id');
        renderData(chargeId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: chargeUrl + '/' + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#chargeId').val(result.data.id);
                    $('#editChargeTypeId').
                        val(result.data.charge_type).
                        trigger('change.select2');
                    changeChargeCategory('#editChargeCategoryId',
                        result.data.charge_type);
                    $('#editCode').val(result.data.code);
                    $('#editDescription').val(result.data.description);
                    $('#editStdCharge').
                        val(addCommas(result.data.standard_charge));
                    setTimeout(function () {
                        $('#editChargeCategoryId').
                            val(result.data.charge_category_id).
                            trigger('change.select2');
                    }, 2000);
                    $('#editModal').modal('show');
                    ajaxCallCompleted();
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
        let id = $('#chargeId').val();
        $.ajax({
            url: chargeUrl + '/' + id,
            type: 'patch',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function (result) {
                UnprocessableInputError(result);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        $('#editChargeTypeId,#editChargeCategoryId').
            val('').
            trigger('change.select2');
    });
});
