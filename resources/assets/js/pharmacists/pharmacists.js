'use strict';

let tableName = '#pharmacistsTable';
let tbl = $('#pharmacistsTable').DataTable({
    processing: true,
    serverSide: true,
    searchDelay: 500,
    'language': {
        'lengthMenu': 'Show _MENU_',
    },
    'order': [[4, 'desc']],
    ajax: {
        url: pharmacistUrl,
        data: function (data) {
            data.status = $('#filter_status').find('option:selected').val();
        },
    },
    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center text-nowrap',
            'width': '8%',
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
                let showLink = pharmacistUrl + '/' + row.id;
                return `<div class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="${showLink}">
                                        <div>
                                            <img src="${row.image_url}" alt=""
                                                 class="user-img">
                                        </div>
                                    </a>
                                </div>
                            <div class="d-flex flex-column">
                                <a href="${showLink}" class="mb-1">${row.user.full_name}</a>
                                <span>${row.user.email}</span>
                            </div>
                    </div>`;
            },
            name: 'user.first_name',
        },
        {
            data: function (row) {
                return isEmpty(row.user.blood_group)
                    ? `N/A`
                    : `<span class="badge badge-light-success">${row.user.blood_group}</span>`;
            },
            name: 'user.blood_group',
        },
        {
            data: function (row) {
                let checked = row.user.status == 0 ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#pharmacistStatusTemplate', data);
            },
            name: 'user.status',
        },
        {
            data: function (row) {
                let url = pharmacistUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                        'viewUrl': url,
                    }];
                return prepareTemplateRender('#pharmacistActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
    ],
    'fnInitComplete': function () {
        $(document).on('change', '#filter_status', function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});
handleSearchDatatable(tbl);

$(document).on('click', '.delete-btn', function (event) {
    let pharmacistId = $(event.currentTarget).data('id');
    deleteItem(pharmacistUrl + '/' + pharmacistId, '#pharmacistsTable',
        'Pharmacist');
});

$(document).on('change', '.status', function (event) {
    let pharmacistId = $(event.currentTarget).data('id');
    updateStatus(pharmacistId);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

window.updateStatus = function (id) {
    $.ajax({
        url: pharmacistUrl + '/' + +id + '/active-deactive',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                tbl.ajax.reload(null, false);
            }
        },
    });
};
