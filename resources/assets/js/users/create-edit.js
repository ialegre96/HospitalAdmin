'use strict';

$(document).ready(function () {

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

    $(document).on('submit', '#createUserForm, #editUserForm', function () {
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
            setTimeout(function () {
                $('#btnSave').removeAttr('disabled');
            }, 3000)
            return false;
        }
        let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
            ? true
            : false));
        if (!twitterCheck) {
            displayErrorMessage('Please enter a valid Twitter URL');
            setTimeout(function () {
                $('#btnSave').removeAttr('disabled');
            }, 3000)
            return false;
        }
        let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
            instagramUrlExp) ? true : false));
        if (!instagramCheck) {
            displayErrorMessage('Please enter a valid Instagram URL');
            setTimeout(function () {
                $('#btnSave').removeAttr('disabled');
            }, 3000)
            return false;
        }
        let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
            linkedInExp) ? true : false));
        if (!linkedInCheck) {
            displayErrorMessage('Please enter a valid Linkedin URL');
            setTimeout(function () {
                $('#btnSave').removeAttr('disabled');
            }, 3000)
            return false;
        }
    });

    $('#createUserForm, #editUserForm').
        on('keyup keypress', function (e) {
            let keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    $('#dob').flatpickr({
        maxDate: new Date(),
    });

    $(document).on('change', '#profileImage', function () {
        let extension = isValidDocument($(this), '#userValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#userValidationErrorsBox').html('').hide();
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
                    'The profile image must be a file of type: jpeg, jpg, png.').
                removeClass('display-none').show();

            setTimeout(function () {
                $(validationMessageSelector).slideUp(300);
            }, 5000);

            return false;
        }
        $(validationMessageSelector).addClass('display-none');

        return ext;
    };

    $(document).on('submit', '#createUserForm, #editUserForm', function () {
        $('#btnSave').attr('disabled', true);
    });

    $(document).on('click', '.remove-image', function () {
        defaultImagePreview('#previewImage', 1);
    });

    if ($('#role').val() == 2) {
        $('.doctor_department').removeClass('d-none');
        $('#doctorDepartmentId').attr('required');
    }

    $(document).on('change', '#role', function () {
        let role = $(this).val();
        if (role == 2) {
            $('.doctor_department').removeClass('d-none');
            $('#doctorDepartmentId').attr('required');
        } else {
            $('.doctor_department').addClass('d-none');
            $('#doctorDepartmentId').removeAttr('required');
        }
    });
});
