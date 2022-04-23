'use strict';

$('input:text:not([readonly="readonly"])').first().blur();
$(document).ready(() => {
    $('#female,#male').attr('disabled', true);
    $('#patient_id,#patientAdmissionId').select2({
        width: '100%',
    });

    const dropdownToSelect2 = (selector) => {
        $(selector).select2({
            placeholder: 'Select Medicine',
            width: '100%',
        });
    };

    dropdownToSelect2('.accountId');

    $('#bill_date').flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    });

    $('#editBillDate').flatpickr({
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
    });

    $(document).on('click', '#addItem', function () {
        let data = {
            'medicines': associateMedicines,
            'uniqueId': uniqueId,
        };
        let invoiceItemHtml = prepareTemplateRender(
            '#billItemTemplate', data);
        $('.bill-item-container').append(invoiceItemHtml);
        dropdownToSelect2('.medicineId');
        uniqueId++;

        resetInvoiceItemIndex();
    });

    const resetInvoiceItemIndex = () => {
        let index = 1;
        $('.bill-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
        if (index - 1 == 0) {
            $('#billTbl tbody').append('<tr>' +
                '<td class="text-center item-number">1</td>' +
                '<td class="table__item-desc">' +
                '<input class="form-control itemName form-control-solid" required name="item_name[]" type="text"></td>' +
                '<td class="table__qty"><input class="form-control qty quantity form-control-solid" required name="qty[]" type="text"></td>' +
                '<td><input class="form-control price-input price form-control-solid" required name="price[]" type="text"></td>' +
                '<td class="amount text-right itemTotal"></td>' +
                '<td class="text-center"><i class="fa fa-trash text-danger delete-invoice-item pointer"></i></td>' +
                '</tr>');
        }
    };

    $(document).on('click', '.delete-invoice-item', function () {
        $(this).parents('tr').remove();
        resetInvoiceItemIndex();
        calculateAndSetInvoiceAmount();
    });

    const removeCommas = (str) => {
        return str.replace(/,/g, '');
    };

    $(document).on('keyup', '.qty', function () {
        let qty = parseInt($(this).val());
        let rate = $(this).parent().siblings().find('.price').val();
        rate = parseInt(removeCommas(rate));
        let amount = calculateAmount(qty, rate);
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()));
        calculateAndSetInvoiceAmount();
    });

    $(document).on('keyup', '.price', function () {
        let rate = $(this).val();
        rate = parseInt(removeCommas(rate));
        let qty = parseInt($(this).parent().siblings().find('.qty').val());
        let amount = calculateAmount(qty, rate);
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()));
        calculateAndSetInvoiceAmount();
    });

    const calculateAmount = (qty, rate) => {
        if (qty > 0 && rate > 0) {
            return qty * rate;
        } else {
            return 0;
        }
    };

    const calculateAndSetInvoiceAmount = () => {
        let totalAmount = 0;
        $('.bill-item-container>tr').each(function () {
            let itemTotal = $(this).find('.itemTotal').text();
            itemTotal = removeCommas(itemTotal);
            itemTotal = isEmpty($.trim(itemTotal)) ? 0 : parseInt(itemTotal);
            totalAmount += itemTotal;
        });
        totalAmount = parseFloat(totalAmount);

        $('#total').text(addCommas(totalAmount.toFixed(2)));

        //set hidden input value
        $('#totalAmount').val(totalAmount);
    };

    $(document).on('submit', '#billForm', function (event) {
        event.preventDefault();
        screenLock();
        $('#saveBtn').attr('disabled', true);
        let loadingButton = jQuery(this).find('#saveInvoiceBtn');
        loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: billSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = billUrl + '/' + result.data.id;
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
                $('#saveBtn').attr('disabled', false);
            },
            complete: function () {
                screenUnLock();
                loadingButton.button('reset');
            },
        });
    });

    // bill auto fill data script code
    $('#patientAdmissionId').on('change', function () {
        screenLock();
        var data;
        if($(this).val() != '' && $(this).val() != null){
            if (isEdit) {
                data = {
                    editBillId: billId,
                    patient_admission_id: $(this).val(),
                };
            } else {
                data = {
                    patient_admission_id: $(this).val(),
                };
            }
            $.ajax({
                url: patientAdmissionDetailUrl,
                type: 'GET',
                data: data,
                success: function (result) {
                    if (result.success) {
                        let patientAdmissionData = result.data;
                        $('#pAdmissionId').
                            val($('#patientAdmissionId').find(':selected').val());
                        $('#female,#male').attr('disabled', true);
                        $('#patientId').
                            val(patientAdmissionData.patientDetails.owner_id);
                        $('#name').
                            val(patientAdmissionData.patientDetails.full_name);
                        $('#userEmail').
                            val(patientAdmissionData.patientDetails.email);
                        $('#userPhone').
                            val((patientAdmissionData.patientDetails.phone != null)
                                ? patientAdmissionData.patientDetails.phone
                                : 'N/A');
                        if (patientAdmissionData.patientDetails.gender == 1)
                            $('#female').prop('checked', true);
                        else
                            $('#male').prop('checked', true);
                        $('#dob').
                            val((patientAdmissionData.patientDetails.dob != null)
                                ? patientAdmissionData.patientDetails.dob
                                : 'N/A');
                        $('#doctorId').val(patientAdmissionData.doctorName);
                        $('#admissionDate').
                            val(patientAdmissionData.admissionDetails.admission_date);
                        $('#dischargeDate').
                            val((patientAdmissionData.admissionDetails.discharge_date !=
                                null)
                                ? patientAdmissionData.admissionDetails.discharge_date
                                : 'N/A');
                        if ((patientAdmissionData.package) != '') {
                            $('#packageId').
                                val((patientAdmissionData.package.name !=
                                    null)
                                    ? patientAdmissionData.package.name
                                    : 'N/A');
                        } else {
                            $('#packageId').val('N/A');
                        }
                        if ((patientAdmissionData.admissionDetails.insurance) !=
                            null) {
                            $('#insuranceId').
                                val(patientAdmissionData.admissionDetails.insurance.name);
                        } else {
                            $('#insuranceId').val('N/A');
                        }
                        $('#totalDays').
                            val(patientAdmissionData.admissionDetails.totalDays);
                        $('#policyNo').
                            val((patientAdmissionData.admissionDetails.policy_no !=
                                '')
                                ? patientAdmissionData.admissionDetails.policy_no
                                : 'N/A');
                        if ((patientAdmissionData.package) != '' ||
                            (patientAdmissionData.package) == '' ||
                            (!patientAdmissionData.hasOwnProperty('billItems') ||
                                patientAdmissionData.hasOwnProperty('billItems') ||
                                patientAdmissionData.billItems.length <= 0 ||
                                patientAdmissionData.billItems.length >= 0)) {
                            $('.bill-item-container tr').
                                each(function () {
                                    let itemRow = $(this).closest('tr');
                                    itemRow.remove();
                                });
                            $('#total').text('0');
                            $('#billTbl tbody').append('<tr>' +
                                '<td class="text-center item-number">1</td>' +
                                '<td class="table__item-desc">' +
                                '<input class="form-control itemName form-control-solid" required name="item_name[]" type="text"></td>' +
                                '<td class="table__qty"><input class="form-control qty quantity form-control-solid" required name="qty[]" type="text"></td>' +
                                '<td><input class="form-control price-input price form-control-solid" required name="price[]" type="text"></td>' +
                                '<td class="amount text-right itemTotal"></td>' +
                                '<td class="text-center"><i class="fa fa-trash text-danger delete-invoice-item pointer"></i></td>' +
                                '</tr>');
                        }
                        if (patientAdmissionData.package != '' &&
                            patientAdmissionData.hasOwnProperty(
                                'billItems') &&
                            patientAdmissionData.billItems.length > 0) {

                            let totalBillItems = patientAdmissionData.billItems.length -
                                1;

                            $('#totalAmount').val(0);
                            let total = 0;
                            for (let i = 1; i <=
                            totalBillItems; i++) {
                                $('#addItem').trigger('click');
                            }
                            $('.bill-item-container tr').
                                each(function (index) {
                                    const itemRow = $(this);
                                    itemRow.find('.itemName').
                                        val(patientAdmissionData.billItems[index].item_name);
                                    itemRow.find('.quantity').
                                        val(patientAdmissionData.billItems[index].qty);
                                    itemRow.find('.price').
                                        val(patientAdmissionData.billItems[index].price);
                                    itemRow.find('.amount').
                                        text(
                                            patientAdmissionData.billItems[index].amount);
                                    total = total +
                                        parseInt(itemRow.find('.itemTotal').text());
                                    $('#total').text(total);
                                });

                            $('#totalAmount').val($('#total').text());
                            setTimeout(function () {
                                $('.price').trigger('keyup');
                            }, 500);

                        } else if ((patientAdmissionData.package) != '') {
                            if (patientAdmissionData.package.package_services_items.length >
                                0) {
                                let totalPackageServices = patientAdmissionData.package.package_services_items.length -
                                    1;

                                $('#totalAmount').val(0);
                                let total = 0;
                                for (let i = 1; i <=
                                totalPackageServices; i++) {
                                    $('#addItem').trigger('click');
                                }
                                $('.bill-item-container tr').
                                    each(function (index) {
                                        const itemRow = $(this);
                                        itemRow.find('.itemName').
                                            val(patientAdmissionData.package.package_services_items[index].service.name);
                                        itemRow.find('.quantity').
                                            val(patientAdmissionData.package.package_services_items[index].quantity);
                                        itemRow.find('.price').
                                            val(patientAdmissionData.package.package_services_items[index].rate);
                                        itemRow.find('.amount').
                                            text(
                                                patientAdmissionData.package.package_services_items[index].amount);
                                        total = total +
                                            parseInt(itemRow.find('.itemTotal').
                                                text());
                                        $('#total').text(total);
                                    });
                                $('#totalAmount').val($('#total').text());
                            }
                        } else if (patientAdmissionData.hasOwnProperty(
                                'billItems') && patientAdmissionData.billItems.length >
                            0) {
                            let totalBillItems = patientAdmissionData.billItems.length -
                                1;
                            $('#totalAmount').val(0);
                            let total = 0;
                            for (let i = 1; i <=
                            totalBillItems; i++) {
                                $('#addItem').trigger('click');
                            }
                            $('.bill-item-container tr').
                                each(function (index) {
                                    const itemRow = $(this);
                                    itemRow.find('.itemName').
                                        val(patientAdmissionData.billItems[index].item_name);
                                    itemRow.find('.quantity').
                                        val(patientAdmissionData.billItems[index].qty);
                                    itemRow.find('.price').
                                        val(patientAdmissionData.billItems[index].price);
                                    itemRow.find('.amount').
                                        text(
                                            patientAdmissionData.billItems[index].amount);
                                    total = total +
                                        parseInt(itemRow.find('.itemTotal').text());
                                    $('#total').text(total);
                                });
                            $('#totalAmount').val($('#total').text());
                        }
                    }
                },
                error: function (result) {
                    manageAjaxErrors(result);
                },
                complete: function (result) {
                    screenUnLock();
                },
            });
        }else {
            screenUnLock();
        }
    });
});
