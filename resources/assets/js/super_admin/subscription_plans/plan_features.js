'use strict';

$(document).ready(function () {
    window.featureChecked = function (featureLength) {
        let totalFeature = $('.feature:checkbox').length;
        if (featureLength === totalFeature) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    };

    // features selection script - starts
    let featureLength = $('.feature:checkbox:checked').length;
    featureChecked(featureLength);

    // script for selecting all features
    $(document).on('click', '#selectAll', function () {
        if ($('#selectAll').is(':checked')) {
            $('.feature').each(function () {
                $(this).prop('checked', true);
            });
        } else {
            $('.feature').each(function () {
                $(this).prop('checked', false);
            });
        }
    });

    // script for selecting single feature
    $(document).on('click', '.feature', function () {
        let featureLength = $('.feature:checkbox:checked').length;
        featureChecked(featureLength);
    });
    // features selection script - ends
});
