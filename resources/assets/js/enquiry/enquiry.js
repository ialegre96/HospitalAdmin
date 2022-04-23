'use strict';

$(document).ready(function () {
    $('#type,#filter_status').select2({
        width: '100%',
    });

    let tableName = '#enquiriesTable';
    let tbl = $('#enquiriesTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [7, 'desc'],
        ajax: {
            url: enquiryUrl,
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [4],
                'orderable': false,
                'width': '4%',
            },
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [0],
                'width': '20%',
            },
            {
                'targets': [1],
                'width': '15%',
            },
            {
                'searchable': true,
                'orderable': true,
                'targets': 2,
            },
            {
                'targets': [6],
                'visible': false,
            },
            {
                'targets': [7],
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
                    return `<div class="d-flex flex-column">
                                <span class="mb-1 text-black">${row.full_name}</span>
                                <span>${row.email}</span>
                            </div>`;
                },
                name: 'full_name',
            },
            {
                data: function (row) {
                    return `<span class="badge badge-light-primary fs-7">${row.enquiry_type}</span>`;
                },
                name: 'type',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.created_at === null) {
                        return 'N/A';
                    }

                    return `<div class="badge badge-light">
                                <div>${moment(row.created_at).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    if (row.viewed_by === null)
                        return 'Not viewed';
                    else
                        return row.user.full_name;
                },
                name: 'user.first_name',
            },
            {
                data: function (row) {
                    let checked = row.status == 0 ? '' : 'checked';
                    let data = [{ 'id': row.id, 'checked': checked }];
                    return prepareTemplateRender('#enquiryStatusTemplate',
                        data);
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let showLink = enquiryShowUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': showLink,
                        }];
                    return prepareTemplateRender('#enquiryActionTemplate',
                        data);
                }, name: 'user.last_name',
            },
            {
                data: 'id',
                name: 'id',
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

    $(document).on('change', '.status', function (event) {
        let enquiryId = $(event.currentTarget).data('id');
        updateStatus(enquiryId);
    });

    window.updateStatus = function (id) {
        $.ajax({
            url: enquiryUrl + '/' + +id + '/active-deactive',
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

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});
