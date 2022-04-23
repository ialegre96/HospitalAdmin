'use strict';

$(document).ready(function () {
    $('.price-input').trigger('input');

    if (discount < 0) {
        $('.discount').val(0);
    }
    $(document).on('blur', '#discountId', function () {
        if ($('#discountId').val().length == 0) {
            $('#discountId').val(0);
        }
    });

    $('#insuranceForm').find('input:text:visible:first').focus();

    window.isNumberKey = (evt, element) => {
        let charCode = (evt.which) ? evt.which : event.keyCode;

        return !((charCode !== 46 || $(element).val().indexOf('.') !== -1) &&
            (charCode < 48 || charCode > 57));
    };

    $(document).on('click', '#addItem', function () {
        let data = {
            'uniqueId': uniqueId,
        };
        let diseaseItemHtml = prepareTemplateRender(
            '#insuranceDiseaseTemplate', data);
        $('.disease-item-container').append(diseaseItemHtml);
        uniqueId++;

        resetInvoiceItemIndex();
    });

    $(document).on('click', '.delete-disease', function () {
        $(this).parents('tr').remove();
        resetInvoiceItemIndex();
        calculateAndSetInvoiceAmount();
    });

    function resetInvoiceItemIndex () {
        let index = 1;
        $('.disease-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
        if (index - 1 == 0) {
            $('#total').text('0');
            $('#billTbl tbody').append('<tr>' +
                '<td class="text-center item-number">1</td>' +
                '<td><input class="form-control form-control-solid disease-name" required name="disease_name[]" type="text"></td>' +
                '<td><input class="form-control disease-charge price-input form-control-solid" required name="disease_charge[]" type="text"></td>' +
                '<td class="text-center"><a href="#" title="{{__(\'messages.common.delete\')}}"  class="delete-btn delete-disease pointer btn btn-icon btn-bg-light btn-active-color-danger btn-sm">\n' +
                '                    <span class="svg-icon svg-icon-3">\n' +
                '                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"\n' +
                '                             version="1.1">\n' +
                '                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                '                        <rect x="0" y="0" width="24" height="24" />\n' +
                '                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />\n' +
                '                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" /></g></svg></span>\n' +
                '                            </a></td>' +
                '</tr>');
        }
    }

    $(document).
        on('change', '.service-tax, .discount, .hospital-rate, .disease-charge',
            function () {
                calculateAndSetInvoiceAmount();
            });

    window.calculateAndSetInvoiceAmount = function () {
        let totalAmount = 0;
        let serviceTax = parseInt(
            $('.service-tax').val() !== '' ? removeCommas(
                $('.service-tax').val()) : 0);
        let hospitalRate = parseInt(
            $('.hospital-rate').val() !== '' ? removeCommas(
                $('.hospital-rate').val()) : 0);
        let discount = parseFloat($('.discount').val());
        totalAmount = serviceTax + hospitalRate;
        $('.disease-item-container>tr').each(function () {
            let itemTotal = parseInt(
                $(this).find('.disease-charge').val() != '' ? removeCommas(
                    $(this).find('.disease-charge').val()) : 0);
            totalAmount += itemTotal;
        });
        totalAmount -= (totalAmount * discount / 100);

        $('#total').text(addCommas(totalAmount.toFixed(2)));
        $('#total_amount').val(totalAmount);
    };

    $(document).on('submit', '#insuranceForm', function (event) {
        event.preventDefault();
        screenLock();
        $('#saveBtn').attr('disabled', true);
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: insuranceSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = insuranceUrl;
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
