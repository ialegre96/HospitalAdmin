'use strict';

$(document).ready(function () {
    let tbl = $('#brandsTable').DataTable({
        processing: true,
        serverSide: true,
        searchDelay: 500,
        'language': {
            'lengthMenu': 'Show _MENU_',
        },
        'order': [[4, 'desc']],
        ajax: {
            url: brandUrl,
        },
        columnDefs: [
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
                    let showLink = brandUrl + '/' + row.id;
                    return '<a href="' + showLink + '">' + row.name +
                        '</a>';
                },
                name: 'name',
            },
            {
                data: function (row) {
                    return isEmpty(row.email) ? 'N/A' : row.email;
                },
                name: 'email',
            },
            {
                data: function (row) {
                    return isEmpty(row.phone) ? 'N/A' : row.phone;
                },
                name: 'phone',
            },
            {
                data: function (row) {
                    let url = brandUrl + '/' + row.id;
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
    });
    handleSearchDatatable(tbl);
});

$(document).on('click', '.delete-btn', function (event) {
    let brandId = $(event.currentTarget).data('id');
    deleteItem(brandUrl + '/' + brandId, '#brandsTable', 'Medicine Brand');
});
