'use strict';

$(document).ready(function () {
    $(document).on('submit', '#createBrandForm, #editBrandForm', function () {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
    });

});
