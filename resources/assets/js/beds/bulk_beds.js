'use strict';

$(document).ready(() => {

    const dropdownToSelect2 = (selector) => {
        $(selector).select2({
            placeholder: 'Select Bed Type',
            width: '100%',
        });
    };

    dropdownToSelect2('#bedType');

    $(document).on('click', '#addItem', function () {
        let data = {
            'bedTypes': bedTypes,
            'uniqueId': uniqueId,
        };
        let bulkBedItemHtml = prepareTemplateRender(
            '#bulkBedActionTemplate', data);
        $('.bulk-beds-item-container').append(bulkBedItemHtml);
        dropdownToSelect2('.bedType');
        uniqueId++;

        resetBulkBedItemIndex();
    });

    const resetBulkBedItemIndex = () => {
        let index = 1;
        $('.bulk-beds-item-container>tr').each(function () {
            $(this).find('.item-number').text(index);
            index++;
        });
        if (index - 1 == 0) {
            let data = {
                'services': bedTypes,
                'uniqueId': uniqueId,
            };
            let bulkBedItemHtml = prepareTemplateRender(
                '#bulkBedActionTemplate', data);
            $('.bulk-beds-item-container').append(bulkBedItemHtml);
            dropdownToSelect2('.bedType');
            uniqueId++;
        }
    };

    $(document).on('click', '.delete-invoice-item', function () {
        $(this).parents('tr').remove();
        resetBulkBedItemIndex();
    });

    $(document).on('submit', '#bulkBedsForm', function (event) {
        event.preventDefault();
        screenLock();
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: bulkBedSaveUrl,
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                displaySuccessMessage(result.message);
                window.location.href = bedUrl;
            },
            error: function (result) {
                printErrorMessage('#validationErrorsBox', result);
            },
            complete: function () {
                screenUnLock();
            },
        });
    });
});
