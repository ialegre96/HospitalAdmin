'use strict';

$(document).ready(function () {
    $('.price-input').trigger('input');
    $('#categoryName,#chargeCategory').select2({
        width: '100%',
    });
});

$('#createPathologyTest, #editPathologyTest').
    find('input:text:visible:first').
    focus();

$(document).on('change', '#chargeCategory', function (event) {
    let chargeCategoryId = $(this).val();
    (chargeCategoryId !== '') ? getStandardCharge(chargeCategoryId) : $(
        '#standardCharge').val('');
});

window.getStandardCharge = function (id) {
    $.ajax({
        url: pathologyTestUrl + '/get-standard-charge' + '/' + id,
        method: 'get',
        cache: false,
        success: function (result) {
            if (result !== '') {
                $('#standardCharge').val(result.data);
                $('.price-input').trigger('input');
            }
        },
    });
};
