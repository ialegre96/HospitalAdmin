'use strict';

$(document).ready(function () {
    $(document).
        on('submit', '#createCallLogForm, #editCallLogForm', function () {
            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                return false;
            }
        });

    $('#createCallLogForm, #editCallLogForm').on('keyup keypress', function (e) {
        let keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    let followUpDate = undefined;

    if (isEdit) {
        $('#date').flatpickr({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
            minDate: moment(new Date()).format('YYYY-MM-DD'),
            onChange: function (selectedDates, dateStr, instance) {
                let minDate = moment($('#date').val()).format();
                if (typeof followUpDate != "undefined") {
                    followUpDate.set('minDate', minDate)
                }
            }
        });
    } else {
        $('#date').flatpickr({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
            minDate: moment(new Date()).format('YYYY-MM-DD'),
            onChange: function (selectedDates, dateStr, instance) {
                let minDate = moment($('#date').val()).format();
                if (typeof followUpDate != "undefined") {
                    followUpDate.set('minDate', minDate)
                }
            }
        });
    }
    followUpDate = $('#followUpDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });
    let minDate = moment($('#date').val()).format();
    followUpDate.set('minDate', minDate);
    $(document).on('submit', '#createCallLogForm, #editCallLogForm', function () {
        $('#btnSave').attr('disabled', true);
    });
});
