'use strict';

$(document).ready(function () {
    $('#itemCategory, #userType').select2({
        width: '100%',
    });
    $('#issueTo').select2({
        placeholder: 'Select User',
        width: '100%',
    });
    $('#items').select2({
        placeholder: 'Select Item',
        width: '100%',
    });

    let returnDate = $('#returnDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: true,
    });
    
    $('#issueDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        onChange: function(selectedDates, dateStr, instance) {
            let minDate = moment($('#issueDate').val()).add(1, 'days').format();
            returnDate.set('minDate', minDate);
        }
    });

    $('#issueDate').on('dp.change', function (e) {
        let minDate = moment($('#issueDate').val()).add(1, 'days');
        $('#returnDate').data('DateTimePicker').minDate(minDate);
    });

    setTimeout(function () {
        $('#itemCategory, #userType').trigger('change');
    }, 300);
});

$('#itemCategory').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: itemsUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#items').empty();
                    $('#items').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#items').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                    $('#items').trigger('change');
                } else {
                    $('#items').prop('disabled', true);
                    $('#quantity').prop('disabled', true);
                    $('#quantity').val('');
                    $('#showAvailableQuantity').text('0');
                    $('#availableQuantity').val(0);
                }
            },
        });
    }
    $('#items').empty();
    $('#items').prop('disabled', true);
});

$('#userType').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: usersUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#issueTo').empty();
                    $('#issueTo').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#issueTo').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                } else
                    $('#issueTo').prop('disabled', true);
            },
        });
    }
    $('#issueTo').empty();
    $('#issueTo').prop('disabled', true);
});

$('#items').on('change', function () {
    $.ajax({
        url: itemAvailableQtyUrl,
        type: 'get',
        dataType: 'json',
        data: { id: $(this).val() },
        success: function (data) {
            $('#availableQuantity').val(data);
            $('#showAvailableQuantity').text(data);
            $('#quantity').attr('max', data);
            $('#quantity').attr('disabled', false);
        },
    });
});

$('#quantity').on('change', function () {
    let availableQuantity = parseInt($('#availableQuantity').val());
    let quantity = parseInt($(this).val());
    if (quantity <= availableQuantity) {
        $('#btnSave').prop('disabled', false);
    } else if (quantity === 0)
        showError('Quantity cannot be zero.');
    else
        showError('Quantity must be less than Available quantity.');
});

window.showError = function (message) {
    // $.toast({
    //     heading: 'Error',
    //     text: message,
    //     showHideTransition: 'fade',
    //     icon: 'error',
    //     position: 'top-right',
    // });
    toastr.error(message);
    $('#btnSave').prop('disabled', true);
};

$(document).
    on('submit', '#createIssuedItemForm, #editIssuedItemForm', function () {
        $('#btnSave').attr('disabled', true);
    });
