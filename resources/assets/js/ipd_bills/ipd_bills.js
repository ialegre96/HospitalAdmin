'use strict';

let totalCharges = 0;
let totalPayments = 0;
let grossTotal = 0;
let discountPercent = 0;
let taxPercentage = 0;
let otherCharges = 0;
let netPayabelAmount = 0;
let totalDiscount = 0;
let totalTax = 0;

$(document).ready(function () {
    if (billstaus == 1) {
        $(' #discountPercent, #taxPercentage,#otherCharges ').
            prop('disabled', true);
    }
    calculateIpdBill();
    if (grossTotal <= 0) {
        $('#grossTotal').text(0);
        $(' #discountPercent, #taxPercentage,#otherCharges ').
            prop('disabled', true);
    }
});
$(' #discountPercent, #taxPercentage, #otherCharges').
    on('keyup', function () {
        if (this.id == 'discountPercent' || this.id == 'taxPercentage') {
            if (parseInt(removeCommas($(this).val())) > 100) {
                $(this).val(100);
            }
        }
        calculateIpdBill();
    });
$(document).on('submit', '#ipdBillForm', function (e) {
    e.preventDefault();
    $(' #discountPercent, #taxPercentage,#otherCharges').
        prop('disabled', false);
    screenLock();
    $('#saveIpdBillbtn').attr('disabled', true);
    let loadingButton = jQuery(this).find('#saveIpdBillbtn');
    loadingButton.button('loading');

    calculateIpdBill();
    let formData = new FormData($(this)[0]);
    formData.append('total_charges', totalCharges);
    formData.append('total_payments', totalPayments);
    formData.append('gross_total', grossTotal);
    formData.append('net_payable_amount', netPayabelAmount);

    $.ajax({
        url: ipdBillSaveUrl,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            window.location.reload();
        },
        error: function (result) {
            UnprocessableInputError(result);
            $('#saveIpdBillbtn').attr('disabled', false);
        },
        complete: function () {
            screenUnLock();
            loadingButton.button('reset');
        },
    });

});
window.calculateIpdBill = function () {

    totalCharges = parseInt(removeCommas($('#totalCharges').text()));
    totalPayments = parseInt(removeCommas($('#totalPayments').text()));
    grossTotal = parseInt(removeCommas($('#grossTotal').text()));

    discountPercent = parseInt(removeCommas($('#discountPercent').val()));
    taxPercentage = parseInt(removeCommas($('#taxPercentage').val()));
    otherCharges = parseInt(removeCommas($('#otherCharges').val()));

    discountPercent = (isNaN(discountPercent)) ? 0 : discountPercent;
    taxPercentage = (isNaN(taxPercentage)) ? 0 : taxPercentage;
    otherCharges = (isNaN(otherCharges)) ? 0 : otherCharges;

    //calculate
    let total = totalCharges - (totalPayments - otherCharges);
    totalDiscount = percentage(discountPercent, totalCharges);
    totalTax = percentage(taxPercentage, totalCharges);

    netPayabelAmount = (totalCharges + otherCharges + totalTax) -
        (totalPayments + totalDiscount);
    if (netPayabelAmount > 0)
        $('#billStatus').html('Unpaid');
    else {
        netPayabelAmount = 0;
        $('#billStatus').html('Paid');

    }
    $('#netPayabelAmount').text(addCommas(netPayabelAmount));
};
window.percentage = function (percent, total) {
    return ((percent / 100) * total);
};
