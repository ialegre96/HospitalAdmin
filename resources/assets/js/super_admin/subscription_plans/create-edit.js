'use strict';

$(document).ready(function () {
    $('.price-input').trigger('input');

    $(window).on('beforeunload', function () {
        $('input[type=submit]').prop('disabled', 'disabled');
    });

    $('#createSubscriptionPlanForm, #editSubscriptionPlanForm').
        find('input:text:visible:first').
        focus();

    $(document).
        on('submit', '#createSubscriptionPlanForm, #editSubscriptionPlanForm',
            function () {
                $('#btnSave').attr('disabled', true);
            });
});
