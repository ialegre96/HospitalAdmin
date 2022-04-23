'use strict';

let tableName = '#departments-table';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[0, 'asc']],
    ajax: {
        url: departmentUrl,
        data: function (data) {
            data.is_active = $('#filter_active').
                find('option:selected').
                val()
        },
    },
    columnDefs: [
        {
            'targets': [1],
            'orderable': false,
            'className': 'text-center',
            'width': '6%',
        },
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '6%',
        },
        {
            targets: '_all',
            defaultContent: 'N/A',
            'className': 'text-start align-middle text-nowrap',
        },
    ],
    columns: [
        {
            data: 'name',
            name: 'name',
        },
        {
            data: function (row) {
                let checked = row.is_active == 0 ? '' : 'checked';
                let data = [{ "id": row.id, "checked": checked }];
                return prepareTemplateRender("#departmentIsActiveTemplate", data);
            },
            name: 'is_active',
        },
        {
            data: function (row) {
                let data = [{ "id": row.id }];
                return prepareTemplateRender("#departmentActionTemplate", data);
            }, name: 'id'
        }
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#filter_active', function () {
            $(tableName).DataTable().ajax.reload(null, false);
            $(tableName).DataTable().page('previous').draw('page');
        });
    },
});

$(document).on('change', '.is-active', function (event) {
    let departmentId = $(event.currentTarget).data('id');
    updateStatus(departmentId);
});

window.updateStatus = function (id) {
    $.ajax({
        url: departmentUrl + id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
    })
};

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find("#btnSave");
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': departmentCreateUrl,
        'type': 'POST',
        'tableSelector': tableName
    };
    newRecord(data, loadingButton);
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find("#btnEditSave");
    loadingButton.button('loading');
    let id = $('#departmentId').val();
    let url = departmentUrl + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
        'tableSelector': tableName
    };
    editRecordWithForm(data, loadingButton);
});

$(document).on('click', '.edit-btn', function (event) {
    let departmentId = $(event.currentTarget).data('id');
    renderData(departmentId);
});

$(document).on('click', '.delete-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    deleteItem(departmentUrl + id, tableName, 'Department');
});

window.renderData = function (id) {
    $.ajax({
        url: departmentUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#departmentId').val(result.data.id);
                $('#editName').val(result.data.name);
                if (result.data.is_active) {
                    $('#editIsActive').val(1).prop('checked', true);
                }
                $('#EditModal').modal('show');
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$('#filter_active').select2({
    width: '100%',
});
