'use strict';

$(document).ready(function () {
    // $('#bloodGroup').select2({
    //     width: '100%',
    // });
    $('#birthDate').flatpickr({
        maxDate: new Date(),
    });

    // $('#birthDate').datetimepicker(DatetimepickerDefaults({
    //     format: 'YYYY-MM-DD',
    //     useCurrent: true,
    //     sideBySide: true,
    //     maxDate: new Date(),
    // }));
    // $('#departmentId').select2({
    //     width: '100%',
    // });

    $(document).on('keyup', '#facebookUrl', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#twitterUrl', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#instagramUrl', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#linkedInUrl', function () {
        this.value = this.value.toLowerCase();
    });

    $(document).
        on('submit', '#createPatientForm, #editPatientForm', function () {
            if ($('#error-msg').text() !== '') {
                $('#phoneNumber').focus();
                return false;
            }

            let facebookUrl = $('#facebookUrl').val();
            let twitterUrl = $('#twitterUrl').val();
            let instagramUrl = $('#instagramUrl').val();
            let linkedInUrl = $('#linkedInUrl').val();

            let facebookExp = new RegExp(
                /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
            let twitterExp = new RegExp(
                /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
            let instagramUrlExp = new RegExp(
                /^(https?:\/\/)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i);
            let linkedInExp = new RegExp(
                /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

            let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
                facebookExp) ? true : false));
            if (!facebookCheck) {
                displayErrorMessage('Please enter a valid Facebook URL');
                return false;
            }
            let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
                ? true
                : false));
            if (!twitterCheck) {
                displayErrorMessage('Please enter a valid Twitter URL');
                return false;
            }
            let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
                instagramUrlExp) ? true : false));
            if (!instagramCheck) {
                displayErrorMessage('Please enter a valid Instagram URL');
                return false;
            }
            let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
                linkedInExp) ? true : false));
            if (!linkedInCheck) {
                displayErrorMessage('Please enter a valid Linkedin URL');
                return false;
            }

        });
    $('#createPatientForm, #editPatientForm').find('input:text:visible:first').focus();

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });
});
