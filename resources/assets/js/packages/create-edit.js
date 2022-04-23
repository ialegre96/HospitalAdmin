'use strict';

$(document).ready(function () {
    const dropdownToSelecte2 = (selector) => {
        $(selector).select2({
            placeholder: 'Select Service',
            width: '100%',
        });
    };

    $('#packageForm').find('input:text:visible:first').focus();

    dropdownToSelecte2('.serviceId');

    $(document).on('click', '#addItem', function () {
        let data = {
            'services': associateServices,
            'uniqueId': uniqueId,
        };
        let packageServiceItemHtml = prepareTemplateRender(
            '#packageServiceTemplate', data);
        $('.package-service-item-container').append(packageServiceItemHtml);
        dropdownToSelecte2('.serviceId');
        uniqueId++;

        resetServicePackageItemIndex();
    });

    const resetServicePackageItemIndex = () => {
        let index = 1;
        $('.package-service-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
        if (index - 1 == 0) {
            let data = {
                'services': associateServices,
                'uniqueId': uniqueId,
            };
            let packageServiceItemHtml = prepareTemplateRender(
                '#packageServiceTemplate', data);
            $('.package-service-item-container').append(packageServiceItemHtml);
            dropdownToSelecte2('.serviceId');
            uniqueId++;
        }
    };

    $(document).on('click', '.delete-service-package-item', function () {
        $(this).parents('tr').remove();
        resetServicePackageItemIndex();
        calculateAndSetTotalAmount();
    });

    const removeCommas = (str) => {
        return str.replace(/,/g, '');
    };

    window.isNumberKey = (evt, element) => {
        let charCode = (evt.which) ? evt.which : event.keyCode;

        return !((charCode !== 46 || $(element).val().indexOf('.') !== -1) &&
            (charCode < 48 || charCode > 57));
    };

    $(document).on('keyup', '.qty', function () {
        let qty = parseInt($(this).val());
        let rate = $(this).parent().siblings().find('.price').val();
        rate = parseInt(removeCommas(rate));
        let amount = calculateAmount(qty, rate);
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()));
        calculateAndSetTotalAmount();
    });

    $(document).on('keyup', '.price', function () {
        let rate = $(this).val();
        rate = parseInt(removeCommas(rate));
        let qty = parseInt($(this).parent().siblings().find('.qty').val());
        let amount = calculateAmount(qty, rate);
        $(this).parent().siblings('.amount').text(addCommas(amount.toString()));
        calculateAndSetTotalAmount();
    });

    $(document).on('keyup', '.discount', function () {
        calculateAndSetTotalAmount();
    });

    const calculateAmount = (qty, rate) => {
        if (qty > 0 && rate > 0) {
            return qty * rate;
        } else {
            return 0;
        }
    };

    const calculateAndSetTotalAmount = () => {
        let totalAmount = 0;
        let discount = parseFloat(
            $('.discount').val() !== '' ? $('.discount').val() : 0);
        $('.package-service-item-container>tr').each(function () {
            let itemTotal = $(this).find('.item-total').text();
            itemTotal = removeCommas(itemTotal);
            itemTotal = isEmpty($.trim(itemTotal)) ? 0 : parseInt(itemTotal);
            totalAmount += itemTotal;
        });
        totalAmount = parseFloat(totalAmount);
        totalAmount -= (totalAmount * discount / 100);
        $('#total').text(addCommas(totalAmount.toFixed(2)));

        //set hidden input value
        $('#total_amount').val(totalAmount);
    };

    $(document).on('submit', '#packageForm', function (event) {
        event.preventDefault();
        screenLock();
        $('#saveBtn').attr('disabled', true);
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: packageSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = packageUrl;
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
});
