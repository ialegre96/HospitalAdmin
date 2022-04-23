"use strict";

$(document).ready(function () {
    $('#subscriptionStatus').select2();

    $('#endsAt').flatpickr({
        dateFormat: 'Y-m-d H:i',
        defaultDate: editEndAt,
        minDate: editEndAt,
        enableTime: true,
    });

    $(document).on('submit', '#editSubscription', function () {
        $('#btnSave').attr('disabled', true);
    });
});
