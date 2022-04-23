'use strict';

$(document).on('submit', '#editProfileForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnPrEditSave');
    loadingButton.button('loading');
    $.ajax({
        url: profileUpdateUrl,
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            $('#editProfileModal').modal('hide');
            setTimeout(function () {
                location.reload();
            },2000);
        },
        error: function (result) {
            manageAjaxErrors(result, 'editProfileValidationErrorsBox');
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('submit', '#changeLanguageForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnLanguageChange');
    loadingButton.button('loading');
    $.ajax({
        url: updateLanguageURL,
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                location.reload();
            },2000);
        },
        error: function (result) {
            manageAjaxErrors(result, 'editProfileValidationErrorsBox');
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$(document).on('submit', '#changePasswordForm', function (event) {
    event.preventDefault();
    let isValidate = validatePassword();
    if (!isValidate) {
        return false;
    }
    let loadingButton = jQuery(this).find('#btnPrPasswordEditSave');
    loadingButton.button('loading');
    $.ajax({
        url: changePasswordUrl,
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                $('#changePasswordModal').modal('hide');
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#editProfileModal').on('hidden.bs.modal', function () {
    resetModalForm('#editProfileForm', '#editProfileValidationErrorsBox');
});

// open edit user profile model
$(document).on('click', '.editProfile', function (event) {
    let userId = $(event.currentTarget).data('id');
    renderProfileData();
});
$(document).on('change', '#profileImage', function () {
    let ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(this).val('');
        $('#editProfileValidationErrorsBox').
            html('The profile image must be a file of type: jpeg, jpg, png.').
            show();
    } else {
        displayPhoto(this, '#editPhoto');
    }
});

window.renderProfileData = function () {
    $.ajax({
        url: profileUrl,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let user = result.data;
                $('#editUserId').val(user.id);
                $('#firstName').val(user.first_name);
                $('#lastName').val(user.last_name);
                $('#email').val(user.email);
                $('#phone').val(user.phone);
                // $('#editPhoto').attr('src', user.image_url);
                $('#editPhoto').css('background-image', 'url("' + user.image_url + '")');
                $('#editProfileModal').modal('show');
            }
        },
    });
};
window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

$(document).on('click', '.changeType', function (e) {
    let inputField = $(this).parent().siblings();
    let oldType = inputField.attr('type');
    if (oldType == 'password') {
        $(this).children().addClass('icon-eye');
        $(this).children().removeClass('icon-ban');
        inputField.attr('type', 'text');
    } else {
        $(this).children().removeClass('icon-eye');
        $(this).children().addClass('icon-ban');
        inputField.attr('type', 'password');
    }
});

$('#changePasswordModal').on('hidden.bs.modal', function () {
    resetModalForm('#changePasswordForm', '#editPasswordValidationErrorsBox');
});

$('#changeLanguageModal').on('hidden.bs.modal', function () {
    $('#language').val(userCurrentLanguage).trigger('change.select2');
});

function validatePassword () {
    let currentPassword = $('#pfCurrentPassword').val().trim();
    let password = $('#pfNewPassword').val().trim();
    let confirmPassword = $('#pfNewConfirmPassword').val().trim();

    if (currentPassword == '' || password == '' || confirmPassword == '') {
        $('#editPasswordValidationErrorsBox').show().html('Please fill all the required fields.');
        return false;
    }
    return true;
}

$(document).on('click', '.remove-profile-image', function () {
    $('#empty-image').addClass('image-input-empty');
    defaultImagePreview('#editPhoto', 1);
});

// $('#language').select2({
//     width: '100%'
// });
