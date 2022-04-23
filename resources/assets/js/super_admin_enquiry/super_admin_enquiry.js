'use strict';

$(document).ready(function () {
    $('#type,#filter_status').select2({
        width: '100%',
    });

    let tableName = '#superAdminEnquiriesTable';
    let tbl = $('#superAdminEnquiriesTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        ajax: {
            url: route('super.admin.enquiry.index'),
            data: function (data) {
                data.status = $('#filter_status').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '20%',
            },
            {
                'targets': [3],
                'orderable': false,
                'width': '8%',
            },
            {
                'targets': [2],
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
                    return `<div class="d-flex flex-column">
                                <span class="mb-1 text-black">${row.full_name}</span>
                            </div>`;
                },
                name: 'first_name',
            },
            {
                data: function (row) {
                    let messageLength = row.message;

                    if (row.message.length >= 55) {
                        return messageLength.substring(0, 55) + '...';
                    }
                    return row.message;
                },
                name: 'message',
            },
            {
                data: function (row) {
                    if (row.status) {
                        return `<div class="badge badge-light-success">Read</div>`;
                    } else {
                        return `<div class="badge badge-light-danger">Unread</div>`;
                    }
                },
                name: 'status',
            },
            {
                data: function (row) {
                    let data = [
                        {
                            'id': row.id,
                            'showUrl': route('super.admin.enquiry.show', row.id),
                        },
                    ];

                    return prepareTemplateRender('#SuperAdminEnquiryActionTemplate',
                        data);
                },
                name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#filter_status', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '#resetFilter', function () {
    $('#filter_status').val(2).trigger('change');
});

$(document).on('click', '.delete-btn', function (e) {
    let id = $(e.currentTarget).data('id');
    deleteItem(enquiryUrl + '/' + id, '#superAdminEnquiriesTable', 'Enquiry');
});
