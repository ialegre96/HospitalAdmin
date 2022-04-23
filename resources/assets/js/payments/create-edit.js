'use strict';

$(document).ready(function () {
    $('#paymentDate').flatpickr({
        dateFormat: 'Y-m-d',
    });

    $('select').focus();

    $('.price-input').trigger('input');
});
