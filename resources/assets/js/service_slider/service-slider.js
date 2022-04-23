'use strict';

$(document).ready(function () {
    let tableName = '#serviceSliderTable';
    let tbl = $(tableName).DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'asc']],
        ajax: {
            url: route('service-slider.index'),
        },
        columnDefs: [
            {
                'targets': [1],
                'orderable': false,
                'searchable': false,
                'className': 'text-center',
                'width': '8%',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<div class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <div>
                                <img src="${row.image_url}" alt="" class="user-img">
                            </div>
                        </div>
                    </div>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];
                    return prepareTemplateRender('#serviceSliderTemplate',
                        data);
                },
                name: 'id',
            },
        ],
    });
    handleSearchDatatable(tbl);

    // $(document).on('change', '#documentImage',function () {
    //     filename = $(this).val();
    // });

    $('#createModal').on('hidden.bs.modal', function () {
        // filename = null;
        $('#inputImage').removeClass('image-input-changed');
        $('#serviceImage').val('');
        $('#previewImage').
            css('background-image', 'url(' + defaultDocumentImageUrl + ')');
        $('#testimonialSaveBtn').attr('disabled', false);
    });

    $('#editModal').on('hidden.bs.modal', function () {
        // filename = null;
        $('#editInputImage').removeClass('image-input-changed');
        $('#serviceImage').val('');
        $('#btnEditSave').attr('disabled', false);
    });

    $(document).on('submit', '#serviceSliderForm', function (e) {
        e.preventDefault();

        // let loadingButton = jQuery(this).find('#testimonialSaveBtn');
        // loadingButton.button('loading');
        $('#testimonialSaveBtn').attr('disabled', true);
        $.ajax({
            url: route('service-slider.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#createModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                    $('#testimonialSaveBtn').attr('disabled', false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
                $('#testimonialSaveBtn').attr('disabled', false);
            },
            complete: function () {
                // loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('service-slider.edit', id),
            type: 'GET',
            success: function (result) {
                $('#serviceId').val(result.data.id);
                $('#editDocumentImage').attr('src', result.data.image_url);
                $('#previewEditImage').
                    css('background-image',
                        'url("' + result.data.image_url + '")');
                $('#editModal').modal('show');
            },
        });
    }

    // var filename;
    $(document).on('change', '#serviceImage', function () {
        let extension = isValidFile($(this), '#validationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#validationErrorsBox').html('').hide();
            displayServicePhoto(this, '#previewImage', extension);
        }
    });

    $(document).on('change', '#editServiceImage', function () {
        let extension = isValidFile($(this),
            '#editDocumentValidationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#editDocumentValidationErrorsBox').html('').hide();
            displayServicePhoto(this, '#previewEditImage', extension);
        }
    });

    $(document).on('submit', '#serviceSliderEditForm', function (event) {
        event.preventDefault();
        // let loadingButton = jQuery(this).find('#btnEditSave');
        // loadingButton.button('loading');
        $('#btnEditSave').attr('disabled', true);
        var formData = new FormData(this);
        let id = $('#serviceId').val();
        $.ajax({
            url: route('service-slider-update', id),
            type: 'POST',
            data: formData,
            // dataType    : 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
                    $('#btnEditSave').attr('disabled', false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
                $('#btnEditSave').attr('disabled', false);
            },
        });
    });

    $(document).on('click', '.delete-btn', function () {
        let serviceSliderId = $(this).attr('data-id');
        deleteItem(route('service-slider.destroy', serviceSliderId), tableName,
            'Service Slider');
    });

    // var owl = $('.owl-carousel');
    // owl.owlCarousel({
    //     items:4,
    //     loop:true,
    //     margin:10,
    //     autoplay:true,
    //     autoplayTimeout:1000,
    //     autoplayHoverPause:true
    // });

    window.displayServicePhoto = function (input, selector) {
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
});
