'use strict';

$(document).ready(() => {
    let qtyEle = $('#qty');
    qtyEle.blur(() => {
        if (qtyEle.val() < 0) {
            qtyEle.val(0);
        }
    });

    $('#brandId,#categoryId').select2({
        width: '100%',
    });

    $('#medicineNameId').focus();

    $('#createMedicine, #editMedicine').on('submit', function () {
        $('#saveBtn').attr('disabled', true);
    });
});
