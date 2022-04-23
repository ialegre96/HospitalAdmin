'use strict';

$(document).ready(function () {
    let tableName = '#caseHandlersTbl';
    let tbl = $('#caseHandlersTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[6, 'desc']],
        ajax: {
            url: caseHandlerUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
            },
            {
                'targets': [6],
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
                    let showLink = caseHandlerUrl + '/' + row.id;
                    return `<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="${showLink}">
                                    <div class="">
                                        <img src="${row.image_url}" alt="" class="user-img">
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
                data: 'user.phone',
                name: 'user.phone',
            },
            {
                data: 'user.qualification',
                name: 'user.qualification',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.user.dob === null) {
                        return 'N/A';
                    }

                    return moment(row.user.dob).format('Do MMM, Y');
                },
                name: 'user.dob',
            },
            {
                data: function (row) {
                    let checked = row.user.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#caseHandlerStatusTemplate',
                        data);
                },
                name: 'user.status',
            },
            {
                data: function (row) {
                    let url = caseHandlerUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate',
                        data);
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
    let caseHandlerId = $(event.currentTarget).data('id');
    deleteItem(caseHandlerUrl + '/' + caseHandlerId, '#caseHandlersTbl',
        'Case Handler');
});

$(document).on('change', '.status', function (event) {
    let caseHandlerId = $(event.currentTarget).data('id');
    updateStatus(caseHandlerId);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

window.updateStatus = function (id) {
    $.ajax({
        url: caseHandlerUrl + '/' + id + '/active-deactive',
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
});
