'use strict';

$(document).ready(function () {

    let tbl = $('#noticeBoardsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[1, 'desc']],
        ajax: {
            url: noticeBoardUrl,
        },
        columnDefs: [
            {
                'targets': [2],
                'orderable': false,
                'className': 'text-center text-nowrap',
                'width': '8%',
            },
            {
                'targets': [3],
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
                data: 'title',
                name: 'title',
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
                    let url = noticeBoardUrl + '/' + row.id;
                    let data = [
                        {
                            'id': row.id,
                            'url': url + '/edit',
                            'show': url,
                        }];
                    return prepareTemplateRender('.noticeActionTemplate',
                        data);
                }, name: 'id',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
        ],
    });

    handleSearchDatatable(tbl);

    $(document).on('click', '.delete-btn', function (event) {
        let noticeBoardId = $(event.currentTarget).data('id');
        deleteItem(
            noticeBoardUrl + '/' + noticeBoardId,
            '#noticeBoardsTable',
            'Notice Board',
        );
    });
});
