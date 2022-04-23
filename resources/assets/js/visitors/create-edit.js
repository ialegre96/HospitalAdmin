'use strict';

$(document).ready(function () {
    $(document).
        on('submit', '#createVisitorForm, #editVisitorForm', function () {
            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                return false;
            }
        });

    $('#createVisitorForm, #editVisitorForm').on('keyup keypress', function (e) {
        let keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $('#date').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
    });

    $('#inTime,#outTime').flatpickr({
        enableTime: true,
        enableSeconds: true,
        noCalendar: true,
        dateFormat: 'H:i:S',
    });

    $('#outTime').flatpickr({
        enableTime: true,
        enableSeconds: true,
        noCalendar: true,
        dateFormat: 'H:i:S',
        minTime: moment(new Date()).format('HH:mm:ss'),
    });

    $('#inTime').on('dp.change', function (e) {
        $('#outTime').data('flatpickr').minTime(e.time);
    });

    $(document).ready(function () {
        $('#purpose').select2({
            width: '100%',
        });
    });

    $(document).on('change', '#attachment', function () {
        let extension = isValidDocument($(this), '#visitorValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#validationErrorsBox').html('').hide();
            displayDocument(this, '#previewImage', extension);
        }
    });

    window.isValidDocument = function (
        inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
            -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).
                html(
                    'The document must be a file of type: jpeg, jpg, png, pdf, doc, docx.').
                removeClass('display-none');

            return false;
        }
        $(validationMessageSelector).addClass('display-none');

        return ext;
    };

    $(document).on('submit', '#createVisitorForm, #editVisitorForm', function () {
        $('#btnSave').attr('disabled', true);
    });

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage');
    });
});
