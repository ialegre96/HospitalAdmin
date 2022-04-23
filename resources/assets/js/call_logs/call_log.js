'use strict';

$(document).ready(function () {
    let tableName = '#callLogTbl';
    let tbl = $('#callLogTbl').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [6, 'desc'],
        ajax: {
            url: callLogUrl,
            data: function (data) {
                data.call_type = $('#callType').find('option:selected').val();
            },
        },
        columnDefs: [
            {
                'targets': [5],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
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
                data: 'name',
                name: 'name',
            },
            {
                data: function (row) {
                    return isEmpty(row.phone) ? 'N/A' : row.phone;
                },
                name: 'phone',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.date === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.date).format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'date',
            },
            {
                data: function (row) {
                    return row;
                },
                render: function (row) {
                    if (row.follow_up_date === null) {
                        return 'N/A';
                    }
                    return `<div class="badge badge-light">
                                <div>${moment(row.follow_up_date).
                        format('Do MMM, Y')}</div>
                            </div>`;
                },
                name: 'follow_up_date',
            },
            {
                data: function (row) {
                    if (row.call_type == callTypeIncoming) {
                        return '<span class="badge badge-light-info fs-7">incoming</span>';
                    } else {
                        return '<span class="badge badge-light-primary fs-7">outgoing</span>';
                    }
                },
                name: 'call_type',
            },
            {
                data: function (row) {
                    let url = callLogUrl + row.id;
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
            $(document).on('change', '#callType', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });
    handleSearchDatatable(tbl);
});

$('#callType').select2();

$(document).on('click', '#resetFilter', function () {
    $('#callType').val(0).trigger('change');
});

$(document).on('click', '.delete-btn', function (event) {
    let callLogId = $(event.currentTarget).data('id');
    deleteItem(callLogUrl + callLogId, '#callLogTbl', 'Call Log');
});

