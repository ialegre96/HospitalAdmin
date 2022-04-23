'use strict';

$(document).ready(function () {

    let tableName = '#AdminTestimonialTbl';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: route('admin-testimonial.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'orderable': false,
                'className': 'text-center',
                'width': '8%',
            },
            {
                'targets': [1, 2],
                'width': '20%',
            },
            {
                'targets': [3],
                'className': 'text-wrap',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-nowrap',
                'width': '8%',
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
                'className': 'text-start align-middle text-nowrap',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<img src="${row.image_url}" class="user-img image-stretching">`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return `<a href="javascript:void(0)" class="show-btn" data-id='${row.id}'>${row.name}</a>`;
                },
                name: 'name',
            },
            {
                data: 'position',
                name: 'position',
            },
            {
                data: 'description',
                name: 'description',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];
                    return prepareTemplateRender('#adminTestimonialTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });

    handleSearchDatatable(tbl);
});

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    let formData = new FormData($(this)[0]);
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: route('admin-testimonial.store'),
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function success (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#AdminTestimonialTbl').DataTable().ajax.reload(null, false);
                $('#btnSave').attr('disabled', false);
            }
        },
        error: function error (result) {
            printErrorMessage('#validationErrorsBox', result);
            $('#btnSave').attr('disabled', false);
        },
        complete: function complete () {
            loadingButton.button('reset');
        },
    });

});

$(document).on('click', '.show-btn', function () {
    let id = $(this).attr('data-id');
    $.ajax({
        url: route('admin-testimonial.show', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.image_url.split('.').
                    pop().
                    toLowerCase();
                if (ext == '') {
                    $('#showPreviewImage').
                        css('background-image',
                            'url("' + result.data.image_url + '")');
                } else {
                    $('#showPreviewImage').
                        css('background-image',
                            'url("' + result.data.image_url + '")');
                }
                $('.show-name').text(result.data.name);
                $('.show-position').text(result.data.position);
                $('.show-description').text(result.data.description);
                if (isEmpty(result.data.document_url)) {
                    $('#documentUrl').hide();
                    $('.btn-view').hide();
                } else {
                    $('#documentUrl').show();
                    $('.btn-view').show();
                    $('#documentUrl').attr('href', result.data.document_url);
                }
                $('#showModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});
//
$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let testimonialId = $(event.currentTarget).data('id');
    renderData(testimonialId);
});
//
window.renderData = function (id) {
    $.ajax({
        url: route('admin-testimonial.edit', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let ext = result.data.image_url.split('.').
                    pop().
                    toLowerCase();
                if (ext == '') {
                    $('#editPreviewImage').
                        css('background-image',
                            'url("' + result.data.image_url + '")');
                } else {
                    $('#editPreviewImage').
                        css('background-image',
                            'url("' + result.data.image_url + '")');
                }
                $('#testimonialId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editPosition').val(result.data.position);
                $('#editDescription').val(result.data.description);
                if (isEmpty(result.data.document_url)) {
                    $('#documentUrl').hide();
                    $('.btn-view').hide();
                } else {
                    $('#documentUrl').show();
                    $('.btn-view').show();
                    $('#documentUrl').attr('href', result.data.document_url);
                }
                $('#editModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};
//
$('.description').on('keyup', function () {
    $('.description').attr('maxlength', 150);
});
$('.description').attr('maxlength', 150);

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $('#btnEditSave').attr('disabled', true);
    let id = $('#testimonialId').val();
    let formData = new FormData($(this)[0]);
    $.ajax({
        url: route('admin-testimonial.update', id),
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $('#AdminTestimonialTbl').DataTable().ajax.reload(null, false);
                $('#btnEditSave').attr('disabled', false);
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
            $('#btnEditSave').attr('disabled', false);
        },
        complete: function () {
            loadingButton.button('reset');
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#addModal #validationErrorsBox');
    $('#previewImage').
        attr('src', defaultDocumentImageUrl).
        css('background-image', `url(${defaultDocumentImageUrl})`);
    $('#btnSave').attr('disabled', false);
});

$('#addModal').on('shown.bs.modal', function () {
    $('#addModal #validationErrorsBox').show();
    $('#addModal #validationErrorsBox').addClass('d-none');
});
//
$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editModal #editValidationErrorsBox');
    $('#previewImage').
        attr('src', defaultDocumentImageUrl).
        css('background-image', `url(${defaultDocumentImageUrl})`);
    $('#btnEditSave').attr('disabled', false);
});
//
$('#editModal').on('shown.bs.modal', function () {
    $('#editModal #editValidationErrorsBox').show();
    $('#editModal #editValidationErrorsBox').addClass('d-none');
});

$(document).on('click', '.delete-btn', function (event) {
    let testimonialId = $(event.currentTarget).data('id');
    deleteItem(route('admin-testimonial.destroy', testimonialId),
        $('#AdminTestimonialTbl'), 'Testimonial');
});
//
$(document).on('change', '#profile', function () {
    let extension = isValidDocument($(this), '#addModal #validationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        displayDocument(this, '#previewImage', extension);
    }
});

$(document).on('change', '#editProfile', function () {
    let extension = isValidDocument($(this),
        '#editModal #editValidationErrorsBox');
    if (!isEmpty(extension) && extension != false) {
        displayDocument(this, '#editPreviewImage', extension);
    }
});

window.isValidDocument = function (
    inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) ==
        -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).
            html(profileError).
            removeClass('d-none');
        return false;
    }
    $(validationMessageSelector).
        html(profileError).
        addClass('d-none');
    return ext;
};
