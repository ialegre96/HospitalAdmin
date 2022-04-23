'use strict';
$(document).ready(function () {
    let tbl = $('#faqsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[0, 'desc']],
        ajax: {
            url: route('faqs.index'),
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '8%',
            },
            {
                'targets': [1],
                'className': 'text-wrap',
            },
            {
                'targets': [2],
                'orderable': false,
                'width': '5%',
                'className': 'text-center',
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
                    return `<a href="javascript:void(0)" class="show-btn" data-id="${row.id}">${row.question}</a>`;
                },
                name: 'question',
            },
            {
                data: 'answer',
                name: 'answer',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                        },
                    ];
                    return prepareTemplateRender('#faqsTemplate', data);
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
    $('#btnSave').attr('disabled', true);
    $.ajax({
        url: route('faqs.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function success (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $('#faqsTable').DataTable().ajax.reload(null, false);
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
//
$(document).on('click', '.edit-btn', function (event) {
    // if (ajaxCallIsRunning) {
    //     return;
    // }
    // ajaxCallInProgress();
    let faqsId = $(event.currentTarget).data('id');

    renderData(faqsId);
});

$(document).on('click', '.show-btn', function (event) {
    // if (ajaxCallIsRunning) {
    //     return;
    // }
    ajaxCallInProgress();
    let faqsId = $(event.currentTarget).data('id');
    $.ajax({
        url: route('faqs.show', faqsId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showQuestion').text(result.data.question);
                $('#showAnswer').text(result.data.answer);
                $('#showModal').modal('show');
                // ajaxCallCompleted();   
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
});

window.renderData = function (id) {
    $.ajax({
        url: route('faqs.edit', id),
        type: 'GET',
        success: function (result) {
            $('#faqsId').val(result.data.id);
            $('#editQuestion').val(result.data.question);
            $('#editAnswer').val(result.data.answer);
            $('#editModal').modal('show');
            ajaxCallCompleted();
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    $('#btnEditSave').attr('disabled', true);
    let id = $('#faqsId').val();
    $.ajax({
        url: route('faqs-update', id),
        type: 'post',
        data: $(this).serialize(),
        success: function (result) {
            displaySuccessMessage(result.message);
            $('#editModal').modal('hide');
            $('#faqsTable').DataTable().ajax.reload(null, false);
            $('#btnEditSave').attr('disabled', false);
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
    $('#btnSave').attr('disabled', false);
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editModal #editValidationErrorsBox');
    $('#btnEditSave').attr('disabled', false);
});

$(document).on('click', '.delete-btn', function (event) {
    let faqsId = $(event.currentTarget).data('id');
    deleteItem(route('faqs.destroy', faqsId), $('#faqsTable'), 'FAQs');
});
