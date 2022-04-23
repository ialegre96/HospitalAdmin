'use strict';

$(document).ready(function () {
    let tableName = '#doctorsTable';
    let tbl = $('#doctorsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [5, 'desc'],
        ajax: {
            url: doctorUrl,
            data: function (data) {
                data.status = $('#filter_status').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [3],
                'orderable': false,
                'width': '6%',
            },
            {
                'targets': [4],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '10%',
            },
            {
                'targets': [5],
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
                    let showLink = doctorUrl + '/' + row.id;
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
                data: 'specialist',
                name: 'specialist',
            },
            {
                data: 'user.qualification',
                name: 'user.qualification',
            },
            {
                data: function (row) {
                    let checked = row.user.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#doctorStatusTemplate', data);
                },
                name: 'user.status',
            },
            {
                data: function (row) {
                    let url = doctorUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                        }];
                    return prepareTemplateRender('.pageActionTemplate', data);
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
        let doctorId = $(event.currentTarget).data('id');
        deleteItem(doctorUrl + '/' + doctorId, '#doctorsTable', 'Doctor');
    });

    $(document).on('change', '.status', function (event) {
        let doctorId = $(event.currentTarget).data('id');
        updateStatus(doctorId);
    });

    window.updateStatus = function (id) {
        $.ajax({
            url: doctorUrl + '/' + +id + '/active-deactive',
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

    $(document).on('click', '#resetFilter', function () {
        $('#filter_status').val(2).trigger('change');
    });
});
