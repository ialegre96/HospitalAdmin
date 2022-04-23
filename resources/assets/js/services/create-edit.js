'use strict';

$(document).ready(function () {
    $('#status').select2({
        width: '100%',
    });

    $('.price-input').trigger('input');

    $(window).on('beforeunload', function () {
        $('input[type=submit]').prop('disabled', 'disabled');
    });

    $('#createServiceForm, #editServiceForm').
        find('input:text:visible:first').
        focus();

    $(document).
        on('submit', '#createServiceForm, #editServiceForm', function () {
            $('#btnSave').attr('disabled', true);
        });
});
