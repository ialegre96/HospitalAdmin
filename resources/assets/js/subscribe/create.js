'use strict';

$(document).ready(function () {
    $(document).on('click', function (event) {
            var target = $(event.target);
            var _mobileMenuOpen = $('.navbar-collapse').hasClass('show');
            if (_mobileMenuOpen === true && !target.hasClass('navbar-toggler')) {
                $('button.navbar-toggler').click();
            }
        },
    );
});

$(document).on('submit', '#mc-form', function (e) {
    e.preventDefault();
    $('.ajax-message').css('display', 'block');
    let loadingButton = jQuery(this).find('#subscribeBtn');
    loadingButton.button('loading');
    $.ajax({
        url: route('subscribe.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $('.ajax-message').
                    html('<div class="gen alert alert-success">' +
                        result.message + '</div>').
                    delay(5000).
                    hide('slow');
                $('#mc-form')[0].reset();
            }
        },
        error: function (result) {
            $('.ajax-message').
                html('<div class="err alert alert-danger">' +
                    result.responseJSON.message + '</div>').
                delay(5000).
                hide('slow');
            $('#mc-form')[0].reset();
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});
