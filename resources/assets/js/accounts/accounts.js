'use strict';

$('#filter_status, #filter_type').select2();

let tableName = '#accountsTbl';
let tbl = $('#accountsTbl').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[4, 'desc']],
    ajax: {
        url: accountUrl,
        data: function (data) {
            data.account_status = $('#filter_status').
                find('option:selected').
                val();
            data.account_type = $('#filter_type').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '6%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '10%',
        },
        {
            'targets': [4],
            'visible': false,
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
                let showLink = accountUrl + '/' + row.id;
                return '<a href="' + showLink + '">' + row.name +
                    '</a>';
            },
            name: 'name',
        },
        {
            data: function (row) {
                if (row.type == 1)
                    return '<span class="badge badge-light-danger fs-7">Debit</span>';
                else
                    return '<span class="badge badge-light-success fs-7">Credit</span>';
            },
            name: 'type',
        },
        {
            data: function (row) {
                let checked = row.status == 0 ? '' : 'checked';
                let data = [{'id': row.id, 'checked': checked}];
                return prepareTemplateRender('#accountIsActiveTemplate',
                    data);
            },
            name: 'status',
        },
        {
            data: function (row) {
                let data = [{ 'id': row.id }];
                return prepareTemplateRender('.modalActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#filter_status, #filter_type', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});
handleSearchDatatable(tbl);

$(document).on('change', '.is-active', function (event) {
    let accountId = $(event.currentTarget).data('id');
    updateStatus(accountId);
});

window.updateStatus = function (id) {
    $.ajax({
        url: accountUrl + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
    });
};

$(document).on('submit', '#addNewForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');
    let data = {
        'formSelector': $(this),
        'url': accountCreateUrl,
        'type': 'POST',
        'tableSelector': tableName,
    };
    newRecord(data, loadingButton);
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnEditSave');
    loadingButton.button('loading');
    let id = $('#accountId').val();
    let url = accountUrl + '/' +  + id;
    let data = {
        'formSelector': $(this),
        'url': url,
        'type': 'PUT',
        'tableSelector': tableName,
    };
    editRecordWithForm(data, loadingButton);
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let accountId = $(event.currentTarget).data('id');
    renderData(accountId);
});

$(document).on('click', '.delete-btn', function (event) {
    let id = $(event.currentTarget).data('id');
    deleteItem(accountUrl + '/' +  + id, tableName, 'Account');
});

window.renderData = function (id) {
    $.ajax({
        url: accountUrl + '/' +  + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#accountId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editDescription').val(result.data.description);
                if (result.data.status) {
                    $('#editIsActive').val(1).prop('checked', true);
                }
                if (result.data.type == 1) {
                    $('#editDebit').prop('checked', true);
                } else {
                    $('#editCredit').prop('checked', true);
                }
                $('#EditModal').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            manageAjaxErrors(result);
        },
    });
};

$(document).ready(function () {
    $(document).on('click', '#resetFilter', function () {
        $('#filter_type').val(0).trigger('change');
        $('#filter_status').val(2).trigger('change');
    });
});
