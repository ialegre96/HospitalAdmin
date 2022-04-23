'use strict';

$(document).ready(function () {
    $('#itemCategory').select2({
        width: '100%',
    });

    $('#items').select2({
        width: '100%',
        placeholder: 'Select Item',
    });

    if (isEdit) {
        $('.price-input').trigger('input');
        setTimeout(function () {
            $('#itemCategory').trigger('change');
        }, 300);

        // changing the item stock attachment preview on edit item stock
        // const previewSrc = $('#previewImage').attr('src');
        // let ext = previewSrc.split('.').pop().toLowerCase();
        // if (ext == 'pdf') {
        //     $('#previewImage').attr('src', pdfDocumentImageUrl);
        // } else if ((ext == 'docx') || (ext == 'doc')) {
        //     $('#previewImage').
        //         attr('src', docxDocumentImageUrl);
        // }
    }

});

$('#itemCategory').on('change', function () {
    if ($(this).val() !== '') {
        $.ajax({
            url: itemsUrl,
            type: 'get',
            dataType: 'json',
            data: { id: $(this).val() },
            success: function (data) {
                if (data.data.length !== 0) {
                    $('#items').empty();
                    $('#items').removeAttr('disabled');
                    $.each(data.data, function (i, v) {
                        $('#items').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                    if (isEdit) {
                        $('#items').val(itemId).trigger('change.select2');
                        isEdit = false;
                    }
                } else
                    $('#items').prop('disabled', true);
            },
        });
    }
    $('#items').empty();
    $('#items').prop('disabled', true);
});

$(document).on('change', '#attachment', function () {
    let extension = isValidDocument($(this));
    if (!isEmpty(extension) && extension != false) {
        displayDocument(this, '#previewImage', extension);
    }
});

window.isValidDocument = function (inputSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx']) == -1) {
        $(inputSelector).val('');
        UnprocessableInputError('result');
        return false;
    }
    return ext;
};
$(document).on('click', '.remove-image', function () {
    defaultImagePreview('#previewImage');
});
