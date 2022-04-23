'use strict';

$(document).ready(function () {

    $(document).on('submit', '#createUserForm', function (e) {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
    });

    $(document).on('submit', '#createUserForm, #editUserForm', function () {
        $('#btnSave').attr('disabled', true);
    });
});
