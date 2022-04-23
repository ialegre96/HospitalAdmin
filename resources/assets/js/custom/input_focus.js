'use strict';

$('.image__file-upload').on('focus', function () {
    $('.image__file-upload').on('keypress', function (e) {
        if (e.keyCode === 13) {
            $('#profileImage').trigger('click');
        }
    });
});

$('.switch-label').on('focus', function () {
    $('.switch-label').on('keypress', function (e) {
        if (e.keyCode === 13) {
            $('.switch-input').trigger('click');
        }
    });
});