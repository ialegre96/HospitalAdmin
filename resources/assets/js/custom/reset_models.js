'use strict';

$('#AddModal').on('hidden.bs.modal', function () {
    $('.preview-image').prop('src', defaultImageUrl);
    $('.select2-dd').val('').trigger('change.select2');
    resetModalForm('#addNewForm', '#validationErrorsBox');
});
$('#EditModal').on('hidden.bs.modal', function () {
    $('.preview-image').prop('src', defaultImageUrl);
    $('.select2-dd').val('').trigger('change.select2');
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
